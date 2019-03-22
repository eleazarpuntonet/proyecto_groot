<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    protected $table = 'reservas';
    protected $visible = [
        'id',
        'id_user',
        'alcance',
        'origen_a',
        'origen_b',
        'origen_det',
        'fecha_partida',
        'fecha_retorno',
        'destino_a',
        'destino_b',
        'destino_det',
        'motivo',
        'agenda',
        'created_at',
        'traslados',
        'user',
        'viaticos',
        'autorizaciones',
    ];
    // protected $with = [
    //     'autorizaciones',
    // ];

    public function traslados()
    {
        return $this->hasMany( Traslados::class, 'reservas_id','id' );
    }

    public function autorizaciones_old()
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
    	return $this->belongsTo(User::class,'id_user' ,'id');
    }

    public function viaticos()
    {
    	return $this->hasMany( Viaticos::class,'id_reserva' ,'id');
    }

    public function autorizaciones()
    {
        return $this->morphMany(Autorizaciones::class, 'autorizable');
    }


}
