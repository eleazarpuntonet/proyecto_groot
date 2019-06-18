<?php
use App\Matequipos;
use Illuminate\Database\Seeder;

class MaterialesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$json = file_get_contents("database/dataseed/MaterialesSeed.json");
		$json_data = json_decode($json,true);
		Matequipos::truncate();

		foreach ($json_data as $mat) {
		   $material              = new App\Matequipos;
		   $material->nombre      = $mat['nombre'];
		   $material->descripcion = $mat['descripcion'];
		   $material->unidad      = $mat['unidad'];
		   $material->tipo        = $mat['tipo'];
		   $material->save();
		}
    }
}
