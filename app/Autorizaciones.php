<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autorizaciones extends Model
{
    protected $table = 'autorizaciones';
    protected $visible = [
        'id',
        'autorizable_id',
        'autorizable_type',
        'recurso',
        'valor',
        'date_auth',
        'gerencia',
        'autorizable',
    ];

    public function reservas()
    {
    	return $this->belongsTo(Reservas::class,'reserva_id','id');
    }

    public function autorizable()
    {
    	return $this->morphTo();
    }

    public function gerencia()
    {
    	return $this->belongsTo(Departamentos::class,'depto_id','id');
    }

    public function autorizar()
    {
        return $this->belongsTo(User::class,'id_user' ,'id');
    }

}
