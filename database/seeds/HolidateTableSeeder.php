<?php

use Illuminate\Database\Seeder;

class HolidateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('holidate')->delete();

        DB::table('holidate')->insert(array(
            array(
                'date' => '2015-11-13',
                'holidayid' => '11CCDAED8CD511E5B5364CE38F22FD8F',
                'id' => 'D91AFDE78CD411E5B5364CE38F22FD8F'
            ))
        );

        $this->command->info('Holidate table seeded!');
    }
}
