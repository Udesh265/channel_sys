<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'id',
        'spec',
        'hospital',
        'doc_type',
        'charge_pp',
    ];
}
