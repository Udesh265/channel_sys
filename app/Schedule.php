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
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}
