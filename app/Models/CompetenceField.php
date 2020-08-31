<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompetenceField extends Model
{
    //
    public function competences(){
        return $this->hasMany('App\Models\Competence');
    }
}
