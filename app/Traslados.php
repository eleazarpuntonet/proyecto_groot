<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Traslados extends Model
{
	protected $table = 'traslados';
	protected $visible = [
	    'id',
	    'reservas_id',
	    'valor',
	    'localidad',
	    'descripcion',
	    'tipo',
	    'origen',
	    'destino',
	    'fecha_hora',
	    'proveedor',
	    'created_at',
	    'session',
	];

	public function reservas()
	{
		return $this->belongsTo(Reservas::class,'reservas_id','id');
	}

	public function proveedor()
	{
		return $this->hasOne(Proveedor::class, 'id','proveedor');
	}

}
