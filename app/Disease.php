<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
	protected $fillable = [
    	'name', 'description',
    ];
    
    public function patients()
    {
        return $this->belongsToMany('App\Patient');
    }
}
