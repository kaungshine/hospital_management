<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
	protected $fillable = [
    	'roomtype', 'blockfloor', 'blockcode', 'unavailable',
    ];

    public function stays()
    {
    	return $this->hasMany('App\Stay');
    }
}
