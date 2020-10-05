<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'name', 'address', 'phone', 'insuranceid', 'user_id',
    ];

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
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function diseases()
    {
        return $this->belongsToMany('App\Disease');
    }
}
