<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'id',
        'schedule_id',
        'user_id',
        'payment_id',
        'status',
        'patient_id',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function schedule(){
        return $this->belongsTo(Schedule::class);
    }

    public function token()
    {
        return $this->hasOne(Token::class);
    }

}
