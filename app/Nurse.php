<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nurse extends Model
{
    protected $fillable = [
    	'name', 'position', 'ssn', 'user_id',
    ];

    public function appointments()
    {
    	return $this->hasMany('App\Appoinment');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
