<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    protected $table = 'reservas';

    public function traslados()
    {
        return $this->hasMany(Traslados::class,'reservas_id','id');
    }

    public function autorizaciones()
    {
    	return $this->hasMany(Autorizaciones::class,'reserva_id');
    }
}
