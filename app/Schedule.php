<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public $timestamps = false;

    protected $fillable = [
        "id",
        "employee_id",
        "startDate",
        "room_id",
        "doctor_id",
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
    public function room() {
        return $this->belongsTo(Room::class);
    }

    public function doctor()
    {
            return $this->belongsTo(Doctor::class,'employee_id');
    }

    public function assigned_doctor(){

        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function appointment(){
        return $this->hasMany(Schedule::class);
    }

    public function appointments(){
        return $this->hasMany(Schedule::class);
    }

}
