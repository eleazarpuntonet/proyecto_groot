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

        $json = file_get_contents("database/dataseed/AutorizacionSeed.json");
        $json_data = json_decode($json,true);
    	Autorizaciones::truncate();

        foreach ($json_data as $autorizacion) {
            $auth                   = new App\Autorizaciones;
            $auth->id               = $autorizacion['id'];
            $auth->autorizable_id   = $autorizacion['autorizable_id'];
            $auth->autorizable_type = $autorizacion['autorizable_type'];
            $auth->recurso          = $autorizacion['recurso'];
            $auth->valor            = $autorizacion['valor'];
            $auth->date_auth        = $autorizacion['date_auth'];
            $auth->save();
        }
    }
}
