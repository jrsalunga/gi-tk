<?php
 
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder  
{
    public function run()
    {

        DB::table('users')->delete();

        DB::table('users')->insert(array(
            array(
                'username' => 'jrsalunga',
                'name' => 'Jefferson Salunga',
                'email' => 'jefferson.salunga@gmail.com',
                'branchid' => '99265B80A5C211E385D3C0188508F93C',
                'password' => '$2y$10$eSVFnC9/RjstAhQM/iL0h.4PvxbxyWWqRiVe4jyqKVqkQJIc9bVTK',
                'id'=> '058FD717BEAE11E39AE474D02BCA8A4B',
            ),
            array(
                'username' => '000104',
                'name' => 'Argel Ferrandiz',
                'email' => 'jargelfernandiz@gmail.com',
                'branchid' => 'F8056E535D0B11E5ADBC00FF59FBB323',
                'password' => '$2y$10$B6qlaAVmjWaqf1RFnHclxebu0ijsTk6JIj1poG.DVcUioVUxIKok2',
                'id'=> '37AC2D1C675011E5A0C600FF59FBB323',
            ),
            array(
                'username' => '001182',
                'name' => 'Louis Angelo Anteg',
                'email' => 'louisangeloanteg@ymail.com',
                'branchid' => '0BEED86278A711E587FA00FF59FBB323',
                'password' => '$2y$10$78xSeHB/8gqSXrAl81irY.fSGMqRNDjqC3FAjz0hL4YizUJihND7a',
                'id'=> '812791798EA111E5977F00FF59FBB323',
            ))
        );
       
    }
}