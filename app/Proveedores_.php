<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedores_ extends Model
{
    protected $table = 'proveedores_';

    public function extras()
    {
        return $this->morphMany(Databasket::class, 'tobasket');
    }

        public function contacto()
    {
        return $this->morphMany(Contactos::class, 'contactable');
    }
}
