<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function licence(){
        return $this->belongsTo('App\Models\Licence');
    }
}
