<?php
 
use Illuminate\Database\Seeder;

class BranchTableSeeder extends Seeder  
{
    public function run()
    {

        DB::table('branch')->delete();

        DB::table('branch')->insert(array(
            array(
                'code' => 'main',
                'descriptor' => 'Main Office',
                'id'=> '99265B80A5C211E385D3C0188508F93C'
            ))
        );
       
    }
}