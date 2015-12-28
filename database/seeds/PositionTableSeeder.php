<?php
 
use Illuminate\Database\Seeder;

class PositionTableSeeder extends Seeder  
{
     public function run()
    {

        DB::table('position')->delete();
        //DB::connection('hr')->table('position')->delete();

        $csvFile = base_path().'/database/migrations/files/position-no-ordinal.csv';
        //$csvFile = base_path().'/database/migrations/files/position-ordinal.csv';
        $datas = $this->csv_to_array($csvFile);
        
        DB::table('position')->insert($datas);
        //DB::connection('hr')->table('position')->insert($datas);

        $this->command->info('Position table seeded!');
       
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