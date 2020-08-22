<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    //
    public function prescribes()
    {
    	return $this->hasMany('App\Prescribe');
    }
}
