<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $table = 'roles';
	
    public function user()
    {
    	return $this->belongsToMany(User::class,'assigned_roles');
    }

    public function auth_roles()
    {
        // $role->auth_roles()->attach('rrhh002i');
        return $this->belongsToMany(Tableauthrole::class,'pathitems_roles','role_id','pathitem_id');
    }

    public function auth_actions()
    {
        return $this->belongsToMany(ActionsAuth::class,'authactions_roles','role_id','action_id');
    }

    public function role_permisos()
    {
        return $this->hasMany(Permisos::class, 'role_id', 'id');
    }
}
