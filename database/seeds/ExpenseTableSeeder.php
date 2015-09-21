<?php
 
use Illuminate\Database\Seeder;
use App\Models\Expense;

class ExpenseTableSeeder extends Seeder  
{
    public function run()
    {

        DB::table('expense')->delete();

        $csvFile = base_path().'/database/migrations/files/expense.csv';

        $expenses = $this->csv_to_array($csvFile);

        DB::table('expense')->insert($expenses);

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
        $expenses = Expense::all();
        foreach ($expenses as $expense) {
            $new = Expense::find($expense->id);
            $new->id = Expense::get_uid();
            $new->save();
        }
    }
}