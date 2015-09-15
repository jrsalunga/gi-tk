<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;


class BranchController extends Controller {





	public function getIndex(){
		return view('dashboard.index');
	}




	public function getBranchManager(){
		return view('branch.manager');
	}
}