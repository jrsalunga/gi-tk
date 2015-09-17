<?php
 
use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchTableSeeder extends Seeder  
{
    public function run()
    {

        DB::table('branch')->delete();

        $csvFile = base_path().'/database/migrations/files/branch.csv';

        $branches = $this->csv_to_array($csvFile);

        DB::table('branch')->insert($branches);

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
        $branches = Branch::all();
        foreach ($branches as $branch) {
            $new = Branch::find($branch->id);
            $new->id = Branch::get_uid();
            $new->save();
        }
    }
}