<?php
 
use Illuminate\Database\Seeder;

class EcpersonTableSeeder extends Seeder  
{
    public function run()
    {

        DB::table('ecperson')->delete();
        //DB::connection('hr')->table('ecperson')->delete();

        $csvFile = base_path().'/database/migrations/files/ecperson.csv';
        $datas = $this->csv_to_array($csvFile);
        DB::table('ecperson')->insert($datas);
        //DB::connection('hr')->table('ecperson')->insert($datas);

        $this->command->info('Ecperson table seeded!');
       
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