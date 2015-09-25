<?php
 
use Illuminate\Database\Seeder;
use App\Models\Component;

class ComponentTableSeeder extends Seeder  
{
    public function run()
    {

        DB::table('component')->delete();

        $csvFile = base_path().'/database/migrations/files/component.csv';

        $components = $this->csv_to_array($csvFile);

        DB::table('component')->insert($components);

        //$this->updateId();

        $this->command->info('Component table seeded!');
       
    }


    private function csv_to_array($filename='', $delimiter=',') {
        if(!file_exists($filename) || !is_readable($filename))
            return FALSE;
     
        $header = NULL;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== FALSE)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
            {
                if(!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }

    private function updateId(){
        $components = Component::all();
        foreach ($components as $component) {
            $new = Component::find($component->id);
            $new->id = Component::get_uid();
            $new->save();
        }
    }
}