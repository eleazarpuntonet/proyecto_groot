<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facturacion extends Model
{
    protected $table = 'facturacion';
    protected $fillable = ['id_proveedor','servicio','ciclo_facturacion','fecha_corte','importe'];
}
