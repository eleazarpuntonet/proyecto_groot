<?php
use App\Autorizaciones;
use Illuminate\Database\Seeder;

class AutorizacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$data = File::get("database/dataseed/AutorizacionesSeed.json");
    	$autorizaciones = json_decode($data);
    	Autorizaciones::truncate();

        foreach ($autorizaciones as $autorizacion) {


            $auth                 = new App\Autorizaciones;
            $auth->id             = $autorizacion->id;
            $auth->autorizable_id = $autorizacion->autorizable_id;
            $auth->recurso        = $autorizacion->recurso;
            $auth->valor          = $autorizacion->valor;
            $auth->date_auth      = $autorizacion->date_auth;
            $auth->save();
        }
    }
}
