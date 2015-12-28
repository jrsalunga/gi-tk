<?php
 
use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder  
{
    public function run()
    {

        DB::table('company')->delete();
        //DB::connection('hr')->table('company')->delete();

        DB::table('company')->insert(array(
        //DB::connection('hr')->table('company')->insert(array(
            array(
                'code' => 'AFC',
                'descriptor' => 'ALQUIROS FOOD CORPORATION',
                'id'=> '29E4E2FA672C11E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'FIJ',
                'descriptor' => 'FIJON-6 FOODS',
                'id'=> '43B6B571673611E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'FIL',
                'descriptor' => 'FILBERT\'S-6 FOODS',
                'id'=> '57F10712673611E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'FFC',
                'descriptor' => 'FJN6 FOOD CORPORATION',
                'id'=> '5C010584673611E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'GIB',
                'descriptor' => 'GILIGAN\'S ISLAND BAGUIO INCORPORATED',
                'id'=> '43400E83673811E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'GIC',
                'descriptor' => 'GILIGAN\'S ISLAND RESTAURANT & BAR CEBU CORPORATION',
                'id'=> '6275CF5B673611E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'ION',
                'descriptor' => 'IONE-6 FOODS',
                'id'=> '6A2F5687673611E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'NAT',
                'descriptor' => 'NATHANAEL-6 FOODS',
                'id'=> '70F73EAD673611E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'NIK',
                'descriptor' => 'NIKDER SIX FOODS',
                'id'=> '74B1CBDC673611E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'KAW',
                'descriptor' => 'KAWBINADIT CORPORATION',
                'id'=> '7A859059673611E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'ROS',
                'descriptor' => 'ROSE FOUR DINERS',
                'id'=> '7E8F8AC3673611E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'SHA',
                'descriptor' => 'SHA DINE 6 DINERS',
                'id'=> '81D62659673611E596ECDA40B3C0AA12'
            ))
        );

        $this->command->info('Company table seeded!');
       
    }
}