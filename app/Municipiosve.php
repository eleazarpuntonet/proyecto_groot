<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipiosve extends Model
{
    protected $table = 've_municipios';

    public function estados(){

    	return $this->belongsTo(Estadosve::class,'id_estado','id_estado');
    	
    }
}
