<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    protected $fillable = ['nombre','cuenta','usuario','password','comentarios'];

    public function sites(){
    	return $this->hasOne(Sites::class,'hosting');
    }
}
