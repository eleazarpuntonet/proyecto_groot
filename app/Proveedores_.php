<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedores_ extends Model
{
    protected $table = 'proveedores_';

    public function contacto()
    {
    	return $this->belongsTo(Contactos::class,'reserva_id','id');
    }
}
