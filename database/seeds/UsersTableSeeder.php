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
                'username' => strtolower($branch->code).'-admin',
                'name' => $branch->code.' Admin',
                'branchid'=> $branch->id,
                'email' => strtolower($branch->code).'@giligansrestaurant.com',
                'password' => bcrypt('giligans'),
                'id' => $branch->id
            ]);
            

            $this->command->info($branch->descriptor);
        }

        DB::table('users')->insert($users);

        $this->command->info('Users table seeded!');


       
       
    }
}