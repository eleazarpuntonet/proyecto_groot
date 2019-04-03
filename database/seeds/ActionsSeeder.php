<?php
use App\ActionsAuth;
use App\actions_roles;
use Illuminate\Database\Seeder;

class ActionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
        public function run()
        {
            $json = file_get_contents("database/dataseed/ActionsauthSeed.json");
            $json_data = json_decode($json,true);
            ActionsAuth::truncate();
            foreach ($json_data as $actions) {
    			$actionAuth                 = new App\ActionsAuth;
    			$actionAuth->pathitem_id    = $actions['action_id'];
    			$actionAuth->pathitem_name  = $actions['action_name'];
    			$actionAuth->pathitem_desc  = $actions['action_desc'];
    			$actionAuth->pathitem_desc  = $actions['action_permissions'];
    			$actionAuth->save();
            }

            $json = file_get_contents("database/dataseed/ActionsrolesSeed.json");
            $json_data = json_decode($json,true);
            actions_roles::truncate();
            foreach ($json_data as $asgrole) {
    			$assgnrole               = new App\actions_roles;
    			$assgnrole->pathitem_id  = $asgrole['action_id'];
    			$assgnrole->role_id      = $asgrole['role_id'];
    			$assgnrole->save();
            }
        }
}
