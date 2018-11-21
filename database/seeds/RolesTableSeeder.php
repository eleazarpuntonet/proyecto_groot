<?php
use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $rol                   = new App\Role;
       $rol->name             = 'analist';
       $rol->display_name     = 'Analista de Area';
       $rol->description      = 'Analista';
       $rol->save();

       $rol                   = new App\Role;
       $rol->name             = 'gerente';
       $rol->display_name     = 'Gerente de Departamento';
       $rol->description      = 'Gerente';
       $rol->save();

       $rol                   = new App\Role;
       $rol->name             = 'coord';
       $rol->display_name     = 'Coordinador de Departamento';
       $rol->description      = 'Coordinador';
       $rol->save();


       for ($i=0; $i <= 5 ; $i++) { 
	       $rol                   = new App\Role;
	       $rol->name             = 'Rol '.$i;
	       $rol->display_name     = 'Rol '.$i.' de Departamento';
	       $rol->description      = 'Coordinador'.$i.;
	       $rol->save();
       }
    }
}
