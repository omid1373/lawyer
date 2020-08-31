<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Online extends Model
{
    //
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
