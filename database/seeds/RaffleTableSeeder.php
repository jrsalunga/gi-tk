<?php

use Illuminate\Database\Seeder;

class RaffleTableSeeder extends Seeder
{


    public function run() {
    		
    	$this->reset();

        $prizes = DB::table('prize')
            ->orderBy('class', 'desc')
            ->orderBy('amount', 'asc')
            ->get();

        foreach ($prizes as $key => $prize) {
        	
        	// query employees
        	$persons = DB::table('person')
                                        ->where('class', '=', $prize->class) // 
        								->where('prize_id', 0) // 
        								->get();
        								
    			
    			$this->command->info('Class '.$prize->class. ' prize from '.$prize->branch);
    			$this->command->info('Getting from '.count($persons).' employees');
        	
        	
            // pili nang employee random galing sa query
            if(count($persons)>0)
                $winner = $persons[mt_rand(0, count($persons) - 1)];
            else
                continue;

            
        	// show winner
        	$this->displayWinner($prize, $winner);

        	// update person's prize
    			$this->updateTables($prize, $winner);
        
        }
    }


    public function displayWinner($prize, $person) {
    	
    	$this->command->info('----------------------------------------------------------');
    	$this->command->info('Item: '.$prize->item.'    Class: '.$prize->class);
        //sleep(2);
    	$this->command->info(' ');
    	$this->command->info('Winner -> ***** '. $person->name.' - '.$person->branch. ' - '.$person->class.' *****');
    	$this->command->info('----------------------------------------------------------');
    	$this->command->info(' ');
    	
        

        //sleep(1);
    }



    private function logAction($action, $log) {
        $logfile = base_path().DIRECTORY_SEPARATOR.'logs'.DIRECTORY_SEPARATOR.'raffle.txt';

        $dir = pathinfo($logfile, PATHINFO_DIRNAME);

        if(!is_dir($dir))
            mkdir($dir, 0775, true);

        $new = file_exists($logfile) ? false : true;
        if($new){
            $handle = fopen($logfile, 'w+');
            chmod($logfile, 0775);
        } else
            $handle = fopen($logfile, 'a');

       
       
        $content = date('r')." | {$action} | {$log} \n";
    fwrite($handle, $content);
    fclose($handle);
    }   

    


    private function reset() {

     	DB::table('person')
            ->whereNotNull('prize_id')
            ->update(['prize_id' => 0]);

        DB::table('prize')
            ->whereNotNull('assigned')
            ->update(['assigned' => 0]);

    }


    private function updateTables($prize, $person) {

    	DB::table('person')
           	->where('id', $person->id)
            ->update(['prize_id' => $prize->id]);

        DB::table('prize')
           	->where('id', $prize->id)
            ->update(['assigned' => $person->id]);
    }
}
