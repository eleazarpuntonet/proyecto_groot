<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Traslados extends Model
{
	protected $table = 'traslados';

	public function reservas()
	{
		return $this->belongsTo(Reservas::class,'reservas_id','id');
	}

	public function proveedor()
	{
		return $this->hasOne(Proveedor::class, 'id','proveedor');
	}

}
