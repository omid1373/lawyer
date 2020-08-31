<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Judge extends Model
{
    //
    public function experience(){
        return $this->morphOne('App\Models\Experience','experienceable');
    }
}
