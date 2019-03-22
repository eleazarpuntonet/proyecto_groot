<?php
use App\Departamentos;
use Illuminate\Database\Seeder;

class DepartamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $json = file_get_contents("database/dataseed/DepartamentoSeed.json");
        $json_data = json_decode($json,true);
    	Departamentos::truncate();

        foreach ($json_data as $department) {
            $departamentos                 = new App\Departamentos;
            $departamentos->disp_name      = $department['disp_name'];
            $departamentos->ceco      = $department['ceco'];
            if (isset($department['descripcion'])) {
                $departamentos->descripcion      = $department['descripcion'];
            }
            if (isset($department['gerente_id'])) {
                $departamentos->gerente_id      = $department['gerente_id'];
            }
            if (isset($department['coordinador_id'])) {
                $departamentos->coordinador_id      = $department['coordinador_id'];
            }
            if (isset($department['dependencia'])) {
                $departamentos->dependencia      = $department['dependencia'];
            }
            $departamentos->save();
        }
    }
}
