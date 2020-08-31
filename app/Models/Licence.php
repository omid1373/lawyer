<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    //
    public function experience(){
        return $this->morphOne('App\Models\Experience','experienceable');
    }
    public function address(){
        return $this->morphOne('App\Models\Address' , 'addressable');
    }
}
