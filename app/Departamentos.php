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
}
