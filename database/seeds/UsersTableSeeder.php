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
                'id'=> '37AEA3955A9111E5815400FF59FBB323',
            ),
            array(
                'username' => '000104',
                'name' => 'Argel Fernandiz',
                'email' => 'jargelfernandiz@gmail.com',
                'branchid' => 'F8056E535D0B11E5ADBC00FF59FBB323',
                'password' => '$2y$10$B6qlaAVmjWaqf1RFnHclxebu0ijsTk6JIj1poG.DVcUioVUxIKok2',
                'id'=> 'EFE3C1676B0A11E596ECDA40B3C0AA12',
            ))
        );
       
    }
}