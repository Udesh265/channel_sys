<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'email', 'password', 'username', 'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function getAllPermissionsAttribute()
    {

        $permissions = [];
        $role_name = $this->getRoleNames()[0];

        if ($role_name == "Super Admin") {
            $permission_array = Permission::all('name');
            foreach ($permission_array as $per) {
                array_push($permissions, $per->name);
            }

            return $permissions;
        }

        $role = Role::whereName($role_name)->first();

        $permissions_list = $role->permissions()->get(['name']);
        foreach ($permissions_list as $per) {
            array_push($permissions, $per->name);
        }

        return $permissions;
    }

    public function photo() {
        return $this->hasOne('App\Photo');
    }

    public function employee(){
        return $this->HasOne(Employee::class);
    }

}
