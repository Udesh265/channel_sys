<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'id',
        'amount',
        'type',
        'payment_status',
        'patient_id',

    ];

    public function appointment(){
        return $this->hasOne(Payment::class);
    }

    public function patient(){
        return $this->belongsTo(Patient::class);
    }


}
