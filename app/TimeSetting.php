<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeSetting extends Model
{
    protected $fillabel = [
        'id',
        'variable',
        'value'
    ];
}