<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report_type extends Model
{
    protected $fillable = [
        'id',
        'report_type',
        'fee',
    ];


    public function lab_app(){
        return $this.hasOne(Lab_test_appointment::class);
    }
}
