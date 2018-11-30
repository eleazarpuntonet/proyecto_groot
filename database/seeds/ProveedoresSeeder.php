<?php
use App\Proveedor;
use Illuminate\Database\Seeder;

class ProveedoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    		$file = 'ProveedoresSeed.json';
        	$data = File::get("database/dataseed/".$file);
        	$proveedores = json_decode($data);
        	Proveedor::truncate();

            foreach ($proveedores as $proveedor) {
                $proveedores                  = new App\Proveedor;
                $proveedores->nombre          = $proveedor->nombre;
                $proveedores->r_social        = $proveedor->r_social;
                $proveedores->rif             = $proveedor->rif;
                $proveedores->t_contribuyente = $proveedor->t_contribuyente;
                $proveedores->dir             = $proveedor->dir;
                $proveedores->autor           = $proveedor->autor;
                $proveedores->save();
            }
    }
}
