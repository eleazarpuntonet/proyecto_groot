<?php
use App\Role;
use App\AssignedTableRoles;
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

      $json = file_get_contents("database/dataseed/RoleSeed.json");
      $json_data = json_decode($json,true);

      foreach ($json_data as $roleData) {
          $rol               = new App\Role;
          $rol->name         = $roleData['name'];
          $rol->display_name = $roleData['display_name'];
          $rol->description  = $roleData['description'];
          $rol->save();
      }

      $jsonA = file_get_contents("database/dataseed/AssignedTableRolesSeed.json");
      $json_dataA = json_decode($jsonA,true);

      foreach ($json_dataA as $assignRol) {
          $rol          = new App\AssignedTableRoles;
          $rol->user_id = $assignRol['user_id'];
          $rol->role_id = $assignRol['role_id'];
          $rol->save();
      }

      // $rol               = new App\Role;
      // $rol->name         = 'superadmin';
      // $rol->display_name = 'Super Administrador';
      // $rol->description  = 'Administrador de codigo de sitio';
      // $rol->save();

      // $rol               = new App\Role;
      // $rol->name         = 'usuario';
      // $rol->display_name = 'Usuario general';
      // $rol->description  = 'Usuario general';
      // $rol->save();
    }
  }
