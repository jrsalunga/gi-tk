<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        //$this->call(UserTableSeeder::class);
        $this->call(EmployeeTableSeeder::class);
        $this->command->info('Employee table seeded!');

        $this->call(TimelogTableSeeder::class);
        $this->command->info('Timelog table seeded!');

        $this->call(BranchTableSeeder::class);
        $this->command->info('Branch table seeded!');

        Model::reguard();
    }
}
