<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //
    public function types(){
        return $this->belongsToMany('App\Models\Type' , 'document_types');
    }
    public function documentable()
    {
        return $this->morphTo();
    }
}
