<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
	protected $fillable = [
    	'name', 'head',
    ];

    public function physicians()
    {
        return $this->belongsToMany('App\Physicians');
    }
}
