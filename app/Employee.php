<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{
    protected $fillable = ['id','first_name','last_name','address','email','nic','mobile'];

    public function user(){
        return HasOne(User::class);
    }
}
