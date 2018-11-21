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
        $this->call(ProveedoresTableSeeder::class);
        $this->call(SitesTableSeeder::class);
        $this->call(CredencialesTableSeeder::class);
        $this->call(FacturacionTableSeeder::class);
    }
}
