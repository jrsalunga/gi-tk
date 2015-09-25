<?php
 
use Illuminate\Database\Seeder;
use App\Models\Compcat;

class CompcatTableSeeder extends Seeder  
{
    public function run()
    {

        DB::table('compcat')->delete();

        $csvFile = base_path().'/database/migrations/files/compcat.csv';

        $compcats = $this->csv_to_array($csvFile);

        DB::table('compcat')->insert($compcats);

        //$this->updateId();

        $this->command->info('Compcat table seeded!');
       
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
        $compcats = Compcat::all();
        foreach ($compcats as $compcat) {
            $new = Compcat::find($compcat->id);
            $new->id = Compcat::get_uid();
            $new->save();
        }
    }
}