<?php



Route::get('/404', function (){
	// catched from All\Exceptions\Handler
	
	//Log::info('Showing user profile for user');

	//return redirect('branch/manage/user');
	return redirect('/');

});


// Route::get() or get()
Route::get('/', ['as'=>'tk.index', 'middleware' => 'auth', 'uses'=>'TimelogController@getIndex']);
Route::get('dashboard', ['middleware' => 'auth', 'uses'=>'DashboardController@getIndex']);
Route::get('home', ['middleware' => 'auth', 'uses'=>'DashboardController@getIndex']);
Route::get('settings', ['middleware' => 'auth', 'uses'=>'DashboardController@getIndex']);

//Route::get('dbf/import/{table}', ['middleware' => 'auth', 'uses'=>'ImportController@getTable']);

Route::get('tk', ['as'=>'tk.index', 'middleware' => 'auth', 'uses'=>'TimelogController@getIndex']);


Route::get('branch/manage/user', ['uses'=>'BranchController@getBranchManager']);
Route::post('branch/manager', ['uses'=>'BranchController@postBranchManager']);

Route::get('branch/mansked/{param1?}/{param2?}/{param3?}', ['uses'=>'ManskedController@getIndex',  'middleware' => 'auth'])
	->where(['param1'=>'add|week|[0-9]{2}+', 
					'param2'=>'add|branch|[0-9]+', 
					'param3'=>'edit|[A-Fa-f0-9]{32}+']);

Route::get('branch/manday/{param1?}/{param2?}/{param3?}', ['uses'=>'ManskeddayController@getIndex',  'middleware' => 'auth'])
	->where(['param1'=>'add|[A-Fa-f0-9]{32}+', 
					'param2'=>'edit|branch|[0-9]+', 
					'param3'=>'edit|[A-Fa-f0-9]{32}+']);

Route::post('api/t/mansked', ['as'=>'mansked.post', 'uses'=>'ManskedController@post']);	

Route::post('api/t/manskedday', ['as'=>'manday.post', 'uses'=>'ManskeddayController@post']);
Route::put('api/t/manskedday/{id}', ['as'=>'manday.put', 'uses'=>'ManskeddayController@put']);

get('masterfiles/{table}/{param1?}/{param2?}', function($table, $param1=null, $param2=null) {
    $controller = app()->make("App\Http\Controllers\\".ucfirst($table)."Controller");
    $request = app()->make("Illuminate\Http\Request");
    return $controller->getIndex($request, 'masterfiles', $table, $param1, $param2);
})->where(['table'=>'[A-Za-z]+', 
					'param1'=>'add|branch|[A-Fa-f0-9]{32}+', 
					'param2'=>'edit|[A-Fa-f0-9]{32}+']);


Route::controller('datatables', 'DatatablesController', [
    'anyData'  => 'datatables.data',
    //'getIndex' => 'datatables',
]);


/******************* API  *************************************************/
Route::group(['prefix'=>'api'], function(){

Route::post('t/employee', ['as'=>'employee.post', 'uses'=>'EmployeeController@post']);
Route::put('t/employee', ['as'=>'employee.put', 'uses'=>'EmployeeController@put']);
Route::get('employee/{field?}/{value?}', ['as'=>'employee.getbyfield', 'uses'=>'EmployeeController@getByField']);
Route::post('timelog', ['as'=>'timelog.post', 'uses'=>'TimelogController@post']);

});







Route::get('upload', ['as'=>'upload.index', 'uses'=>'UploadController@index']);
Route::get('import-dbf', ['uses'=>'EmployeeController@importDBFs']);
Route::get('merge/view', ['uses'=>'EmployeeController@payMergeView']);
Route::get('copy-extract', ['uses'=>'UploadController@copyExtract']);
Route::get('list-extract', ['uses'=>'UploadController@listExtract']);
Route::get('list-summary', ['uses'=>'UploadController@summarize']);
Route::get('import-extract/{branchid}/{filename}', ['uses'=>'UploadController@importExtract']);
Route::get('import-all/{branchid}', ['uses'=>'UploadController@importAll']);
Route::get('browse-salesmtd', ['uses'=>'UploadController@browseSalesmtd']);
Route::get('e/{branchid}', ['uses'=>'UploadController@e']);
Route::get('sysifno-all', ['uses'=>'UploadController@sysinfoAll']);


Route::post('postfile', ['as'=>'upload.postfile', 'uses'=>'UploadController@postfile']);



Route::get('login', ['as'=>'auth.getlogin', 'uses'=>'Auth\AuthController@getLogin']);
Route::post('login', ['as'=>'auth.postlogin', 'uses'=>'Auth\AuthController@postLogin']);
Route::get('logout', ['as'=>'auth.getlogout', 'uses'=>'Auth\AuthController@getLogout']);









 	/*************************************************************************************/
 /************************* Testing Url for Devs **************************************/
/*************************************************************************************/

get('t/employees', function(){
	return App\Models\Employee::with([
							'branch' => function ($query) {
								$query->select('code', 'descriptor', 'id');
								//dd($query);
        			}])->get();
});

get('t/employee/branch/{id}', function($id){
	return App\Models\Employee::branchid($id)->with([
							'branch' => function ($query) {
								$query->select('code', 'descriptor', 'id');
        			}])->get();
});

get('employee/{id}', function($id) {
	//return App\Models\Timelog::with('employee')->where('id',$id)->get();
	
	//$timelog = App\Models\Timelog::find($id);
	//return $timelog->employee()->get();

	$employee = App\Models\Employee::with('branch')->where('id', $id)->get()->first();
	return $employee->previous();
});



get('t/maskedhdr/{id}', function($id){
	return App\Models\Manskedhdr::with(['branch' => function($query){
																	$query->select('code', 'addr1', 'id');
																}, 'manager' => function($query) {
																	$query->select('code', 'lastname', 'firstname', 'id');
																}, 'manskeddays.manskeddtls'])->where('id', $id)->get();
});

get('t/religion/{id}', function($id){
	$religion = App\Models\Religion::find($id);
	return dd($religion);
});

get('t/week', function(){


	//echo date("W", mktime(0,0,0,12,28,2015));

		$weeks = App\Models\Manskedhdr::select('weekno')->where(DB::raw('YEAR(date)'), '=', '2015')->get();

		$w = $weeks->pluck('weekno')->toArray(); // array of week

		for($week_ctr = 1; $week_ctr <= date("W", mktime(0,0,0,12,28,2015));  $week_ctr++){
			$s = in_array($week_ctr, $w) ? 'yes':'no';
			$mon_no = date('F n', strtotime('1 Jan +'. $week_ctr.' weeks'));
			echo $mon_no.' = '.$week_ctr.' = '. $s .'<br>';
		}
});

get('t/list-week', function(){



		$lastday = new App\Models\Manskedhdr;
		return dd($lastday->getDaysByWeekNo('01', '2016'));

		$week_number = '01';
		$year = '2015';
		for($day=1; $day<=7; $day++)
		{
		    echo date('m/d/Y', strtotime($year."W".$week_number.$day))."<br>";
		}
});


get('t/get-week',  ['uses'=>'ManskedController@testWeeks']);

get('t/mansked/week/{weekno}',  function($weekno){
	$mansked =  App\Models\Manskedhdr::with('manskeddays')->select('id')->where('weekno', $weekno)->get()->first();
	return $mansked->manskeddays->keyBy('date');
	$manday = new App\Models\Manskedday;
		return $manday->where('id', 'B0092A7B666611E596ECDA40B3C0AA12')->get();
});


get('t/manday-dtl', function(){

	$manday = new App\Models\Manskedday;
	$manday->date = '20015-10-07';
	$manday->manskedid = 'A7AECDD2666611E596ECDA40B3C0AA12';
	$manday->id = $manday->get_uid();
	$manday->save();


	$x = new App\Models\Manskeddtl;
	$x->daytype = 0;
	$x->id = $x->get_uid();

	$manday->manskeddtls()->save($x);


	return dd($manday);


});






get('sessions', function(){
	return session()->all();
});







 	/*************************************************************************************/
 /********************   Data Manipulation for Migrations *****************************/
/*************************************************************************************/

get('compcat-expense', function(){

	$compcats = App\Models\Compcat::all();

	foreach($compcats as $compcat){
		$expense = App\Models\Expense::where('code', 'LIKE', '%'.$compcat->code.'%')
													->get()->first();
		if(empty($expense)){
			echo 'empty<br>';
		} else {
			echo $expense->id.'<br>';
			$compcat->expenseid = $expense->id;
			//$compcat->save();
		}
	}
});


get('link-comp-cat', function(){

	$components = App\Models\Component::all();

	foreach($components as $component){
		$compcat = App\Models\Compcat::where('descriptor', 'LIKE', '%'.$component->compcatid.'%')
													->get()->first();
		if(empty($compcat)){
			echo 'empty<br>';
		} else {
			echo $compcat->id.'<br>';
			$component->compcatid = $compcat->id;
			//$component->save();
		}
	}
});





Route::get('filess', function(){
	$files = new Filesystem;
	return dd($files->exists(public_path().'\uploads\test.zip'));
});






Route::get('timelog/{id}', function($id) {
	//return App\Models\Timelog::with('employee')->where('id',$id)->get();
	
	//$timelog = App\Models\Timelog::find($id);
	//return $timelog->employee()->get();

	$timelogs = App\Models\Timelog::with('employee')->where('id', $id)->get();
	return $timelogs[0];
});



Route::get('get_uid', function(){
	return App\Models\BaseModel::get_uid();
});



Route::get('sp', function(){

	$w = 'NA/A';

	return var_dump($w!='NA/A' && $w!='N/A');
});


Route::get('dbf/{year}/{loc}', function($year, $loc) {


//$db = dbase_open('Z:\POS_BACK\\'.$year.'\\'.$loc.'\END_BAL.DBF', 0);
$db = dbase_open('D:\GI\TRI\GC113015\PAY_MAST.DBF', 0);

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

});




Route::get('dbf/browse', function() {



$db = dbase_open('D:\GI\TRI\GC113015\CSH_AUDT.DBF', 0);

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

});



Route::get('zip/{year}/{loc}/{filename}', function($year, $loc, $filename){ 

	//$files = glob('files/*');
	//$z = Zipper::make('test2.zip')->add($files);
	//$z->setPassword('p@55w0rd');
	//exit;
	$dir = 'Z:\POS_BACK\\'.$year.'\\'.$loc.'\\'.$filename.'.ZIP';

	$zip = new ZipArchive();
  $zip_status = $zip->open($dir);
  echo $zip_status.'<br>';
  if ($zip_status === true)
  {
  		echo 'extracting<br>';
      if ($zip->setPassword("admate"))
      {
      		$path = public_path().'\\dbf\\'.$year.'\\'.$loc.'\\'.$filename.'\\';
      		if (!file_exists($path)) {
					    mkdir($path, 0777, true);
					}

          if (!$zip->extractTo($path))
              echo "Extraction failed (wrong password?)";

            echo 'extracted to '. $path.'<br>';
      }

      $zip->close();
  }
  else
  {
      die("Failed opening archive: ". @$zip->getStatusString() . " (code: ". $zip_status .")");
  }
});







get('/env', function() {
    return app()->environment();
});

get('/env/hostname', function() {
    return gethostname();
});

get('/env/clientname', function(){
	return gethostbyaddr($_SERVER['REMOTE_ADDR']);
});



get('/phpinfoko', function(){
	return phpinfo();
});

get('/env/vars', function(){
    
    echo 'MANDRILL_APIKEY - '.getenv('MANDRILL_APIKEY');
});

get('/checkdbconn', function(){
	if(DB::connection()->getDatabaseName()){
	   echo "connected sucessfully to database ".DB::connection()->getDatabaseName();
	}
});

get('/v', function(){
    dd($app->version());
});














get('/extract', function() {

	$path = 'Z:\POS_BACK\2015\\';
	//$files = scandir($dir);
	$dirs = array_diff(scandir($path), array('..', '.'));

	foreach ($dirs as $dir) {
		$files = array_diff(scandir($path.$dir), array('..', '.'));
		//echo count($files).'<br>';
		if(count($files)>0){

			echo $path.$dir.' - '.$files[count($files)].'<br>';

			
			$zip = new ZipArchive();
		  $zip_status = $zip->open($path.$dir.'\\'.$files[count($files)]);
		  echo $zip_status.'<br>';
		  if ($zip_status === true)
		  {
		  		echo 'extracting<br>';
		      if ($zip->setPassword("admate"))
		      {
		      		$path2 = public_path().'\\dbf\\'.$dir.'\\';
		      		if (!file_exists($path)) {
							    mkdir($path, 0777, true);
							}

		          if (!$zip->extractTo($path2))
		              echo "Extraction failed (wrong password?)";

		            echo 'extracted to '. $path2.'<br>';
		      }

		      $zip->close();
		  } else {
		      die("Failed opening archive: ". @$zip->getStatusString() . " (code: ". $zip_status .")");
		  }
		  
		


		} else {
			echo $dir.' - no dir <br>';
		}
		
		//foreach ($files as $file) {
			//$x = array_diff(scandir($path.$dir.$file), array('..', '.'));
			//echo '<a href="sysinfo.php?db='.$file.'">'.$file.'</a><br>';
		//}
		//echo json_encode($files);
		//echo '<a href="sysinfo.php?db='.$file.'">'.$files.'</a><br>';
	}


});

get('sysinfo', function(){

	$path = public_path().'\\dbf\\2015\\';
	$dirs = array_diff(scandir($path), array('..', '.'));
	$h = false;
	echo '<table cellpadding="2" cellspacing="0" border="1"><thead>';
	foreach ($dirs as $dir) {
		$files = array_diff(scandir($path.$dir), array('..', '.'));
		//echo count($files).'<br>';
		if(file_exists($path.$dir.'\\SYSINFO.DBF')){

			//echo $path.$dir.'SYSINFO.DBF ---  OK! <br>';

			$db = dbase_open($path.$dir.'\\SYSINFO.DBF', 0);

			if ($db) {
				$header = dbase_get_header_info($db);
				if(!$h){
						// render table header
						echo '<tr>';
						foreach ($header as $key => $value) {
							echo '<th>'.$value['name'].'</th>';
						}
						echo '</tr>';
						$h = true;
				}
				
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

		} else {
			//echo $path.$dir.'SYSINFO.DBF ---  NO! <br>';
		}
	}

	echo '</table>';

});



get('dbfb/browse/{param1?}/{param2?}/{param3?}', function($param1=null, $param2=null, $param3=null){

	if(is_null($param3)){
		if(is_null($param1))
			$path = 'D:\GI\\';
		else 
			$path = 'D:\GI\\'.$param1.'\\GC113015\\';

		//return $path;

		//$files = scandir($dir);
		$dirs = array_diff(scandir($path), array('..', '.'));
		
		
		foreach ($dirs as $dir) {
			$l = is_null($param2) ? $dir:$dir.'/'.$param2;
			echo '<a href="/dbfb/browse/'.$l.'" target="_blank">'.$dir.'</a></br>';

			
		}
	} else {

	}

	

});
    

