<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credenciales extends Model
{
    protected $table = 'credenciales';
    protected $fillable = ['id_site','descripcion','user','passw','comentarios'];
}
