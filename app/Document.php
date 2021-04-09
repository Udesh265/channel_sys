<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'id',
        'path',
        'documentable_id',
        'documentable_type',

    ];

    public function documentable()
    {
        return $this->morphTo();
    }

    protected $filepath = '/storage/documents/';

    public function getPathAttribute($value)
    {
        return $this->filepath . $value;
    }
}
