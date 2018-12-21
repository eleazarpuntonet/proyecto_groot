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
            $departamentos                 = new App\Departamentos;
            $departamentos->disp_name      = $department->disp_name;
            $departamentos->ref            = $department->ref;
            $departamentos->save();
        }
    }
}
