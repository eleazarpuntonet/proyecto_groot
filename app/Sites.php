<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sites extends Model
{
    protected $table = 'sitios';
    protected $fillable = ['dominio','hosting','ip_site','status'];

    public function hosting(){
    	return $this->belongsTo(Proveedor::class,'hosting');
    }
}
