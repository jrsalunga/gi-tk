<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;

class EmployeeController extends Controller {





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