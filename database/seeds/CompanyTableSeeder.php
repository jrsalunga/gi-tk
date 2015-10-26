<?php
 
use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder  
{
    public function run()
    {

        DB::table('company')->delete();

        DB::table('company')->insert(array(
            array(
                'code' => 'AFC',
                'descriptor' => 'Alquiros Food Corporation',
                'id'=> '29E4E2FA672C11E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'FIJ',
                'descriptor' => 'Fijon -6 Foods',
                'id'=> '43B6B571673611E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'FIL',
                'descriptor' => 'Filbert\'s -6 Foods',
                'id'=> '57F10712673611E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'FFC',
                'descriptor' => 'FJN6 Food Corporation',
                'id'=> '5C010584673611E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'GIB',
                'descriptor' => 'Giligan\'s Island Baguio Incorporated',
                'id'=> '43400E83673811E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'GIC',
                'descriptor' => 'Giligan\'s Island Restaurant & Bar Cebu Corporation',
                'id'=> '6275CF5B673611E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'ION',
                'descriptor' => 'Ione -6 Foods',
                'id'=> '6A2F5687673611E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'NAT',
                'descriptor' => 'Nathanael -6 Foods',
                'id'=> '70F73EAD673611E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'NIK',
                'descriptor' => 'Nikder Six Foods',
                'id'=> '74B1CBDC673611E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'KAW',
                'descriptor' => 'Kawbinadit Corporation',
                'id'=> '7A859059673611E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'ROS',
                'descriptor' => 'Rose Four Diners',
                'id'=> '7E8F8AC3673611E596ECDA40B3C0AA12'
            ),
            array(
                'code' => 'SHA',
                'descriptor' => 'Sha Dine 6 Diners',
                'id'=> '81D62659673611E596ECDA40B3C0AA12'
            ))
        );

        $this->command->info('Company table seeded!');
       
    }
}