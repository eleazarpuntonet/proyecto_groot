<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';

    // protected $fillable = ['nombre','cuenta','usuario','password','comentarios'];

    public function sites(){
    	return $this->hasOne(Sites::class,'hosting');
    }

    public function contacto()
    {
    	return $this->morphMany(Contactos::class, 'contactable');
    }

    public function traslado()
    {
    	return $this->belongsTo(Traslados::class, 'id','proveedor');
    }
}
