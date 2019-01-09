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
       	$Yraslados = File::get("database/dataseed/TrasladoSeed.json");
       	$traslados = json_decode($Yraslados);
       	Traslados::truncate();

       	foreach ($traslados as $traslado) {
            $_traslado              = new App\Traslados;
            $_traslado->reservas_id = $traslado->reservas_id;
            $_traslado->tipo        = $traslado->tipo;
            $_traslado->origen      = $traslado->origen;
            $_traslado->destino     = $traslado->destino;
            $_traslado->hora        = $traslado->hora;
            $_traslado->proveedor   = $traslado->proveedor;
            $_traslado->session     = $traslado->session;
       	    $_traslado->save();
       	}
    }
}
