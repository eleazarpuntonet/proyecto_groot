<?php

use App\Traslados;
use Illuminate\Database\Seeder;

class TrasladosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $json = file_get_contents("database/dataseed/TrasladoSeed.json");
      $json_data = json_decode($json,true);
    	Traslados::truncate();

    	foreach ($json_data as $traslado) {
        $_traslado              = new App\Traslados;
        $_traslado->reservas_id = $traslado['reservas_id'];
        $_traslado->tipo        = $traslado['tipo'];
        $_traslado->localidad   = $traslado['localidad'];
        $_traslado->origen      = $traslado['origen'];
        $_traslado->destino     = $traslado['destino'];
        $_traslado->fecha_hora  = $traslado['fecha_hora'];
        $_traslado->proveedor   = $traslado['proveedor'];
        $_traslado->session     = $traslado['session'];
  	    $_traslado->save();
    	}
    }
}
