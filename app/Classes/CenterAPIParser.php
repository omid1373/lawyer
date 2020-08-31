<?php

namespace App\Classes;

use App\Models\Competence;
use App\Models\CompetenceField;
use Morilog\Jalali\Jalalian;

class CenterAPIParser{
    private $json;
    // omid :D
    private $townJson;
    public function __construct($json){
        $this->json = $json;
        if(!isset($this->json->FirstName))
            throw new \Exception('User doesn\'t exist');
        if(isset($this->json->error))
            throw new \Exception($this->json->error->message);
        // omid :D
        $this->townJson = json_decode(file_get_contents(resource_path("state.json")), true);
    }
    private function changeDate($date){
        $dateArray = explode('/', $date);
        $dateArray = array_map(function ($member){
            return intval($member);
        }, $dateArray);
        $dateObject = new Jalalian($dateArray[0], $dateArray[1], $dateArray[2]);
        return $dateObject->getTimestamp();
    }
    private function Ar_Per($str = '')
    {
        $str = preg_replace('/[\n\r\t]/', '', $str);
        $str = str_replace(['ئ', 'ك', 'ي', PHP_EOL], ['ی', 'ک', 'ی', '', '', '', '', ''], $str);
        $str = trim($str, '.');
        return $str;
    }
    private function suitable_for_search($str){
        $str = $this->Ar_Per($str);
        $str = str_replace(['آ', '-', '،', ';', ' ', '.'], ['ا', '', '', '', '', ''], $str);
        $str = preg_replace('/^([0-9]+\)\s?)/', '', $str);
        return $str;
    }
    public function getName(){
        return $this->Ar_Per($this->json->FirstName);
    }
    public function getSurname(){
        return $this->Ar_Per($this->json->LastName);
    }
    public function getFatherName(){
        return $this->Ar_Per($this->json->FatherName);
    }
    public function getMobileNumber(){
        return $this->json->Mobile;
    }
    public function getExpertise(){
        $expertise = $this->Ar_Per($this->json->Reshte);
        if($expertise == 'پایه یک' || $expertise == 'پایه دو')
            throw new \Exception('Route is only available for experts. This role is lawyer');
        return $expertise;
    }
    public function getLicenceNumber(){
        return $this->json->Parvane;
    }
    public function getIssuedDate(){
        return $this->changeDate($this->json->TarikheSodoorParvane);
    }
    public function getExpirationDate(){
        return $this->changeDate($this->json->TarikheEtebar);
    }
    public function getCompetences(){
        $all_competence_fields = CompetenceField::all();
        $all_competences = Competence::all();
        $competences = [];
        $competence_fields = [];
        $competence_ids = [];
        foreach ($all_competences as $competence)
            $competences[$this->suitable_for_search($competence['competence']) . $competence['competence_field_id']] = $competence['id'];
        foreach ($all_competence_fields as $competence)
            $competence_fields[$this->suitable_for_search($competence['field'])] = $competence['id'];
        unset($all_competences);
        unset($all_competence_fields);
        $competence_field = $this->suitable_for_search($this->json->Reshte);
        $competence_field_id = 0;
        if(array_key_exists($competence_field, $competence_fields))
            $competence_field_id = $competence_fields[$competence_field];
        $api_competences = explode(PHP_EOL, $this->json->Salahiyat);
        $api_competences = array_map(function ($competence) {
            return $this->suitable_for_search($competence);
        }, $api_competences);
        foreach ($api_competences as $competence) {
            if(array_key_exists($competence . $competence_field_id, $competences))
                $competence_ids[] = $competences[$competence . $competence_field_id];
        }
        return $competence_ids;
    }
    public function getAddress(){
        return $this->json->AddressDaftar;
    }
    public function getProvince(){
        return $this->Ar_Per($this->json->Ostan);
    }
    public function getCity(){
        return $this->Ar_Per($this->json->Shahr);
    }
    // omid :D
    public function getTown(){
        $towns = $this->townJson[$this->getProvince()];
        foreach ($towns as $key => $val) {
            if(in_array($this->getCity(), $val))
                return $key;
        }
        return null;
    }
    public function getProfilePicture(){
        return $this->json->Tasvir;
    }
    public function getUrl(){
        return $this->json->url;
    }

    public function getParsedData(){
        return [
            'name' => $this->getName(),
            'surname' => $this->getSurname(),
            'father_name' => $this->getFatherName(),
            'mobile_number' => $this->getMobileNumber(),
            'expertise' => $this->getExpertise(),
            'licence_number' => $this->getLicenceNumber(),
            'issued_date' => $this->getIssuedDate(),
            'expiration_date' => $this->getExpirationDate(),
            'competences' => $this->getCompetences(),
            'address' => $this->getAddress(),
            'province' => $this->getProvince(), // omid
            'town' => $this->getTown(), //omid :D
            'city' => $this->getCity(),
            'profile_picture' => $this->getProfilePicture(),
            'url' => $this->getUrl()
        ];
    }
}
