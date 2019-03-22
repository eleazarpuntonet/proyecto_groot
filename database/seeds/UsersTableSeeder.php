<?php
use App\User;
use App\Role;
use App\AssignedTableRoles;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents("database/dataseed/UserSeed.json");
        $json_data = json_decode($json,true);


        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // $user            = new App\User;
        // $user->name      = 'Administrador';
        // $user->last_name = 'Administrador';
        // $user->cargo     = 'Administrador';
        // $user->gerencia  = 1;
        // $user->sede      = 'Chuao';
        // $user->email     = 'it@spservicesltd.uk';
        // $user->status    = 'Activo';
        // $user->password  = bcrypt('321321');
        // $user->save();
        // $user->roles()->attach(1);

        foreach ($json_data as $userData) {
            $user                  = new App\User;
            $user->name            = ucwords(strtolower($userData['name']));
            $user->last_name       = ucwords(strtolower($userData['last_name']));
            $user->codigo_empleado = $userData['codigo_empleado'];
            $user->ci_usuario      = $userData['ci_usuario'];
            $user->cargo           = ucwords(strtolower($userData['cargo']));
            $user->gerencia        = $userData['gerencia'];
            $user->fecha_ing       = DateTime::createFromFormat('d/m/Y', '01/01/2017' );
            if (isset($userData['sexo'])) {
                $user->sexo        = $userData['sexo'];
            }
            if (isset($userData['sede'])) {
                $user->sede            = $userData['sede'];
            }
            if (isset($userData['avatar'])) {
                $user->avatar          = $userData['avatar'];
            }
            if (isset($userData['email'])) {
                $user->email           = $userData['email'];
            }
            $user->status          = 'NEW';
            $user->password        = bcrypt('321321');
            $user->save();
        }




        
    }
}
