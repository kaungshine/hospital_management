<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    public function appointments()
    {
    	return $this->hasMany('App\Appointment');
    }
    public function prescribes()
    {
    	return $this->hasMany('App\Prescribe');
    }
    public function stays()
    {
    	return $this->hasMany('App\Stay');
    }
}
