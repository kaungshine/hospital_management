<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stay extends Model
{
	protected $fillable = [
    	'patient_id', 'room_id', 'start_time', 'end_time',
    ];

    public function room()
    {
    	return $this->belongsTo('App\Room');
    }
    public function patient()
    {
    	return $this->belongsToMany('App\Patient');
    }

}
