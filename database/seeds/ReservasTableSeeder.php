<?php
use App\Reservas;
use Illuminate\Database\Seeder;

class ReservasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents("database/dataseed/ReservaSeed.json");
        $json_data = json_decode($json,true);
        Reservas::truncate();

        foreach ($json_data as $reserva) {
            $reserv                = new App\Reservas;
            $reserv->id_user       = $reserva['id_user'];
            $reserv->alcance       = $reserva['alcance'];
            $reserv->origen_a      = $reserva['origen_a'];
            $reserv->origen_b      = $reserva['origen_b'];
            $reserv->origen_det    = $reserva['origen_det'];
            $reserv->fecha_partida = $reserva['fecha_partida'];
            $reserv->fecha_retorno = $reserva['fecha_retorno'];
            $reserv->destino_a     = $reserva['destino_a'];
            $reserv->destino_b     = $reserva['destino_b'];
            $reserv->destino_det   = $reserva['destino_det'];
            $reserv->motivo        = $reserva['motivo'];
            $reserv->agenda        = $reserva['agenda'];
            $reserv->save();
        }

    }
}
