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

Route::get('tk', ['as'=>'tk.index', 'middleware' => 'auth', 'uses'=>'TimelogController@getIndex']);


Route::get('branch/manager', ['uses'=>'BranchController@getBranchManager']);


Route::get('api/employee/{field?}/{value?}', ['as'=>'field.get', 'uses'=>'EmployeeController@getByField']);
Route::post('api/timelog', ['as'=>'timelog.post', 'uses'=>'TimelogController@post']);
//Route::post('api/timelog', function(){
//	return dd(Input::all());
//});








Route::get('upload', ['as'=>'upload.index', 'uses'=>'UploadController@index']);


Route::post('postfile', ['as'=>'upload.postfile', 'uses'=>'UploadController@postfile']);

Route::get('filess', function(){
	$files = new Filesystem;
	return dd($files->exists(public_path().'\uploads\test.zip'));
});


Route::get('login', 'Auth\AuthController@getLogin');
Route::post('auth/login', ['as'=>'auth.login', 'uses'=>'Auth\AuthController@postLogin']);
Route::get('logout', ['as'=>'auth.login', 'uses'=>'Auth\AuthController@getLogout']);








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

Route::get('zip', function(){ 

	//$files = glob('files/*');
	//$z = Zipper::make('test2.zip')->add($files);
	//$z->setPassword('p@55w0rd');
	//exit;
	$zip = new ZipArchive();
  $zip_status = $zip->open("test.zip");
  echo $zip_status.'<br>';
  if ($zip_status === true)
  {
  		echo 'extracting<br>';
      if ($zip->setPassword("password"))
      {
          if (!$zip->extractTo(public_path()))
              echo "Extraction failed (wrong password?)";

            echo 'extracted to '. public_path() .'<br>';
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

