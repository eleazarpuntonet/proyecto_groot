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
            $auth             = new App\Autorizaciones;
            $auth->date_auth  = $autorizacion->date_auth;
            $auth->depto_id   = $autorizacion->depto_id;
            $auth->reserva_id = $autorizacion->reserva_id;
            $auth->save();
        }
    }
}
