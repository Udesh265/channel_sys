<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient_biometric_data extends Model
{
    protected $fillable = [
        'id',
        'patient_id',
        'diseases',
        'weight',
        'height',
        'bp',
        'lp',
        'others',



    ];
}
