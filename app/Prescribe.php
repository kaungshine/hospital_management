<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescribe extends Model
{
    protected $fillable = [
        'physician_id', 'patient_id', 'medication_id', 'date', 'appointment_id', 'dose', 
    ];

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
