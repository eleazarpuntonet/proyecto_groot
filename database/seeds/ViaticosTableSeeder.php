<?php
use App\Viaticos;
use Illuminate\Database\Seeder;

class ViaticosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        	$viaticos_data = File::get("database/dataseed/ViaticosSeed.json");
        	$viaticos = json_decode($viaticos_data);
        	Viaticos::truncate();

            foreach ($viaticos as $viatico) {
                $viatico_             = new App\Viaticos;
                $viatico_->id_reserva = $viatico->id_reserva;
                $viatico_->rubro      = $viatico->rubro;
                $viatico_->cantidad   = $viatico->cant;
                $viatico_->val_unit   = $viatico->val_unit;
                $viatico_->save();
            }
    }
}
