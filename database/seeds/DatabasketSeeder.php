<?php
use App\Databasket;
use Illuminate\Database\Seeder;

class DatabasketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data = File::get("database/dataseed/DatabasketSeed.json");
    	$databasket = json_decode($data);

    		Databasket::truncate();

    		foreach ($databasket as $item) {
    	     $dataitem              = new App\Databasket;
    	     $dataitem->reservas_id = $item->reservas_id;
    	     $dataitem->tipo        = $item->tipo;
    	     $dataitem->origen      = $item->origen;
    	     $dataitem->destino     = $item->destino;
    	     $dataitem->hora        = $item->hora;
    	     $dataitem->proveedor   = $item->proveedor;
    	     $dataitem->session     = $item->session;
    		    $dataitem->save();
    		}
    }
}
