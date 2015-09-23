<?php

// Route::get() or get()
Route::get('/', function (){

		return app()->environment();
		exit;
		$timelogs = App\Models\Timelog::with('employee.branch')
											->orderBy('datetime', 'DESC')
											//->take(2)
											->get();
    return view('tk.index')->with('timelogs', $timelogs);
});

Route::get('dashboard', ['middleware' => 'auth', 'uses'=>'DashboardController@getIndex']);
Route::get('home', ['middleware' => 'auth', 'uses'=>'DashboardController@getIndex']);
Route::get('settings', ['middleware' => 'auth', 'uses'=>'DashboardController@getIndex']);

Route::get('dbf/import/{table}', ['middleware' => 'auth', 'uses'=>'ImportController@getTable']);

Route::get('tk', ['as'=>'tk.index', 'middleware' => 'auth', 'uses'=>'TimelogController@getIndex']);


Route::get('branch/manager', ['uses'=>'BranchController@getBranchManager']);
Route::post('branch/manager', ['uses'=>'BranchController@postBranchManager']);


Route::get('api/employee/{field?}/{value?}', ['as'=>'field.get', 'uses'=>'EmployeeController@getByField']);
Route::post('api/timelog', ['as'=>'timelog.post', 'uses'=>'TimelogController@post']);
//Route::post('api/timelog', function(){
//	return dd(Input::all());
//});


get('masterfiles/{table}/{param1?}/{param2?}', function($table, $param1 = null, $param2 = null) {
    $controller = app()->make("App\Http\Controllers\\".ucfirst($table)."Controller");
    $request = app()->make("Illuminate\Http\Request");
    return $controller->getIndex($request, 'masterfiles', $table, $param1, $param2);
})->where(['table'=>'[A-Za-z]+', 'param1'=>'add|[A-Fa-f0-9]{32}+', 'param2'=>'edit']);


Route::controller('datatables', 'DatatablesController', [
    'anyData'  => 'datatables.data',
    //'getIndex' => 'datatables',
]);


get('employees', function(){
	return App\Models\Employee::with([
							'branch' => function ($query) {
								$query->select('code', 'descriptor', 'id');
								//dd($query);
        			}])->get();
});




Route::get('upload', ['as'=>'upload.index', 'uses'=>'UploadController@index']);


Route::post('postfile', ['as'=>'upload.postfile', 'uses'=>'UploadController@postfile']);

Route::get('filess', function(){
	$files = new Filesystem;
	return dd($files->exists(public_path().'\uploads\test.zip'));
});


Route::get('login', ['as'=>'auth.getlogin', 'uses'=>'Auth\AuthController@getLogin']);
Route::post('login', ['as'=>'auth.postlogin', 'uses'=>'Auth\AuthController@postLogin']);
Route::get('logout', ['as'=>'auth.getlogout', 'uses'=>'Auth\AuthController@getLogout']);







Route::get('timelog/{id}', function($id) {
	//return App\Models\Timelog::with('employee')->where('id',$id)->get();
	
	//$timelog = App\Models\Timelog::find($id);
	//return $timelog->employee()->get();

	$timelogs = App\Models\Timelog::with('employee')->where('id', $id)->get();
	return $timelogs[0];
});

Route::get('employee/{id}', function($id) {
	//return App\Models\Timelog::with('employee')->where('id',$id)->get();
	
	//$timelog = App\Models\Timelog::find($id);
	//return $timelog->employee()->get();

	$employee = App\Models\Employee::with('branch')->where('id', $id)->get();
	return $employee[0];
});


Route::get('get_uid', function(){
	return App\Models\BaseModel::get_uid();
});



Route::get('geoip/{id}', function($ip){

	$ip = empty($ip) ? $_SERVER["REMOTE_ADDR"]:$ip;

	return GeoIP::getLocation($ip);
});


Route::get('dbf/{year}/{loc}', function($year, $loc) {


$db = dbase_open('Z:\POS_BACK\\'.$year.'\\'.$loc.'\END_BAL.DBF', 0);

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
    

