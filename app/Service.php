<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'id',
        'name',
        'fee',
        'status'
    ];

    public function serviceList() {
        return $this->hasMany(ServiceList::class);
    }


}
