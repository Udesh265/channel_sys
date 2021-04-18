<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitingDoctorSalary extends Model
{
    protected $fillable = [
        'id',
        'employee_id',
        'amount',
        'status',
    ];
}
