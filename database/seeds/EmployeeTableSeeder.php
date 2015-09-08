<?php
 
use Illuminate\Database\Seeder;

class EmployeeTableSeeder extends Seeder  
{
    public function run()
    {

        DB::table('employee')->delete();

        DB::table('employee')->insert(array(
            array(
                'code' => 'jrsalunga',
                'lastname' => 'Salunga',
                'firstname' => 'Jefferson',
                'middlename' => 'Raga',
                'position' => 'IT Staff',
                'branchid'=> '99265B80A5C211E385D3C0188508F93C',
                'punching' => 1,
                'processing' => 1,
                'id'=> '058FD717BEAE11E39AE474D02BCA8A4B'
            ),
            array(
                'code' => 'dylim',
                'lastname' => 'Lim',
                'firstname' => 'Dennis',
                'middlename' => 'Yap',
                'position' => 'IT Head',
                'branchid'=> '99265B80A5C211E385D3C0188508F93C',
                'punching' => 1,
                'processing' => 1,
                'id'=> 'BD589EF4B0D411E3A0ECC0188508F93C'
            ))
        );
       
    }
}