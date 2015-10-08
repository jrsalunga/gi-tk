<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Branch;
use App\Models\Manskedhdr as Mansked;
use App\Models\Manskeddtl as Mandtl;
use Auth;

class ManskeddayController extends Controller {

	protected $branchid = '';

	public function __construct(){
		$this->branchid = Auth::user()->branchid;
	}

	public function getIndex(Request $request, $param1=null, $param2=null){
		
		if(strtolower($param1)==='add'){
			return $this->makeAddView($request);
		} else if((strtolower($param1)==='week') && preg_match('/^[0-9]+$/', $param2)) {
			return $this->makeViewWeek();
		} else if(preg_match('/^[A-Fa-f0-9]{32}+$/', $param1) && strtolower($param2)==='edit') {
			return $this->makeEditView($request, $param1);
		} else if(preg_match('/^[A-Fa-f0-9]{32}+$/', $param1)) {   //preg_match('/^[A-Fa-f0-9]{32}+$/',$action))
			return $this->makeSingleView($request, $param1);
		} else {
			return $this->makeListView($request, $param1, $param2);
		}
	}



	private function empGrpByDept() {
		$depts = [['name'=>'Dining', 'employees'=>[], 'deptid'=>['75B34178674011E596ECDA40B3C0AA12', '201E68D4674111E596ECDA40B3C0AA12']],
					['name'=>'Kitchen', 'employees'=>[], 'deptid'=>['71B0A2D2674011E596ECDA40B3C0AA12']]];

		for($i=0; $i<= 1; $i++) { 
			$employees = Employee::with('position')
									->select('lastname', 'firstname', 'positionid', 'employee.id')
									->join('position', 'position.id', '=', 'employee.positionid')
									->where('branchid', $this->branchid)
									->whereIn('deptid', $depts[$i]['deptid'])
					       	->orderBy('position.ordinal', 'ASC')
					       	->get();
			$depts[$i]['employees'] = $employees;

		}
		 return  $depts;
	}

	public function makeEditView(Request $request) {

		$depts = $this->empGrpByDept();

		for($h=0; $h<count($depts); $h++){
			$arr = $depts[$h]['employees']->toArray();
			for($i=0; $i<count($arr); $i++){
				$mandtl = Mandtl::where('employeeid', $depts[$h]['employees'][$i]->id)
												->where('mandayid', $request->input('mandayid'))->get()->first();

				$depts[$h]['employees'][$i]['manskeddtls'] = [
					//'starttime' => $mandtl->starttime
				];
			}
		}
	}

	public function makeAddView(Request $request) {

		$depts = $this->empGrpByDept();

		$date = (!empty($request->input('date')) && strtotime('now') < strtotime($request->input('date')) ) ? $request->input('date'):date('Y-m-d', strtotime('now +1day'));
		//exit;
		
		//return $employees;
		return view('branch.manday.add')->with('depts', $depts)->with('date', $date);
	}

	public function makeListView(Request $request, $param1, $param2) {
		$weeks = Mansked::paginateWeeks($request, '2015', 5);
		return view('branch.mansked.list')->with('weeks', $weeks);
	}


	public function makeSingleView(Request $request, $param1){
		return view('branch.manday.view');
	}


	public function makeViewWeek(){
		return view('branch.mansked.week');
	}


	public function testWeeks(Request $request) {
		$weeks = Mansked::paginateWeeks($request, '2015');
		return view('branch.mansked.list')->with('weeks', $weeks);
	}






	public function post(Request $request){
		return $request->all();
	}











}


