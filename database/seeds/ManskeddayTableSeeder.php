<?php
 
use Illuminate\Database\Seeder;

class ManskeddayTableSeeder extends Seeder  
{
    public function run()
    {

        DB::table('manskedday')->delete();

        DB::table('manskedday')->insert(array(
            array(
                'manskedid' => 'A7AECDD2666611E596ECDA40B3C0AA12',
                'date' => '2015-09-14',
                'custcount' => '1400',
                'headspend' => '200',
                'empcount' => '46',
                'id' => 'B0092A7B666611E596ECDA40B3C0AA12'
            ))
        );

        $this->command->info('Manskedday table seeded!');
       
    }
}