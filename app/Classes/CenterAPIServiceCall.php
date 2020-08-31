<?php


namespace App\Classes;

class CenterAPIServiceCall
{
    private $national_id;
    private $licence_id;

    public function __construct($national_id, $licence_id){
        $this->national_id = $national_id;
        $this->licence_id = $licence_id;
    }

    private function calculateAuthorizationKey()
    {
        $month_key = [
            "nikahsee1Iecheilienae&b)",
            "eu0wie.maoToo5ahy#ui2ieh",
            "ahr<aiz9iet8veenieG<aiBe",
            "ahmai%n2aex8oviu1lei5OoF",
            "Yipe[tei5Iexaifei9thiLo*",
            "si@Chievae9ohl.eish-ae4l",
            "fah6No<h[eeghah7gai:p5Hu",
            "aingae4rec=aeWa<em~ee7Ee",
            "wuThohg7Ree6eem;o0Xizie4",
            "oav1lii4oSh9iZ7NeiGh%oh+",
            "doh;Ng5ahgohgh8xa'veiCho",
            "foosheiYae-kiekec4quai8h"
        ];

        return md5(openssl_encrypt(date('iYmidHi'), "des-ede3", $month_key[date('m') - 1]));
    }

    public function getCredentials()
    {
        $Auth = $this->calculateAuthorizationKey();
        $response = CURL::GET('http://23055000.ir:81/elQuery/all/' . $this->national_id . '/' . $this->licence_id . '/all', [
            "Host: 23055000.ir:81",
            "Authorization:" . "$Auth",
            "Accept-Language: en-US,en;q=0.5",
            "DNT: 1",
            "Cookie: pm_sys_sys={\"sys_sys\": \"workflow\"}; ... ; ROUTEID=.m4",
            "Accept: application/json",
            "Content-Type: application/json",
            "Upgrade-Insecure-Requests: 1",
            "Pragma: no-cache",
            "Cache-Control: no-cache"
        ], [
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_AUTOREFERER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_SSL_VERIFYPEER => false
        ]);
        $res_json = json_decode($response);
        $res_json->url = 'http://23055000.ir:81/elQuery/all/{{national_id}}/{{licence_number}}/all';
        return $res_json;
    }
}
