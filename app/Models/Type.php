<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    //
    public function documents(){
        return $this->hasMany('App\Models\Document');
    }
}
