<?php
use App\Proveedor;
use Illuminate\Database\Seeder;

class ProveedoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Proveedor::truncate();

    	$proveedor                  = new App\Proveedor;
    	$proveedor->nombre          = 'GoDaddy.com';
    	$proveedor->r_social        = 'GoDaddy';
    	$proveedor->rif             = 'Indefinido';
    	$proveedor->t_contribuyente = 'Indefinido';
    	$proveedor->direccion       = 'Indefinido';
    	$proveedor->user_session    = '1';
    	$proveedor->observaciones   = '';
    	$proveedor->save();

    	$proveedor                  = new App\Proveedor;
    	$proveedor->nombre          = 'Dongee.com';
    	$proveedor->r_social        = 'Dongee';
    	$proveedor->rif             = 'Indefinido';
    	$proveedor->t_contribuyente = 'Indefinido';
    	$proveedor->direccion       = 'Indefinido';
    	$proveedor->user_session    = '1';
    	$proveedor->save();

    	for ($i=0; $i <= 20 ; $i++) { 
	    	$proveedor                  = new App\Proveedor;
	    	$proveedor->nombre          = 'GoDaddy'.$i.'.com';
	    	$proveedor->r_social        = 'GoDaddy'.$i;
	    	$proveedor->rif             = 'Indefinido';
	    	$proveedor->t_contribuyente = 'Indefinido';
	    	$proveedor->direccion       = 'Indefinido';
	    	$proveedor->user_session    = '1';
	    	$proveedor->observaciones   = $i;
	    	$proveedor->save();
    	}
    }
}
