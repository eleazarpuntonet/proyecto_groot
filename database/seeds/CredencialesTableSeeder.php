<?php
use App\Credenciales;
use Illuminate\Database\Seeder;

class CredencialesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Credenciales::truncate();

       $credenciales              = new App\Credenciales;
       $credenciales->id_site     = 1;
       $credenciales->descripcion = 'Wordpress';
       $credenciales->user        = 'admin';
       $credenciales->passw       = 'SPSvzla*17*';
       $credenciales->comentarios = 'ACTIVO';
       $credenciales->save();

       $credenciales              = new App\Credenciales;
       $credenciales->id_site     = 1;
       $credenciales->descripcion = 'Wordpress';
       $credenciales->user        = 'admin';
       $credenciales->passw       = 'Sps2018$';
       $credenciales->comentarios = 'ACTIVO';
       $credenciales->save();

       for ($i=0; $i <= 20 ; $i++) { 
	       	$credenciales              = new App\Credenciales;
	       	$credenciales->id_site     = 1;
	       	$credenciales->descripcion = 'Wordpress'.$i;
	       	$credenciales->user        = 'admin'.$i;
	       	$credenciales->passw       = 'Sps2018$'.$i;
	       	$credenciales->comentarios = 'ACTIVO';
	       	$credenciales->save();
       }
    }
}
