<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class JobType extends Model
{
    protected $fillable = ['id','name'];

    public function employees(){
        return $this->hasMany(Employee::class);
    }
}

