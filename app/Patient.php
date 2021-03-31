<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'id',
        'name',
        'nic',
        'address',
        'mobile',
        'email',
        'age',
        'p_type',
        'status',
        'user_id'
    ];

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }
}
