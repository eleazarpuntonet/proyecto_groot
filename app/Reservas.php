<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    protected $table = 'reservas';

    public function traslados()
    {
        return $this->hasMany( Traslados::class, 'reservas_id','id' );
    }

    public function autorizaciones()
    {
        return $this->hasMany( Autorizaciones::class, 'reserva_id' );
    	// return $this->hasManyThrough( 
					// 				Departamentos::class, //tabla destino
					// 				Autorizaciones::class,//tabla intermedia
					// 				'reserva_id', //Llave que relaciona la TABLA INTERMEDIA -> TABLA ORIGEN (Autorizaciones)
					// 				'id', //Llave que relaciona la TABLA DESTINO -> TABLA INTERMEDIA (Autorizaciones->Departamentos)
					// 				'id', //Llave que relaciona la TABLA ORIGEN -> TABLA INTERMEDIA (Reservas->Autorizaciones)
					// 				'depto_id'//Llave que relaciona la TABLA INTERMEDIA -> TABLA DESTINO (Autorizaciones->Departamentos)
    	// 							);
    }

    public function user()
    {
    	return $this->belongsTo( User::class,'id_user' ,'id');
    }

    public function gerencia()
    {
    	return $this->hasManyThrough( 
									Departamentos::class, 
									User::class,
									'id', //Llave unica de la tabla intermedia (User.id)
									'id', //Llave ajena entre tabla intermedia y tabla final (User.id->Departamentos)
									'id_user', //Llave ajena de la tabla origen con tabla intermedia (Reservas.id_user->User)
									'gerencia'//Llave ajena de la tabla intermedia con tabla final (User->Departamentos.gerencia)
    								);
    }


}
