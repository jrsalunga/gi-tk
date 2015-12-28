<?php
 
use Illuminate\Database\Seeder;

class ChildrenTableSeeder extends Seeder  
{
    public function run()
    {

        DB::table('children')->delete();
        //DB::connection('hr')->table('children')->delete();

        $csvFile = base_path().'/database/migrations/files/children.csv';
        $datas = $this->csv_to_array($csvFile);
        DB::table('children')->insert($datas);
        //DB::connection('hr')->table('children')->insert($datas);

        $this->command->info('Children table seeded!');
       
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