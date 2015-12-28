<?php
 
use Illuminate\Database\Seeder;

class WorkexpTableSeeder extends Seeder  
{
    public function run()
    {

        DB::table('workexp')->delete();
        //DB::connection('hr')->table('workexp')->delete();

        $csvFile = base_path().'/database/migrations/files/workexp.csv';
        $datas = $this->csv_to_array($csvFile);
        DB::table('workexp')->insert($datas);
        //DB::connection('hr')->table('workexp')->insert($datas);

        $this->command->info('Workexp table seeded!');
       
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