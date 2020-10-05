<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Physician extends Model
{   
    protected $fillable = [
        'position', 'security_number', 'user_id',
    ];

    public function departments()
    {
    	return $this->belongsToMany('App\Department');
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
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
