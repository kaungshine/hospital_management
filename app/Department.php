<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function physicians()
    {
        return $this->belongsToMany('App\Physicians')
         			->withPivot('primaryaffiliation');
    }
}
