<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    protected $fillable = [
    	'name', 'brand', 'description',
    ];

    public function prescribes()
    {
    	return $this->hasMany('App\Prescribe');
    }
}
