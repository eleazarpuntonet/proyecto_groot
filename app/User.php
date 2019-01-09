<?php

namespace App;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

// class User extends Model
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    
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

    protected $visible = [
        'id',
        'name',
        'last_name',
        'cargo',
        'gerencia',
        'sede',
        'email',
        'avatar',
        'fullname',
        'reservas',
        'departamento',
        'roles',
        'getJWTIdentifier',
        'getJWTCustomClaims',
    ];
    // protected $with = [
    //     'getFullNameAttribute',
    // ];

    public function reservas()
    {
        return $this->hasMany( Reservas::class, 'id','id_user' );
    }

    public function departamento()
    {
        return $this->hasOne(Departamentos::class,'id','gerencia');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class,'assigned_roles','user_id','role_id');

                // return $this->hasManyThrough( 
                //                          Role::class, //tabla destino
                //                          AssignedTableRoles::class,//tabla intermedia
                //                          'user_id', //Llave que relaciona la TABLA INTERMEDIA -> TABLA ORIGEN (Autorizaciones)
                //                          'id', //Llave que relaciona la TABLA DESTINO -> TABLA INTERMEDIA (Autorizaciones->Departamentos)
                //                          'id', //Llave que relaciona la TABLA ORIGEN -> TABLA INTERMEDIA (Reservas->Autorizaciones)
                //                          'role_id'//Llave que relaciona la TABLA INTERMEDIA -> TABLA DESTINO (Autorizaciones->Departamentos)
                //                          );
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    
    public function getJWTCustomClaims()
    {
        return [];
    }
}
