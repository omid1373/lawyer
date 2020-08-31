<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    //
    public function licences(){
        return $this->belongsToMany('App\Models\Licence','licence_competences');
    }
    public function field(){
        return $this->belongsTo('App\Models\CompetenceField');
    }

    protected $fillable = ['competence'];
}
