<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'id',
        'add_speciality_id',
        'employee_id',
        'hospital',
        'doc_type',
        'charge_pp',
    ];

    public function speciality()
    {
        return $this->belongsTo(AddSpeciality::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

}
