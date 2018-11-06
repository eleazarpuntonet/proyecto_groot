<?php
use App\Facturacion;
use Illuminate\Database\Seeder;

class FacturacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Facturacion::truncate();

        $data_fact                    = new App\Facturacion;
        $data_fact->id_proveedor      = 1;
        $data_fact->servicio          = 'Hosting';
        $data_fact->ciclo_facturacion = 'Anual';
        $data_fact->fecha_corte       = "09/09/2019";
        $data_fact->importe           = "75$";
        $data_fact->save();

        $data_fact                    = new App\Facturacion;
        $data_fact->id_proveedor      = 1;
        $data_fact->servicio          = 'Dominio';
        $data_fact->ciclo_facturacion = 'Anual';
        $data_fact->fecha_corte       = "09/09/2019";
        $data_fact->importe           = "75$";
        $data_fact->save();

        for ($i=0; $i <= 20 ; $i++) { 
	        $data_fact                    = new App\Facturacion;
	        $data_fact->id_proveedor      = 1;
	        $data_fact->servicio          = 'Almacenamiento'.$i;
	        $data_fact->ciclo_facturacion = 'Anual';
	        $data_fact->fecha_corte       = "09/09/2019";
	        $data_fact->importe           = "75$";
	        $data_fact->save();
        }
    }
}
