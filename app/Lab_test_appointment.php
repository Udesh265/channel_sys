<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        return $this->belongsTo(Report_type::class,'report_type_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }


}
