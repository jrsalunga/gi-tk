<?php

use Illuminate\Database\Seeder;

class HolidaydtlTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('holidaydtl')->delete();

        DB::table('holidaydtl')->insert(array(
            array(
                'holidayid' => '11CCDAED8CD511E5B5364CE38F22FD8F',
                'branchid' => 'F8056E535D0B11E5ADBC00FF59FBB323',
                'id'=> '07C695F88CD611E5B5364CE38F22FD8F'
            ))
        );

        $this->command->info('Holidaydtl table seeded!');
    }
}
