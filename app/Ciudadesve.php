<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudadesve extends Model
{
    protected $table = 've_ciudades';

    public function estados(){
    	return $this->belongsTo(Estadosve::class,'id_estado','id_estado');
    }
}
