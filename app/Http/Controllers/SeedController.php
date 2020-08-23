<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class SeedController extends Controller
{
    //
    private $default = ['nationalId' , 'sacrifice' , 'certFirstPage' , //Party
        'profile' /* User */  ,'education' /*Education*/ ,
        'priority1', 'priority2', 'priority3', 'priority4', 'priority5', // Lawyer
        'licenceFirstPage' , 'renewLicence' , // Licence
        'judge' /*Judge*/ ,'certOffice' , 'vote' , // OfficeEmployee
        'thesis' , 'otherPublication' /*Publication*/];

    public function initialTypes(){
        for($i=0 ; $i < count($this->default); $i++){
            Type::create($this->default[$i]);
        }
    }

    public function seed(){
    }
}
