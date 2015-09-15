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
                'password' => '$2y$10$eSVFnC9/RjstAhQM/iL0h.4PvxbxyWWqRiVe4jyqKVqkQJIc9bVTK',
                'id'=> '37AEA3955A9111E5815400FF59FBB323',
            ))
        );
       
    }
}