<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lab_test_appointment extends Model
{
    protected $fillable = [
        'id',
        'date',
        'user_id',
        'payment_id',
        'patient_id',
        'report_type_id',
        'appointment_type', // registered or regular
        'status',
    ];
}
