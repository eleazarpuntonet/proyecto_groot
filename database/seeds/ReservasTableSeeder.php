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
        $data = File::get("database/dataseed/ReservasSeed.json");
        $reservas = json_decode($data);
        Reservas::truncate();

        foreach ($reservas as $reserva) {
            $a                = new App\Reservas;
            $a->id_user       = $reserva->id_user;
            $a->alcance       = $reserva->alcance;
            $a->origen_a      = $reserva->origen_a;
            $a->origen_b      = $reserva->origen_b;
            $a->origen_det    = $reserva->origen_det;
            $a->fecha_partida = $reserva->fecha_partida;
            $a->fecha_retorno = $reserva->fecha_retorno;
            $a->destino_a     = $reserva->destino_a;
            $a->destino_b     = $reserva->destino_b;
            $a->destino_det   = $reserva->destino_det;
            $a->motivo        = $reserva->motivo;
            $a->agenda        = $reserva->agenda;
            $a->save();
        }
    }
}
