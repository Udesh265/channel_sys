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
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
    public function room() {
        return $this->belongsTo(Room::class);
    }

}
