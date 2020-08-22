<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    public function physician()
    {
        return $this->belongsTo('App\Physician');
    }
    public function nurse()
    {
        return $this->belongsTo('App\Nurse');
    }
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
    public function prescribes()
    {
        return $this->hasMany('App\Prescribe');
    }
}
