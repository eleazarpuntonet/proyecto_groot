<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    protected $table = 'departamentos';
    // protected $visible = ['disp_name','ref','coordinador','gerente'];
    protected $with = [
        'coordinador:id,name,last_name,sede,email,avatar,cargo',
        'gerente:id,name,last_name,sede,email,avatar,cargo',
    ];


    public function coordinador()
    {
        return $this->hasOne(User::class,'id','coordinador_id');
    }

    public function gerente()
    {
        return $this->hasOne(User::class,'id','gerente_id');
    }

    public function autorizaciones()
    {
    	return $this->hasMany(Autorizaciones::class,'depto_id');
    }


}
