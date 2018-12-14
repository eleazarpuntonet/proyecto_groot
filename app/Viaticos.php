<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Viaticos extends Model
{
    protected $table = 'viaticos';

    public function reservas()
    {
    	return $this->belongsTo( Reservas::class,'id_reserva');
    }
}
