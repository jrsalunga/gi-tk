<?php
 
use Illuminate\Database\Seeder;
use App\Models\Employee;

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
                'branchid'=> '99265B80A5C211E385D3C0188508F93C',
                'punching' => 1,
                'processing' => 1,
                'id'=> 'BD589EF4B0D411E3A0ECC0188508F93C'
            ))
        );


        $csvFile = base_path().'/database/migrations/files/employees-mar.csv';

        $employees = $this->csv_to_array($csvFile);

        DB::table('employee')->insert($employees);

        //$this->updateId();
       
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
            $new->id = Employee::get_uid();
            $new->save();
        }
    }
}