<?php
 
use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierTableSeeder extends Seeder  
{
    public function run()
    {

        DB::table('supplier')->delete();

        $csvFile = base_path().'/database/migrations/files/supplier.csv';

        $suppliers = $this->csv_to_array($csvFile);

        DB::table('supplier')->insert($suppliers);

        //$this->firstRun();
       
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

    private function firstRun(){
        $suppliers = Supplier::all();
        foreach ($suppliers as $supplier) {
            $new = Supplier::find($supplier->id);
            $new->id = Supplier::get_uid();
            $new->save();
        }
    }
}