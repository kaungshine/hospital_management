<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    //
    public function physicians()
    {
    	return $this->belongsToMany('App\physicians');
    }
}
