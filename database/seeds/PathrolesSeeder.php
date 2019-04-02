<?php
use App\Tableauthrole;
use App\Tableassgnauthrole;
use Illuminate\Database\Seeder;

class PathrolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents("database/dataseed/PathItemSeed.json");
        $json_data = json_decode($json,true);
        Tableauthrole::truncate();
        foreach ($json_data as $path) {
			$pathItem                 = new App\Tableauthrole;
			$pathItem->pathitem_id    = $path['pathitem_id'];
			$pathItem->pathitem_name  = $path['pathitem_name'];
			$pathItem->pathitem_desc  = $path['pathitem_desc'];
			$pathItem->save();
        }

        $json = file_get_contents("database/dataseed/PathAssignSeed.json");
        $json_data = json_decode($json,true);
        Tableassgnauthrole::truncate();
        foreach ($json_data as $assignpath) {
			$pathItem               = new App\Tableassgnauthrole;
			$pathItem->pathitem_id  = $assignpath['pathitem_id'];
			$pathItem->role_id      = $assignpath['role_id'];
			$pathItem->save();
        }
    }
}
