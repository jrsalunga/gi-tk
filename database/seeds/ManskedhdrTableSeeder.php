<?php
 
use Illuminate\Database\Seeder;

class ManskedhdrTableSeeder extends Seeder  
{
    public function run()
    {

        DB::table('manskedhdr')->delete();

        DB::table('manskedhdr')->insert(array(
            array(
                'refno' => '001',
                'date' => '2015-09-14',
                'branchid' => '99265B80A5C211E385D3C0188508F93C',
                'managerid' => '058FD717BEAE11E39AE474D02BCA8A4B',
                'weekno' => '33',
                'mancost' => '11',
                'id' => 'A7AECDD2666611E596ECDA40B3C0AA12'
            ))
        );

        $this->command->info('Manskedhdr table seeded!');
       
    }
}