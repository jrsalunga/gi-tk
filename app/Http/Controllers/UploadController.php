<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Upload;
use App\Models\Branch;
use App\Models\Salesmtd;
use App\Models\Salesmtdhdr;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use Input;
use File;
use ZipArchive;
use Carbon\Carbon;
use DB;

class UploadController extends Controller {





	public function index() {
		return view('upload.index');
	} 



	public function postfile(Request $request) {

		//$request->file('pic');
		//$request->file('photo')->move($destinationPath);
		$filename = Input::file('pic')->getClientOriginalName();
		
		if(app()->environment()=='local') {
			$destinationPath = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR;
		} else {
			$destinationPath = '/home/server-admin/Public/maindepot/';
		}
		
		$fs = new Filesystem;
		if($fs->exists($destinationPath.$filename)){
			return json_encode(['error'=>'404', 'message'=> $destinationPath.$filename.' exist!']);
		} else {
			Input::file('pic')->move($destinationPath, $filename);
		}
		return json_encode(['success'=>'200']);

		$demo_mode = true;
		$upload_dir = public_path().'/uploads/';
		//$upload_dir = 'uploads/';
		$allowed_ext = array('jpg','jpeg','png','gif', 'zip');
		//if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
		//	exit_status('Error! Wrong HTTP method!');
		//}
		echo var_dump($_FILES['pic']);
		if(array_key_exists('pic',$_FILES) && $_FILES['pic']['error'] == 0 ){
			$pic = $_FILES['pic'];
			
			
			if(!in_array($this->get_extension($pic['name']),$allowed_ext)){
				$this->exit_status('Only '.implode(',',$allowed_ext).' files are allowed!');
			}	
			if($demo_mode){
				// File uploads are ignored. We only log them.
				$line = implode('		', array( date('r'), $_SERVER['REMOTE_ADDR'], $pic['size'], $pic['name']));
				file_put_contents('../logs/image-upload-log.txt', $line.PHP_EOL, FILE_APPEND);
				$this->exit_status('Uploads are ignored in demo mode.');
			}
			// Move the uploaded file from the temporary
			// directory to the uploads folder:
			if(move_uploaded_file($pic['tmp_name'], $upload_dir.$pic['name'])){
				$this->exit_status('File was uploaded successfuly!');
			}
		}
		$this->exit_status('Something went wrong with your upload!');
		// Helper functions
		
	}

	public function exit_status($str){
		echo json_encode(array('status'=>$str));
		exit;
	}
	public function get_extension($file_name){
		$ext = explode('.', $file_name);
		$ext = array_pop($ext);
		return strtolower($ext);
	}



	public function copyExtract()
	{
		$files = [
			'GC073115.ZIP',
			'GC083115.ZIP',
			'GC093015.ZIP',
			'GC103115.ZIP',
			'GC113015.ZIP',
			'GC123115.ZIP'
		];

		//$dirs = ['AFV', 'ANG', 'ARA', 'ATC', 'AVE'];
		//$dirs = ['BAG', 'BAL', 'BAT', 'CAL', 'CEB'];
		//$dirs = ['CLK', 'CMC', 'DCC', 'DIS', 'DAS'];
		//$dirs = ['FES', 'GAL', 'GLV', 'GRN', 'GTR'];
		//$dirs = ['HFT', 'HRB', 'HSL', 'ILO', 'KCC'];
		//$dirs = ['LAN', 'LIP', 'LSS', 'LUC', 'MAR'];
		//$dirs = ['MIL', 'MOA', 'MOL', 'MOR', 'NAG'];
		//$dirs = ['NOR', 'PAM', 'PAV', 'ROS', 'SAM'];
		//$dirs = ['SHW', 'SJD', 'SLE', 'SLP', 'SOU'];
		//$dirs = ['STG', 'SUB', 'TAG', 'TAY', 'TRI'];
		//$dirs = ['TUT', 'VAL', 'VSP', 'WVA'];
		//$dirs = ['SDH', 'SRC', 'STW'];

		$path = 'D:\GI-IMPORTS\\';
		//$dirs = array_diff(scandir($path), array('..', '.'));

		foreach ($dirs as $dir) {

			$branch = Branch::where('code', strtoupper($dir))->first();
			
			if (!is_null($branch)){

				echo $dir.' - '.$branch->descriptor.'</br>';
				
				foreach ($files as $file) {
					echo $file;
					$filepath = $path.DIRECTORY_SEPARATOR.$dir.DIRECTORY_SEPARATOR.$file;
					if (file_exists($filepath)) {
						echo ' extracting...<br>';

						$zip = new ZipArchive();
					  $zip_status = $zip->open($filepath);
					  //echo $zip_status.'<br>';
					  if ($zip_status === true)
					  {
					  		//echo 'extracting<br>';
					      if ($zip->setPassword("admate"))
					      {
					      		$path_to = 'D:\\GI-IMPORTS'.DIRECTORY_SEPARATOR.strtoupper($dir).DIRECTORY_SEPARATOR.substr($file, 0, 8);
					      		if (!file_exists($path_to)) {
										    mkdir($path_to, 0777, true);
										}

					          if (!$zip->extractTo($path_to))
					              echo "Extraction failed (wrong password?)";

					          //echo 'extracted to '. $path_to.'<br>';
					      }

					      $zip->close();
					  } else {
					      die("Failed opening archive: ". @$zip->getStatusString() . " (code: ". $zip_status .")");
					  }

					} else {
						echo ' file not found<br>';
					}
				}
			} 

			
		}
	}




	public function listExtract()
	{

		$files = [
			'GC073115',
			'GC083115',
			'GC093015',
			'GC103115',
			'GC113015',
			'GC123115'
		];
		
		$path = 'D:\GI-IMPORTS\\';
		$dirs = array_diff(scandir($path), array('..', '.'));

		echo '<table cellpadding="5" cellspacing="0" border="1"><tbody>';

		$ctr = 1;
		foreach ($dirs as $dir) {
			echo '<tr><td>';

			$code = strtoupper($dir);
			$branch = Branch::where('code', $code)->first();
			echo $ctr.'. ';
			if (!is_null($branch)){


				echo '<a href="/e/'.$branch->lid().'" target="_blank">';
				echo $code.' - '.$branch->descriptor;
				echo '</a>';

				foreach ($files as $file) {
					$path = 'D:\\GI-IMPORTS'.DIRECTORY_SEPARATOR.strtoupper($branch->code).DIRECTORY_SEPARATOR.strtoupper($file);
  				$x = is_dir($path) ? '':'*';

					echo '<td style="padding: 5px 15px;">';
					echo '<a href="/import-extract/'.strtolower($branch->id).'/'.strtolower($file).'" target="_blank">';
					echo substr($file, 0, 8);
					echo '</a>';
					echo $x.' </td>';


				}
				echo '<td><a href="/import-all/'.$branch->lid().'" target="_blank">All</a></td>';
				echo '</tr>';
			} else {
				echo $code;
				echo '<td colspan="7">not on database **********</td></tr>';
			}

			++$ctr;
		}
		echo '</table><br>&nbsp;* No Backup';
	} 



	public function browseSalesmtd(){
		$db = dbase_open('D:\GI-IMPORTS\BAT\GC093015\SALESMTD.DBF', 0);

		if ($db) {

			$header = dbase_get_header_info($db);
			
			echo '<table cellpadding="2" cellspacing="0" border="1"><thead>';

			// render table header
			echo '<tr>';
			foreach ($header as $key => $value) {
				echo '<th>'.$value['name'].'</th>';
			}
			echo '</tr>';
			
		 	// render table body
		 	$record_numbers = dbase_numrecords($db);
		  for($i = 1; $i <= $record_numbers; $i++) {

		    $row = dbase_get_record_with_names($db, $i);

		    echo '<tr>';
				foreach ($header as $key => $value) {
					echo '<td>'.$row[$value['name']].'</td>';
				}
				echo '</tr>';
		 }



			dbase_close($db);
		}

		
	}


	public function importAll(Request $request, $branchid) 
	{

		$branch = Branch::find($branchid);
		if(!is_null($branch)){


			$files = [
				'GC073115',
				'GC083115',
				'GC093015',
				'GC103115',
				'GC113015',
				'GC123115'
			];

			echo '<h1>importing data from '.$branch->code.' - '.$branch->descriptor.'</h1><br>';
			foreach ($files as $key => $file) {
				echo '<h4>';
				echo ($key+1).'. '.$file.'.ZIP <br>';
				$res = $this->importExtract2($request, $branch, $file);
				if (!is_array($res)) {
					echo $res;
				} else {
					echo $res['saved_ctr'].' record saved with '.$res['cus_ctr'].' customers';
				}

				echo '</h4>';
			}

			echo '<h3><a href="/e/'.$branch->lid().'" target="_blank">Generate '.$branch->code.'</a></h3>';

			return;
		}
		return 'Branch not found!';
	}




	public function importExtract2(Request $request, Branch $branch, $filename)
	{
		
			$path = 'D:\\GI-IMPORTS'.DIRECTORY_SEPARATOR.strtoupper($branch->code).DIRECTORY_SEPARATOR.strtoupper($filename);
  		if(!is_dir($path))
  			return 'No Backup...!';



  		//$date = substr('20151231', 0, 4).'-'.substr('20151231', 4, 2).'-'.substr('20151231', 6, 2);
  		//$salesmtd = Salesmtd::create(['tblno'=>'0', 'orddate'=>$date]);
  		//return $salesmtd;
  		
  		$db = dbase_open($path.DIRECTORY_SEPARATOR.'SALESMTD.DBF', 0);

			if ($db) {
				$header = dbase_get_header_info($db);
			
			 	$record_numbers = dbase_numrecords($db);
			 	$saved_ctr = 0;
			 	$cus_ctr = 0;
			  for($i = 1; $i <= $record_numbers; $i++) {

			    $row = dbase_get_record_with_names($db, $i);

			    $attributes = [];
					foreach ($header as $key => $value) {
						if($value['name']=='ORDDATE' && !empty(trim($row['ORDDATE']))){
							$date = substr(trim($row[$value['name']]), 0, 4).'-'
											.substr(trim($row[$value['name']]), 4, 2).'-'
											.substr(trim($row[$value['name']]), 6, 1);

											//echo $date.' - '.$row['ORDTIME'].' ';
							
							$attributes['orddate'] = Carbon::parse($date)->format('Y-m-d');
							
						}
						$attributes[strtolower($value['name'])] = trim($row[$value['name']]);
					}
					$attributes['branchid'] = strtoupper($branch->id);
					
  				//$salesmtd = Salesmtd::create($attributes);
  				//echo $i.'. '.$salesmtd->prodno.' - '.$salesmtd->custno.'<br>';

  				//echo $i.'. '.$attributes['prodno'].' - '.$attributes['cusno'];

  				if(!empty($attributes['cusno'])) {
  					$attributes['cuscount'] = substr($attributes['cusno'], 0, strspn($attributes['cusno'], '0123456789'));
  					if($attributes['cuscount'] < 200){
  						//$salesmtd = Salesmtd::create($attributes);
	  					//echo ' = '. $attributes['cuscount']	.' <---- saved<br>';
	  					$cus_ctr += $attributes['cuscount'];
	  					++$saved_ctr;
  					}
  					
  				} else {
  					//echo '<br>';
  				}
			 	}
				dbase_close($db);
			}
		return ['saved_ctr'=>$saved_ctr, 'cus_ctr'=>$cus_ctr];
	}


	public function importExtract(Request $request, $branchid, $filename)
	{
		$branch = Branch::find($branchid);
		if(!is_null($branch)){
			$path = 'D:\\GI-IMPORTS'.DIRECTORY_SEPARATOR.strtoupper($branch->code).DIRECTORY_SEPARATOR.strtoupper($filename);
  		if(!is_dir($path))
  			return 'No Backup...!';



  		//$date = substr('20151231', 0, 4).'-'.substr('20151231', 4, 2).'-'.substr('20151231', 6, 2);
  		//$salesmtd = Salesmtd::create(['tblno'=>'0', 'orddate'=>$date]);
  		//return $salesmtd;
  		echo '<h1>importing '.strtoupper($filename).'.ZIP data from '.$branch->code.' - '.$branch->descriptor.'</h1><br>';
  		
  		$db = dbase_open($path.DIRECTORY_SEPARATOR.'SALESMTD.DBF', 0);

			if ($db) {
				$header = dbase_get_header_info($db);
			
			 	$record_numbers = dbase_numrecords($db);
			 	$saved_ctr = 0;
			 	$cus_ctr = 0;
			  for($i = 1; $i <= $record_numbers; $i++) {

			    $row = dbase_get_record_with_names($db, $i);

			    $attributes = [];
					foreach ($header as $key => $value) {
						if($value['name']=='ORDDATE' && !empty(trim($row['ORDDATE']))){
							$date = substr(trim($row[$value['name']]), 0, 4).'-'
											.substr(trim($row[$value['name']]), 4, 2).'-'
											.substr(trim($row[$value['name']]), 6, 1);

											echo $date.' - '.$row['ORDTIME'].' ';
							
							$attributes['orddate'] = Carbon::parse($date)->format('Y-m-d');
							
						}
						$attributes[strtolower($value['name'])] = trim($row[$value['name']]);
					}
					$attributes['branchid'] = strtoupper($branch->id);
					
  				//$salesmtd = Salesmtd::create($attributes);
  				//echo $i.'. '.$salesmtd->prodno.' - '.$salesmtd->custno.'<br>';

  				echo $i.'. '.$attributes['prodno'].' - '.$attributes['cusno'];

  				if(!empty($attributes['cusno'])) {
  					$attributes['cuscount'] = substr($attributes['cusno'], 0, strspn($attributes['cusno'], '0123456789'));
  					//$salesmtd = Salesmtd::create($attributes);
  					echo ' = '. $attributes['cuscount']	.' <---- saved<br>';
  					$cus_ctr += $attributes['cuscount'];
  					++$saved_ctr;
  				} else {
  					echo '<br>';
  				}
			 }



				dbase_close($db);
			}



			return '<h3>done: '. $saved_ctr .' orders with '.$cus_ctr.' person</h3>';
  		//return $salesmtd;
		}
		return 'Branch not found!';
	}


	public function e(Request $request, $branchid)
	{

		$branch = Branch::find($branchid);
		if (is_null($branch))
			return 'no branch found!';

		$mons = [
			7 	=> 'July',
			8 	=> 'August',
			9 	=> 'September',
			10 	=> 'October',
			11 	=> 'November',
			12 	=> 'December'
		];

		$days = [
			0 	=> 'mon',
			1 	=> 'tue',
			2 	=> 'wed',
			3 	=> 'thu',
			4 	=> 'fri',
			5 	=> 'sat',
			6 	=> 'sun'
		];

		/*
		$salesmtds = DB::table('salesmtd')
			->select(DB::raw('WEEKDAY(orddate) AS day, HOUR(ordtime) AS time, SUM(cuscount) AS total_cust'))
			->where('branchid', $branch->id)
			->where(DB::raw('MONTH(orddate)'), '12')
			->groupBy(DB::raw('WEEKDAY(orddate), HOUR(ordtime)'))
			->get();
		*/

		//session(['salesmtds'=>$salesmtds]);

		//return session('salesmtds');

		echo '<h2>'.$branch->code.' - '.$branch->descriptor.' ( Customer Count per Hour ) - 3rd/4th Quarter</h2>';
		foreach ($mons as $month_no => $month) {
			

		$arr = [];
		$arr2 = [];

		$times = [9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 0, 1, 2, 3, 4, 5, 6];

		$salesmtds = DB::table('salesmtd')
			->select(DB::raw('WEEKDAY(orddate) AS day, HOUR(ordtime) AS time, SUM(cuscount) AS total_cust'))
			->where('branchid', $branch->id)
			->where(DB::raw('MONTH(orddate)'), $month_no)
			->groupBy(DB::raw('WEEKDAY(orddate), HOUR(ordtime)'))
			->get();

		//foreach (session('salesmtds') as $salesmtd) {
		foreach ($salesmtds as $salesmtd) {
			//$arr[array_search($salesmtd->time, $times)][$salesmtd->day] = $salesmtd->total_cust;
			$arr[$salesmtd->time][$salesmtd->day] = $salesmtd->total_cust;
		}

		$attrs = [];
		foreach ($times as $key => $value) {
			for($d=0; $d<=6; $d++) {
				$arr2[$value][$d] = !empty($arr[$value][$d]) ? $arr[$value][$d]:'0';
				$attrs[$days[$d]] = $arr2[$value][$d];
			}
			$attrs['time'] = $value.':00:00';
			$attrs['month'] = $month_no;
			$attrs['year'] = '2015';
			$attrs['branchid'] = $branch->id;
			//Salesmtdhdr::create($attrs);
		}


		echo '<table cellpadding="5" cellspacing="0" border="1" style="text-align: right; float: left; margin: 10px;"><tbody>';

		echo '<tr><td colspan="8" style="text-align: left;">'.$month.'</td></tr>';
		echo '<tr><td>Time</td>
					<td>Mon</td>
					<td>Tue</td>
					<td>Wed</td>
					<td>Thu</td>
					<td>Fri</td>
					<td>Sat</td>
					<td>Sun</td>
					</tr>';
		foreach ($times as $key => $value) {


		    echo '<tr>';
				echo '<td>';
				echo ($value>=0 && $value<12) ? ($value==0 ? 12:$value):($value==12 ? $value:$value-12);
				echo ($value>=0 && $value<12) ? ' am':' pm';
				echo '</td>';
				for($d=0; $d<=6; $d++) {
					echo '<td>'. $arr2[$value][$d] .'</td>';
				}
				echo '</tr>';
		}
		echo '</tbody></table>';

		}
		return;

		foreach ($times as $key => $value) {
			for($d=0; $d<=6; $d++) {
				echo $d.' ';
			}
			echo '<br>';
		}



	}




	public function summarize(){
		$branches = Branch::orderBy('code')->get();
		$times = ['09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', 
							'21', '22', '23', '00', '01', '02', '03', '04', '05', '06'];

		foreach ($branches as $branch) {

			echo '<table cellpadding="5" cellspacing="0" border="1" style="text-align: right; float: left; margin: 10px;"><tbody>';

			echo '<tr><td colspan="8" style="text-align: left;">'.$branch->code.' - '.$branch->descriptor.'</td></tr>';
			echo '<tr><td>Time</td>
						<td>Mon</td>
						<td>Tue</td>
						<td>Wed</td>
						<td>Thu</td>
						<td>Fri</td>
						<td>Sat</td>
						<td>Sun</td>
						</tr>';
			foreach ($times as $t) {
				$s = Salesmtdhdr::selectRaw('year, month, time, SUM(mon) AS mon, SUM(tue) AS tue, SUM(wed) AS wed,
																	SUM(thu) AS thu, SUM(fri) AS fri, SUM(sat) AS sat, SUM(sun) AS sun')
																	->groupBy('time')
																	->whereBranchid($branch->id)
																	->whereTime($t.':00:00')
																	->first();

				if (!is_null($s)) {
					echo '<tr>';
					echo '<td>'.$s->time->format('g A').'</td>';
					echo '<td>'.$s->mon.'</td>';
					echo '<td>'.$s->tue.'</td>';
					echo '<td>'.$s->wed.'</td>';
					echo '<td>'.$s->thu.'</td>';
					echo '<td>'.$s->fri.'</td>';
					echo '<td>'.$s->sat.'</td>';
					echo '<td>'.$s->sun.'</td>';
					echo '</tr>';
				} 
						
			}
			echo '</tbody></table>';
		}
	}



	public function sysinfoAll(){
		$path = 'D:\GI-IMPORTS\\';
		$dirs = array_diff(scandir($path), array('..', '.'));

		foreach ($dirs as $dir) {

			$branch = Branch::where('code', strtoupper($dir))->first();
			
			if (!is_null($branch)){

				echo $dir.' - '.$branch->descriptor.'</br>';
				
					$file = 'SYSINFO.DBF ';
					//echo $file;
					echo 'Man Cost: ';
					$filepath = $path.$dir.DIRECTORY_SEPARATOR.'GC123115'.DIRECTORY_SEPARATOR.$file;
					if (file_exists($filepath)) {
						
						$db = dbase_open($filepath, 0);

						if ($db) {
							$header = dbase_get_header_info($db);
						
						 	$record_numbers = dbase_numrecords($db);
						 	$saved_ctr = 0;
						 	$cus_ctr = 0;
						  for($i = 1; $i <= $record_numbers; $i++) {

						    $row = dbase_get_record_with_names($db, $i);

						    echo trim($row['MAN_COST']);


			  				
						 	}
							dbase_close($db);
						}

						echo '<br>';
					} else {
						echo $filepath.' file not found<br>';
					}
				
			} 

			
		}
	}

			
	




}