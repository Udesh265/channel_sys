<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeAttendance extends Model
{
    protected $fillable = [
        'employee_id',
        'in_time',
        'out_time',
        'status',
        'date'
    ];

}
