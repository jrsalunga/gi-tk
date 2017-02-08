<?php
 
use Illuminate\Database\Seeder;

class TimelogTableSeeder extends Seeder  
{
    public function run()
    {

        DB::table('timelog')->delete();
        $csvFile = base_path().'/database/migrations/files/glv-timelog-20160405.csv';
        $timelogs = $this->csv_to_array($csvFile);
        DB::table('timelog')->insert($timelogs);


        $this->command->info('Timelog table seeded!');
       
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