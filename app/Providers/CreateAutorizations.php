<?php

namespace App\Providers;
use App\Reservas;
use App\Autorizaciones;
use App\User;
use App\Providers\NuevaReserva;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateAutorizations implements ShouldQueue
// class CreateAutorizations
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public $tries = 10;
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NuevaReserva  $event
     * @return void
     */
    public function handle(NuevaReserva $event)
    {
        // $reserva                  = $event->reserva;
        // $user                     = $event->gerente;

        // $autorizacion             = new Autorizaciones;
        // $autorizacion->recurso    = 'Reserva';
        // $autorizacion->valor      = 'Standby';
        // $autorizacion->depto_id   = $user->departamento->id;
        // $autorizacion->reserva_id = $reserva->id;
        // $autorizacion->date_auth  = date('Y-m-d H:i:s');
        // $reserva->autorizaciones()->save($autorizacion);

        // $autorizacion             = new Autorizaciones;
        // $autorizacion->recurso    = 'Viatico';
        // $autorizacion->valor      = 'Standby';
        // $autorizacion->depto_id   = $user->departamento->id;
        // $autorizacion->reserva_id = $reserva->id;
        // $autorizacion->date_auth  = date('Y-m-d H:i:s');
        // $reserva->autorizaciones()->save($autorizacion);

        $var = 'hizo algo';
    }

    public function failed(Exception $exception)
    {
        return "algo salio mal";
    }
}
