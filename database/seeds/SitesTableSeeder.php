<?php
use App\Sites;
use Illuminate\Database\Seeder;

class SitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Sites::truncate();
    	
        $site          = new App\Sites;
        $site->dominio = 'spservicesltd.uk';
        $site->hosting = 1;
        $site->ip_site = '212.129.10.190';
        $site->status  = 'Activo';
        $site->save();

        $site          = new App\Sites;
        $site->dominio = 'manuelchinchilladasilva.com';
        $site->hosting = 1;
        $site->status  = 'Activo';
        $site->save();

        for ($i=0; $i <= 20 ; $i++) { 
        	$site          = new App\Sites;
        	$site->dominio = 'manuelchinchilladasilva'.$i.'.com';
        	$site->hosting = 1;
        	$site->status  = 'Activo';
        	$site->save();
        }
    }
}
