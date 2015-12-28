<?php
 
use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeTableSeeder extends Seeder  
{
    public function run()
    {

        DB::table('employee')->delete();
        //DB::connection('hr')->table('employee')->delete();
        


        $csvFile = base_path().'/database/migrations/files/all-employee.csv';
        $employees = $this->csv_to_array($csvFile);
        DB::table('employee')->insert($employees);
        //DB::connection('hr')->table('employee')->insert($employees);

        //$csvFile = base_path().'/database/migrations/files/employees-mar.csv';
        //$employees = $this->csv_to_array($csvFile);
        //DB::table('employee')->insert($employees);

        //$this->updateId();

        $this->command->info('Employee table seeded!');
       
    }


    private function csv_to_array($filename='', $delimiter=',') {
        if(!file_exists($filename) || !is_readable($filename))
            return FALSE;
     
        $header = NULL;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== FALSE)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
            {
                if(!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }

    private function updateId(){
        $employees = Employee::all();
        foreach ($employees as $employee) {
            $new = Employee::find($employee->id);
            $new->code = str_pad($new->code, 6, '0', STR_PAD_LEFT);
            //$new->id = Employee::get_uid();
            $new->save();
        }
    }
}