<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autorizaciones extends Model
{
    protected $table = 'autorizaciones';

    // public function reservas()
    // {
    // 	return $this->belongsTo(Reservas::class,'reserva_id','id');
    // }

    public function autorizable()
    {
    	return $this->morphTo();
    }

    public function gerencia()
    {
    	return $this->belongsTo(Departamentos::class,'depto_id','id');
    }

}
