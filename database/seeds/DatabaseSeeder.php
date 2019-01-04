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
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(DepartamentosSeeder::class);
        // $this->call(ProveedoresSeeder::class);
        // $this->call(SitesTableSeeder::class);
        // $this->call(CredencialesTableSeeder::class);
        // $this->call(FacturacionTableSeeder::class);
        $this->call(ReservasTableSeeder::class);
        $this->call(TrasladosSeeder::class);
        // $this->call(AutorizacionesSeeder::class);
        $this->call(ViaticosTableSeeder::class);
        // $this->call(AutorizacionesSeeder::class);
    }
}
