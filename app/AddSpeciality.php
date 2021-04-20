<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddSpeciality extends Model
{
    protected $fillable = [
        'id',
        'name'
    ];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function shedules()
    {
        return $this->hasManyThrough(Schedule::class, Doctor::class,'add_speciality_id','employee_id');
    }


}
