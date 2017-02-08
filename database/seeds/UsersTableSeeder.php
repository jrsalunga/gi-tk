<?php
 
use Illuminate\Database\Seeder;
use App\Models\Branch;

class UsersTableSeeder extends Seeder  
{
    public function run()
    {

        DB::table('users')->delete();

        $branches = Branch::all();

        $users = [];
        foreach ($branches as $branch) {

            array_push($users, [
                'username' => strtolower($branch->code).'-manager',
                'name' => $branch->code.' Manager',
                'branchid'=> $branch->id,
                'email' => strtolower($branch->code).'-manager@giligansrestaurant.com',
                'password' => bcrypt('giligans'),
                'id' => $branch->id
            ]);
            

            $this->command->info(strtolower($branch->code).'-manager created!');
        }

        DB::table('users')->insert($users);

        $this->command->info('Users table seeded!');


       
       
    }
}