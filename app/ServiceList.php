<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceList extends Model
{
    protected $fillable = [
        'id',
        'payment_id',
        'service_name',
        'service_fee',
    ];
}
