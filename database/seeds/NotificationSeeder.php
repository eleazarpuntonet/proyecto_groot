<?php
use App\Notificationtests;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $Yraslados = File::get("database/dataseed/NotificationsSeed.json");
        $traslados = json_decode($Yraslados);
        
        Notificationtests::truncate();
        foreach (json_decode($Yraslados) as $notificacion) {
          $notif                  = new App\Notificationtests;
          $notif->type            = $notificacion->type;
          $notif->notifiable_type = $notificacion->notifiable_type;
          $notif->notifiable_id   = $notificacion->notifiable_id;
          $notif->data            = $notificacion->data;
          $notif->read_at         = $notificacion->read_at;
          $notif->created_at      = $notificacion->created_at;
          $notif->updated_at      = $notificacion->updated_at;
          $notif->save();
        }
    }
}
