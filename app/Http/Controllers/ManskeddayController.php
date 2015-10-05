<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Branch;
use App\Models\Manskedhdr as Mansked;

class ManskeddayController extends Controller {






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



	public function makeAddView(Request $request) {
		return view('branch.manday.add');
	}

	public function makeListView(Request $request, $param1, $param2) {
		$weeks = Mansked::paginateWeeks($request, '2015', 5);
		return view('branch.mansked.list')->with('weeks', $weeks);
	}


	public function makeViewWeek(){
		return view('branch.mansked.week');
	}


	public function testWeeks(Request $request) {
		$weeks = Mansked::paginateWeeks($request, '2015');
		return view('branch.mansked.list')->with('weeks', $weeks);
	}











}


