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
            $json = file_get_contents("database/dataseed/ViaticoSeed.json");
            $json_data = json_decode($json,true);
        	Viaticos::truncate();

            foreach ($json_data as $viatico) {
                $viatico_             = new App\Viaticos;
                $viatico_->id_reserva = $viatico['id_reserva'];
                $viatico_->rubro      = $viatico['rubro'];
                $viatico_->cantidad   = $viatico['cant'];
                $viatico_->val_unit   = $viatico['val_unit'];
                $viatico_->save();
            }
    }
}
