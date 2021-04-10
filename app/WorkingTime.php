<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingTime extends Model
{

    protected $fillable = [

        'ArrivalTimeFullDay',
        'ArrivalTimeHalfDay',
        'EndOfDayTime'
    ];
}
