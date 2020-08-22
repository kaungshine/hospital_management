<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stay extends Model
{
    public function room()
    {
    	return $this->belongsToMany('App\Room');
    }
    public function patient()
    {
    	return $this->belongsToMany('App\Patient');
    }

}
