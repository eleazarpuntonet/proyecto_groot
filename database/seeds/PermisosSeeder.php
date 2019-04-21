<?php
use App\Permisos;
use Illuminate\Database\Seeder;

class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$file = 'PermisosSeed.json';
		$data = File::get("database/dataseed/".$file);
		$permisos = json_decode($data);
		Permisos::truncate();

		foreach ($permisos as $item) {
			$permiso            = new App\Permisos;
			$permiso->id        = $item->id;
			$permiso->role_id   = $item->role_id;
			$permiso->ruta_id   = $item->ruta_id;
			$permiso->action_id = $item->action_id;
			$permiso->lee       = $item->lee;
			$permiso->escribe   = $item->escribe;
			$permiso->modifica  = $item->modifica;
			$permiso->borra     = $item->borra;
			$permiso->save();
		}
    }
}
