<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    public function teachings(){
        return $this->hasMany('App\Models\Teaching');
    }
    public function publications(){
        return $this->hasMany('App\Models\Publication');
    }
    public function educations(){
        return $this->hasMany('App\Models\Education');
    }
    public function experiences(){
        return $this->hasMany('App\Models\Experience');
    }
    public function addresses(){
        return $this->hasMany('App\Models\Address');
    }
    public function onlines(){
        return $this->hasMany('App\Models\Online');
    }
    public function verifications(){
        return $this->hasMany('App\Models\Verification');
    }
}
