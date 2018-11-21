<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estadosve extends Model
{
    protected $table = 've_estados';

    public function ciudades(){

    	return $this->hasMany(Ciudadesve::class,'id_estado','id_estado');
    	
    }

    public function municipios(){

    	return $this->hasMany(Municipiosve::class,'id_estado','id_estado');

    }
}
