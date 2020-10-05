<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    protected $fillable = [
    	'name', 'cost',
    ];

    public function physicians()
    {
    	return $this->belongsToMany('App\physicians');
    }
}
