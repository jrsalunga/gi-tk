<?php 

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PersonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        $faker = Faker::create();
    		foreach (range(1,10) as $index) {

    			$br = ['MOA', 'MAR', 'FES', 'BAG', 'MOR', 'ARA', 'VSP', 'PAM', 'CEB', 'BAC', 'SML', 'ANG', 'AFV'];
    			$i = array_rand($br);
    			
	        DB::table('person')->insert([
	            'name' => $faker->name,
	            'branch' => $br[$i],
	            'class' => rand(1, 4),
	        ]);
	        
	        
    			$this->command->info($faker->name);
    			//$this->command->info($br[$i]);
    			//$this->command->info(rand(1, 4));
        }
        */

        DB::table('person')->delete();
        //DB::connection('hr')->table('workexp')->delete();

        $csvFile = base_path().'/database/migrations/files/raffle-person.csv';
        $datas = $this->csv_to_array($csvFile);
        DB::table('person')->insert($datas);

        $this->command->info('imported!');




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
