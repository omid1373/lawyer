<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    //
    public function user(){
        return $this->hasOne('App\Models\User');
    }
    public function documents(){
        return $this->morphMany('App\Models\Document','documentable');
    }
}
