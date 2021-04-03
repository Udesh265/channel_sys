<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report_type extends Model
{
    protected $fillable = [
        'id',
        'report_type',
        'fee',
    ];
}
