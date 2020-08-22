<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nurse extends Model
{
    //
    public function appointments()
    {
    	return $this->hasMany('App\Appoinment');
    }
}
