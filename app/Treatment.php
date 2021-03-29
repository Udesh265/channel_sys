<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $fillable = [
        'id',
        'patient_id',
        'doctor_id',
        'treatment',
        'next_treatment',
        'next_treatment_date',
        'remind_date',

    ];


}
