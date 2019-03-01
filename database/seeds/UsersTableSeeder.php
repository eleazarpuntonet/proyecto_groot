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
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');



        $user            = new App\User;
        $user->name      = 'Eleazar';
        $user->last_name = 'Ortega';
        $user->cargo     = 'Programador';
        $user->gerencia  = 4;
        $user->sede      = 'Chuao';
        $user->status    = 'Activo';
        $user->email     = 'eleazaro@spservicesltd.uk';
        $user->password  = bcrypt('123123');
        $user->save();
        $user->roles()->attach(1);
        $user->roles()->attach(2);
        $user->roles()->attach(3);
        $user->roles()->attach(7);

        $user            = new App\User;
        $user->name      = 'Marialin';
        $user->last_name = 'Lacourt';
        $user->cargo     = 'Periodista';
        $user->gerencia  = 8;
        $user->sede      = 'Chuao';
        $user->status    = 'Activo';
        $user->email     = 'marialinl@spservicesltd.uk';
        $user->password  = bcrypt('123123');
        $user->save();
        // $user->roles()->attach(1);
        // $user->roles()->attach(2);
        // $user->roles()->attach(3);
        // $user->roles()->attach(7);

        $user            = new App\User;
        $user->name      = 'Edgar';
        $user->last_name = 'Saltron';
        $user->cargo     = 'Coordinador';
        $user->gerencia  = 4;
        $user->sede      = 'Chuao';
        $user->status    = 'Activo';
        $user->email     = 'edgards@spservicesltd.uk';
        $user->password  = bcrypt('123123');
        $user->save();
        $user->roles()->attach(6);

        $user            = new App\User;
        $user->name      = 'Luis';
        $user->last_name = 'Depablos';
        $user->cargo     = 'Analista de Soporte';
        $user->gerencia  = 4;
        $user->sede      = 'Chuao';
        $user->status    = 'Activo';
        $user->email     = 'luisd@spservicesltd.uk';
        $user->password  = bcrypt('123123');
        $user->save();
        $user->roles()->attach(2);
        $user->roles()->attach(3);
        $user->roles()->attach(7);

        $user            = new App\User;
        $user->name      = 'Yonny';
        $user->last_name = 'Tamayo';
        $user->cargo     = 'Analista de Soporte';
        $user->gerencia  = 4;
        $user->sede      = 'Chuao';
        $user->status    = 'Activo';
        $user->email     = 'yonnyt@spservicesltd.uk';
        $user->password  = bcrypt('123123');
        $user->save();
        $user->roles()->attach(2);
        $user->roles()->attach(3);
        $user->roles()->attach(7);

        $user            = new App\User;
        $user->name      = 'Carlos';
        $user->last_name = 'Escobar';
        $user->cargo     = 'Gerente';
        $user->gerencia  = 1;
        $user->sede      = 'Chuao';
        $user->status    = 'Activo';
        $user->email     = 'carlose@spservicesltd.uk';
        $user->password  = bcrypt('123123');
        $user->save();
        $user->roles()->attach(5);

        $user            = new App\User;
        $user->name      = 'Ronald';
        $user->last_name = 'F';
        $user->cargo     = 'Diseñador';
        $user->gerencia  = 8;
        $user->sede      = 'Chuao';
        $user->status    = 'Activo';
        $user->email     = 'ronaldf@spservicesltd.uk';
        $user->password  = bcrypt('123123');
        $user->save();
        $user->roles()->attach(2);



        
    }
}
