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
        // return $this->belongsToMany(Tableauthrole::class,'pathitems_roles','role_id','pathitem_id');
        return $this->belongsToMany(Tableauthrole::class,'pathitems_roles','role_id','pathitem_id');

                // return $this->hasManyThrough( 
                //                          Role::class, //tabla destino
                //                          AssignedTableRoles::class,//tabla intermedia
                //                          'user_id', //Llave que relaciona la TABLA INTERMEDIA -> TABLA ORIGEN (Autorizaciones)
                //                          'id', //Llave que relaciona la TABLA DESTINO -> TABLA INTERMEDIA (Autorizaciones->Departamentos)
                //                          'id', //Llave que relaciona la TABLA ORIGEN -> TABLA INTERMEDIA (Reservas->Autorizaciones)
                //                          'role_id'//Llave que relaciona la TABLA INTERMEDIA -> TABLA DESTINO (Autorizaciones->Departamentos)
                //                          );
    }
}
