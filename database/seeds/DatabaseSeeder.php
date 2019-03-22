<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(DepartamentosSeeder::class);
        $this->call(ReservasTableSeeder::class);
        $this->call(TrasladosSeeder::class);
        // $this->call(AutorizacionesSeeder::class);
        // $this->call(NotificationSeeder::class);
        // $this->call(ViaticosTableSeeder::class);
    }
}
