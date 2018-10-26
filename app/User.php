<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','last_name','username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        // return $this->belongsTo(Role::class);
        return $this->belongsToMany(Role::class,'assigned_roles');
        // return $this->belongsToMany('App\Role');
    }

    public function hasRoles(array $roles)
    {
        foreach ($roles as $role) {
            foreach ($this->roles as $userRole) {
    
                if ($userRole->name === $role) {
                    return true;
                dd($this->roles);
                }

            }
        }
        return false;
    }
}
