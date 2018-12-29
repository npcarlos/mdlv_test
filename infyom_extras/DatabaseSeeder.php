<?php

use Illuminate\Database\Seeder;
//use App\Models\DocumentType;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $directorio = "database/seeds/json_seeds/";
        $archivos  = scandir($directorio);
        
        for($i = 2; $i < sizeof($archivos); $i++)
        {
            $nombre = explode(".", $archivos[$i])[1];
           
            $fullPath = "App\Models\\" . $nombre;
            echo "Seeding ". $i.") ".$fullPath ."...\n";
            $instance = (new $fullPath());
            
            $table = $instance->table;
            
            $json = File::get("database/seeds/json_seeds/" . $archivos[$i]);
            
            DB::table($table)->delete();
            
            $data = json_decode($json, true);
            
            foreach ($data as $obj)
            {
                $instance::create($obj);
            }
            
        }
        
        
    }
}
