<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function stays()
    {
    	return $this->hasMany('App\Stay');
    }
}
