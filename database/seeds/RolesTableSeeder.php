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
      $rol               = new App\Role;
      $rol->name         = 'superadmin';
      $rol->display_name = 'Super Administrador';
      $rol->description  = 'Administrador de codigo de sitio';
      $rol->save();

      $rol               = new App\Role;
      $rol->name         = 'tester';
      $rol->display_name = 'Administrador de Testeo';
      $rol->description  = 'Administrador de testing de sitio';
      $rol->save();

      $rol               = new App\Role;
      $rol->name         = 'admin';
      $rol->display_name = 'Administrador';
      $rol->description  = 'Administrador de sitio';
      $rol->save();

      $rol               = new App\Role;
      $rol->name         = 'analist';
      $rol->display_name = 'Analista de Area';
      $rol->description  = 'Analista';
      $rol->save();

      $rol               = new App\Role;
      $rol->name         = 'gerente';
      $rol->display_name = 'Gerente de Departamento';
      $rol->description  = 'Gerente';
      $rol->save();

      $rol               = new App\Role;
      $rol->name         = 'coord';
      $rol->display_name = 'Coordinador de Departamento';
      $rol->description  = 'Coordinador';
      $rol->save();
    }
  }
