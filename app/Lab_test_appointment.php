<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function report_type(){
        return $this.hasOne(Report_type::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
