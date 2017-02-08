<?php 

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PriceTableSeeder extends Seeder
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
    		foreach (range(1,20) as $index) {

    			$br = ['MOA', 'MAR', 'FES', 'BAG', 'MOR', 'ARA', 'VSP', 'PAM', 'CEB', 'BAC', 'SML', 'ANG', 'AFV'];
    			$i = array_rand($br);
    			
	        DB::table('prize')->insert([
	            'item' => $faker->text($maxNbChars = 20),
	            'supplier' => $faker->name,
	            'branch' => $br[$i],
	            'class' => rand(1, 4),
	        ]);
	        
	        
    			$this->command->info($faker->text($maxNbChars = 20));
    			//$this->command->info($br[$i]);
    			//$this->command->info(rand(1, 4));
        }
        */

        DB::table('prize')->delete();
        //DB::connection('hr')->table('workexp')->delete();

        $csvFile = base_path().'/database/migrations/files/raffle-prize.csv';
        $datas = $this->csv_to_array($csvFile);
        DB::table('prize')->insert($datas);
        //DB::connection('hr')->table('workexp')->insert($datas);

        $this->command->info('imported!');


        $prizes = DB::table('prize')->get();

        foreach ($prizes as $key => $prize) {
        	if($prize->assigned>1) {
	        	foreach (range(2, $prize->assigned) as $key) {
	        		$this->command->info($prize->item);
	        		DB::table('prize')->insert([
							   ['item' => $prize->item, 
							   'supplier' =>  $prize->supplier,
							   'amount' =>  $prize->amount,
							   'class' =>  $prize->class,
							   'branch' =>  $prize->branch]
							]);

	        	}
        	}
        }

        DB::table('prize')
            ->whereNotNull('assigned')
            ->update(['assigned' => null]);






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
