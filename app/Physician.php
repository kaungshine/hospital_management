<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Physician extends Model
{
    public function departments()
    {
    	return $this->belongsToMany('App\Department')
					->withPivot('primaryaffiliation');
    }
    public function procedures()
    {
    	return $this->belongsToMany('App\Procedure');
    }
    public function appointments()
    {
    	return $this->hasMany('App\Appointment');
    }
    public function prescribes()
    {
        return $this->hasMany('App\Prescribe');
    }
}
