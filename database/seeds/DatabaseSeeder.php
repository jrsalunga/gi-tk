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

        $this->call(UsersTableSeeder::class);
        $this->command->info('Users table seeded!');

        $this->call(ExpscatTableSeeder::class);
        $this->command->info('Expscat table seeded!');
        
        $this->call(ExpenseTableSeeder::class);
        $this->command->info('Expense table seeded!');

        $this->call(SupplierTableSeeder::class);
        $this->command->info('Supplier table seeded!');

        $this->call(DepartmentTableSeeder::class);

        $this->call(CompcatTableSeeder::class);
        
        $this->call(ComponentTableSeeder::class);

        $this->call(PositionTableSeeder::class);

        $this->call(CompanyTableSeeder::class);

        $this->call(ReligionTableSeeder::class);

        $this->call(ManskedhdrTableSeeder::class);

        $this->call(ManskeddayTableSeeder::class);

        Model::reguard();
    }
}
