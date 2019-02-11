<?php

namespace App\Providers;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use App\Notifications\Notificaciontest;
use App\User;

// class NuevaReserva implements ShouldBroadcastNow
class NuevaReserva implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $notif;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        

        $usuario_reserva      = User::find($data->id_user);
        $coordinador          = User::find($usuario_reserva->departamento->coordinador->id);

        $mensaje              = new \stdClass();
        $mensaje->user        = $usuario_reserva->name.' '.$usuario_reserva->last_name;
        $mensaje->userid      = $usuario_reserva->id;
        $mensaje->recipient   = $coordinador->name.' '.$coordinador->last_name;
        $mensaje->recipientid = $coordinador->id;
        $mensaje->reservaid   = $data->id;
        $mensaje->datereserva = date('Y-m-d H:i:s');
        $mensaje->text        = 'ah generado una reserva';
        $notificacion         = new Notificaciontest($mensaje);
        
        $coordinador->notify($notificacion);
        $this->notif          = $mensaje;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('reservas-channel');
    }

    public function broadcastWith()
    {
        return [
            'data' => $this->notif,
        ];
    }
}
