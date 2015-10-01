<?php
 
use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder  
{
    public function run()
    {

        DB::table('department')->delete();

        DB::table('department')->insert(array(
            array(
                'code' => 'KIT',
                'descriptor' => 'Kitchen',
                'id' => '71B0A2D2674011E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'DIN',
                'descriptor' => 'Dining',
                'id' => '75B34178674011E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'OPS',
                'descriptor' => 'OPS',
                'id' => '201E68D4674111E596ECDA40B3C0AA12'
            ))
        );
       
    }
}