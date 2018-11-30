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
        $users_json = File::get("database/dataseed/UserSeed.json");
        $data = json_decode($users_json);
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        // User::enableForeignKeyConstraints();

        $rol_superadmin               = new App\Role;
        $rol_superadmin->name         = 'superadmin';
        $rol_superadmin->display_name = 'Super Administrador';
        $rol_superadmin->description  = 'Administrador de codigo de sitio';
        $rol_superadmin->save();

        $rol_tester               = new App\Role;
        $rol_tester->name         = 'tester';
        $rol_tester->display_name = 'Administrador de Testeo';
        $rol_tester->description  = 'Administrador de testing de sitio';
        $rol_tester->save();

        $rol_admin               = new App\Role;
        $rol_admin->name         = 'admin';
        $rol_admin->display_name = 'Administrador';
        $rol_admin->description  = 'Administrador de sitio';
        $rol_admin->save();

    	$user            = new App\User;
    	$user->name      = 'Eleazar';
    	$user->last_name = 'Ortega';
    	$user->cargo     = 'Programador';
        $user->gerencia  = 1;
        $user->sede      = 'Chuao';
        $user->status    = 'Activo';
        $user->email     = 'eleazaro@spservicesltd.uk';
        $user->password  = bcrypt('123123');
        $user->save();
        $user->roles()->save($rol_superadmin);
        $user->roles()->save($rol_tester);
        $user->roles()->save($rol_admin);

    	$user            = new App\User;
    	$user->name      = 'Luis';
    	$user->last_name = 'Depablos';
    	$user->cargo     = 'Analista de Soporte';
    	$user->gerencia  = 1;
    	$user->sede      = 'Chuao';
    	$user->status    = 'Activo';
    	$user->email     = 'luisd@spservicesltd.uk';
    	$user->password  = bcrypt('123123');
    	$user->save();
        $user->roles()->save($rol_superadmin);
        $user->roles()->save($rol_tester);

    	$user            = new App\User;
    	$user->name      = 'Yonny';
    	$user->last_name = 'Tamayo';
    	$user->cargo     = 'Analista de Soporte';
    	$user->gerencia  = 1;
    	$user->sede      = 'Chuao';
    	$user->status    = 'Activo';
    	$user->email     = 'yonnyt@spservicesltd.uk';
    	$user->password  = bcrypt('123123');
        $user->save();
        $user->roles()->save($rol_superadmin);
        $user->roles()->save($rol_tester);

        foreach ($data as $dataUser) {
            $user            = new App\User;
            $user->name      = $dataUser->name;
            $user->last_name = $dataUser->last_name;
            $user->cargo     = $dataUser->cargo;
            $user->gerencia  = $dataUser->gerencia;
            $user->sede      = $dataUser->sede;
            $user->email     = $dataUser->email;
            $user->status    = $dataUser->status;
            $user->password  = bcrypt($dataUser->password);
            $user->save();
            $user->roles()->save($rol_tester);
        }
        
    }
}
