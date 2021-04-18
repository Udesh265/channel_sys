<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChannelingCharges extends Model
{
    protected $fillable = [
        'id',
        'charge_amount',
    ];
}
