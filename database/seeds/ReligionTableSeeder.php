<?php
 
use Illuminate\Database\Seeder;

class ReligionTableSeeder extends Seeder  
{
    public function run()
    {

        DB::table('religion')->delete();

        DB::table('religion')->insert(array(
            array(
                'code' => 'RC',
                'descriptor' => 'Roman Catholic',
                'id' => '1A95F32E674811E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'CH',
                'descriptor' => 'Christian',
                'id' => '2975665F674811E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'INC',
                'descriptor' => 'Iglesia Ni Cristo',
                'id' => '2D6A8A3A674811E596ECDA40B3C0AA12'
            ))
        );

        $this->command->info('Religion table seeded!');
       
    }
}