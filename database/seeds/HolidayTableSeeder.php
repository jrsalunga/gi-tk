<?php

use Illuminate\Database\Seeder;

class HolidayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('holiday')->delete();

        DB::table('holiday')->insert(array(
            array(
                'code' => 'APEC2015',
                'descriptor' => 'Asia Pacific Economy Cooperation',
                'type' => 2,
                'isregional'=> 0,
                'id' => '11CCDAED8CD511E5B5364CE38F22FD8F'
            ))
        );

        $this->command->info('Holiday table seeded!');
    }
}
