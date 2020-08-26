<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    //
    public function documents(){
        return $this->morphMany('App\Models\Document','documentable');
    }
}
