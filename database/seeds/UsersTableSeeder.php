<?php
use App\User;
use App\Roles;
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
        // User::truncate();
        // Roles::truncate();
        // DB::table('assigned_roles')->delete();

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

        $rol               = new App\Role;
        $rol->name         = 'superadmin';
        $rol->display_name = 'Super Administrador';
        $rol->description  = 'Administrador de codigo de sitio';
        $rol->save();

        $user->roles()->save($rol);

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

        $rol               = new App\Role;
        $rol->name         = 'tester';
        $rol->display_name = 'Administrador de Testeo';
        $rol->description  = 'Administrador de testing de sitio';
        $rol->save();

        // $user->roles()->save($rol);

    	$user            = new App\User;
    	$user->name      = 'Yonny';
    	$user->last_name = 'Tamayo';
    	$user->cargo     = 'Analista de Soporte';
    	$user->gerencia  = 1;
    	$user->sede      = 'Chuao';
    	$user->status    = 'Activo';
    	$user->email     = 'yonnyt@spservicesltd.uk';
    	$user->password  = bcrypt('123123');

        // $user->roles()->save($rol);

    	for ($i=0; $i <= 20 ; $i++) { 
	    	$user            = new App\User;
	    	$user->name      = 'User'.$i;
	    	$user->last_name = 'Lastaname'.$i;
	    	$user->cargo     = 'Analista';
	    	$user->gerencia  = $i;
	    	$user->sede      = 'Chuao';
	    	$user->status    = 'Activo';
	    	$user->email     = 'algo'.$i.'@spservicesltd.uk';
	    	$user->password  = bcrypt('123123');
	    	$user->save();
    	}
    }
}
