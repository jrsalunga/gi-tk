<?php
 
use Illuminate\Database\Seeder;

class ReligionTableSeeder extends Seeder  
{
    public function run()
    {

        DB::table('religion')->delete();
        //DB::connection('hr')->table('religion')->delete();

        $csvFile = base_path().'/database/migrations/files/religion.csv';
        $employees = $this->csv_to_array($csvFile);
        
        DB::table('religion')->insert($employees);
        //DB::connection('hr')->table('religion')->insert($employees);

        $this->command->info('Religion table seeded!');
       
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
}