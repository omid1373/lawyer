<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    //
    public function experienceable()
    {
        return $this->morphTo();
    }
}
