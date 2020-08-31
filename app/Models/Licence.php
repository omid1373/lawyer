<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    //
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function address(){
        return $this->morphOne('App\Models\Address' , 'addressable');
    }
    public function documents(){
        return $this->morphMany('App\Models\Document','documentable');
    }
}
