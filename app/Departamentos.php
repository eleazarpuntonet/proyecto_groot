<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    protected $table = 'departamentos';

    public function autorizaciones()
    {
    	return $this->hasMany(Autorizaciones::class,'depto_id');
    }

    public function coordinador()
    {
    	return $this->hasOne(User::class,'id','coordinador_id');
    }

    public function gerente()
    {
    	return $this->hasOne(User::class,'id','coordinador_id');
    }
}
