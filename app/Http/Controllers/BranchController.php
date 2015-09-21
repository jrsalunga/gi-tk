<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class BranchController extends Controller {





	public function getIndex() {
		return view('dashboard.index');
	}




	public function getBranchManager() {
		return view('branch.manager');
	}

	public function postBranchManager(Request $request) {
		
		if(empty($request->input('g-recaptcha-response')))
			return redirect('branch/manager')->withErrors('please check/verify captcha!');

		return $request->input('g-recaptcha-response');
	}
}