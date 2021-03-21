<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $fillable = [
        'appointment_id',
        'schedule_id',
        'token',
        'status',
    ];

    public $timestamps = false;

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
