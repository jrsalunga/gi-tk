<?php
 
use Illuminate\Database\Seeder;

class ExpscatTableSeeder extends Seeder  
{
    public function run()
    {

        DB::table('expscat')->delete();

        DB::table('expscat')->insert(array(
            array(
                'code' => '05',
                'descriptor' => 'Means Food Cost',
                'id'=> '7208AA3F5CF111E5ADBC00FF59FBB323'
            ),
            array(
                'code' => '08',
                'descriptor' => 'Means Operation',
                'id'=> '8A1C2FF95CF111E5ADBC00FF59FBB323'
            ))
        );
       
    }
}