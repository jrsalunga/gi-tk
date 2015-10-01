<?php
 
use Illuminate\Database\Seeder;

class PositionTableSeeder extends Seeder  
{
    public function run()
    {

        DB::table('position')->delete();

        DB::table('position')->insert(array(
            array(
                'code' => 'SBM',
                'descriptor' => 'Senior Branch Manager',
                'id'=> 'A7AECDD2666611E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'BM',
                'descriptor' => 'Branch Manager',
                'id'=> 'B0092A7B666611E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'DS',
                'descriptor' => 'Dining Supervisor',
                'id'=> 'B3622DDF666611E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'DA',
                'descriptor' => 'Dining Assistant',
                'id'=> '8EF16963673A11E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'SKH',
                'descriptor' => 'Senior Kitchen Head',
                'id'=> '4C97B1DD673B11E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'KH',
                'descriptor' => 'Kitchen Head',
                'id'=> 'CD359BD0673A11E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'KA',
                'descriptor' => 'Kitchen Assistant',
                'id'=> 'D02091AB673A11E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'MT',
                'descriptor' => 'Management Trainee',
                'id'=> 'EC5ED785673A11E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'CAS',
                'descriptor' => 'Cashier',
                'id'=> 'B688FC60666611E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'DC',
                'descriptor' => 'Dining Crew',
                'id'=> '2862BBA2673B11E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'KC',
                'descriptor' => 'Kitchen Crew',
                'id'=> '2DA8CBFE673B11E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'UTI',
                'descriptor' => 'Utility',
                'id'=> '67B0F27F673B11E596ECDA40B3C0AA12'
            ))
        );

        $this->command->info('Postion table seeded!');
       
    }
}