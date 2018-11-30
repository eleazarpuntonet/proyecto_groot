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

    	$data = File::get("database/dataseed/DepartamentosSeed.json");
    	$departamentos = json_decode($data);
    	Departamentos::truncate();

        foreach ($departamentos as $department) {
            $depto                 = new App\Departamentos;
            $depto->disp_name      = $department->disp_name;
            $depto->ref            = $department->ref;
            $depto->gerente_id     = $department->gerente_id;
            $depto->coordinador_id = $department->coordinador_id;
            $depto->dependencia    = $department->dependencia;
            $depto->save();
        }
    }
}
