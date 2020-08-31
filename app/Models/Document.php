<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //
    public function types(){
        return $this->belongsTo('App\Models\Type');
    }
    public function documentable()
    {
        return $this->morphTo();
    }
}
