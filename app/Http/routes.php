<?php


Route::get('/', function () {

		$timelogs = App\Models\Timelog::with('employee.branch')
											->orderBy('datetime', 'DESC')
											//->take(2)
											->get();
    return view('home.index')->with('timelogs', $timelogs);
});



Route::get('timelog/{id}', function($id) {
	//return App\Models\Timelog::with('employee')->where('id',$id)->get();
	
	//$timelog = App\Models\Timelog::find($id);
	//return $timelog->employee()->get();

	$timelogs = App\Models\Timelog::with('employee')->where('id', $id)->get();
	return $timelogs[0];
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

