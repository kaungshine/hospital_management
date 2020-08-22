<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescribe extends Model
{
    //
    public function physician()
    {
        return $this->belongsTo('App\Physician');
    }
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
    public function medication()
    {
        return $this->belongsTo('App\Medication');
    }
    public function appointment()
    {
        return $this->belongsTo('App\Appointment');
    }
}
