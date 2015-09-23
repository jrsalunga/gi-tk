<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller {


	public function getIndex(Request $request, $menu, $table, $param1, $param2) {
		if(strtolower($param1)==='add'){
			return $this->makeAddView($request);
		} else if(preg_match('/^[A-Fa-f0-9]{32}+$/', $param1) && strtolower($param2)==='edit') {
			return 'edit';
		} else if(preg_match('/^[A-Fa-f0-9]{32}+$/', $param1)) {   //preg_match('/^[A-Fa-f0-9]{32}+$/',$action))
			return 'item with id: '.$param1;	
		} else {
			return $this->makeListView($request);
		}
	}


	public function makeListView(Request $request) {
		
		$employees = Employee::with(['branch' => function($query){
													$query->select('code', 'descriptor', 'id');
												}])
												//->select('code', 'branchid')
												->paginate(10);
		return view('masterfiles.employee.list')
								->with('employees', $employees);

	}

	public function makeAddView(Request $request) {
		return view('masterfiles.employee.add');
	}

	public function makeSingleView() {

	}


	public function getByField($field, $value){
		
		$employee = Employee::where($field, '=', $value)->first();
		
		if($employee){
			$respone = array(
						'code'=>'200',
						'status'=>'success',
						'message'=>'Hello '. $employee->firstname. '=)',
						'data'=> $employee->toArray()
			);	
			
		} else {
			$respone = array(
						'code'=>'404',
						'status'=>'danger',
						'message'=>'Invalid RFID! Record no found.',
						'data'=> ''
			);	
		}
				
		return $respone;
	} 
}