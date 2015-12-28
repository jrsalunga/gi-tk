<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Children;
use App\Models\Branch;
use App\Models\Position;
use App\Models\Ecperson;
use App\Models\Education;
use App\Models\Workexp;
use App\Models\Spouse;
use Carbon\Carbon;

class EmployeeController extends Controller {

	protected $branches;

	public function __construct() {
		$this->branches = Branch::orderBy('code')->get();
	}


	public function getIndex(Request $request, $menu, $table, $param1, $param2) {
		if(strtolower($param1)==='add'){
			return $this->makeAddView($request);
		} else if(preg_match('/^[A-Fa-f0-9]{32}+$/', $param1) && strtolower($param2)==='edit') {
			return $this->makeEditView($request, $param1);
		} else if(preg_match('/^[A-Fa-f0-9]{32}+$/', $param1)) {   //preg_match('/^[A-Fa-f0-9]{32}+$/',$action))
			return $this->makeSingleView($request, $param1);
		} else {
			return $this->makeListView($request, $param1, $param2);
		}
	}


	public function makeListView(Request $request, $table, $branchid) {
		
		$employees = Employee::with(['branch' => function($query){
													$query->select('code', 'descriptor', 'id');
												}, 'position' => function($query){
													$query->select('code', 'descriptor', 'id');
												}])
												//->select('code', 'branchid')
												->paginate(10);
		if(!empty($table) && !empty($branchid)){
			//$employees
		}

		//return $employees;
		return view('masterfiles.employee.list')
								->with('employees', $employees);
		//return view('masterfiles.employee.list', ['employees' => $employees]); //same as top

	}

	public function makeAddView(Request $request) {
		$branches = Branch::orderBy('code')->get();
		return view('masterfiles.employee.add')
								->with('branches', $branches);
	}

	public function makeSingleView(Request $request, $id) {
		$employee = Employee::with(['branch' => function ($query) {
                                $query->select('code', 'descriptor', 'addr1', 'id');
                        }])->where('id', $id)
                        ->get()
                        ->first();
		return view('masterfiles.employee.view')
								->with('employee', $employee);
	}

	public function makeEditView(Request $request, $id) {
		//$branches = Branch::orderBy('code')->get();
		$employee = Employee::with(['branch' => function ($query) {
                                $query->select('code', 'descriptor', 'addr1', 'id');
                        }])->where('id', $id)
                        ->get()
                        ->first();
		return view('masterfiles.employee.edit')
								->with('employee', $employee)
								->with('branches', $this->branches);
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


	public function post(Request $request){
		dd($request->all());

	}

	public function put(Request $request){
		dd($request->all());

	}


	public function importDBF(){
	
		//$ar = ['AFV', 'ANG', 'ARA', 'ATC', 'AVE'];
		//$ar = ['BAG', 'BAL', 'BAT', 'CAL', 'CEB'];
		//$ar = ['CLK', 'CMC', 'DCC', 'DIS'];  //DAS
		//$ar = ['FES', 'GAL', 'GLV', 'GRN', 'GTR'];
		//$ar = ['HFT', 'HRB', 'HSL', 'ILO', 'KCC'];
		//$ar = ['LAN', 'LIP', 'LSS', 'LUC', 'MAR'];
		//$ar = ['MIL', 'MOA', 'MOL', 'MOR', 'NAG'];
		//$ar = ['NOR', 'PAM', 'PAV', 'ROS', 'SAM'];
		//$ar = ['SHW', 'SJD', 'SLE', 'SLP', 'SOU'];
		//$ar = ['STG', 'SUB', 'TAG', 'TAY', 'TRI'];
		//$ar = ['TUT', 'VAL', 'VSP', 'WVA'];

		//$ar = ['AFV', 'ANG', 'ARA', 'ATC', 'AVE', 'BAG', 'BAL', 'BAT', 'CAL', 'CEB'];
		//$ar = ['CLK', 'CMC', 'DCC', 'DIS', 'FES', 'GAL', 'GLV', 'GRN', 'GTR'];  //DAS
		//$ar = ['HFT', 'HRB', 'HSL', 'ILO', 'KCC', 'LAN', 'LIP', 'LSS', 'LUC', 'MAR'];
		//$ar = ['MIL', 'MOA', 'MOL', 'MOR', 'NAG', 'NOR', 'PAM', 'PAV', 'ROS', 'SAM'];
		//$ar = ['SHW', 'SJD', 'SLE', 'SLP', 'SOU', 'STG', 'SUB', 'TAG', 'TAY', 'TRI'];
		//$ar = ['TUT', 'VAL', 'VSP', 'WVA'];

		foreach ($ar as $val) {
			$this->importDBFs($val);
		}
	}

	public function importDBFs($br) { //(Request $request){

		$logfile = base_path().DIRECTORY_SEPARATOR.'logs'.DIRECTORY_SEPARATOR.'db-import.txt';

		//return Employee::with('childrens')->get();
		$import = true;

		if($import) {
			$db = dbase_open('D:\GI\\'.$br.'\GC113015\PAY_MAST.DBF', 0);
		} else {
			$db = dbase_open('D:\GI\MAR\GC113015\PAY_MAST.DBF', 0);
		}


		if ($db) {

			$header = dbase_get_header_info($db);

			
			if(!$import)
			echo '<table cellpadding="2" cellspacing="0" border="1"><thead>';

			// render table header
			if(!$import) {
				echo '<tr>';
				foreach ($header as $key => $value) {
				echo '<th>'.$value['name'].'</th>';
				}
				echo '</tr>';
			}
			
			
		 	// render table body
		 	$children_ctr = 0;
		 	$ecperson_ctr = 0;
		 	$education_ctr = 0;
		 	$work_ctr = 0;
		 	$spouse_ctr = 0;
		 	$record_numbers = dbase_numrecords($db);
		  for($i = 1; $i <= $record_numbers; $i++) {

		    $row = dbase_get_record_with_names($db, $i);
		  	if($i==1)
		  		$brcode = trim($row['BRANCH']);

		  	if($import) {
		    	$e = Employee::where('code', trim($row['MAN_NO']))->first();
		    	if(!is_null($e))
		    		continue;
		  	}

		    

		    $employee 							= new Employee;
		    $employee->code 				= trim($row['MAN_NO']);
		    $employee->lastname 		= trim($row['LAST_NAM']);
		    $employee->firstname		= trim($row['FIRS_NAM']);
		    $employee->middlename		= trim($row['MIDL_NAM']);
		    $employee->companyid		= trim($this->getCompanyId($row['CO_NAME']));
		    $employee->id 					= $employee->get_uid();
		   	$branch 								= Branch::where('code', trim($row['BRANCH']))->first();
		    $employee->branchid			= is_null($branch) ? '': $branch->id;
		    $employee->deptid				= $this->getDeptId($row['DEPT']);
		    $employee->positionid		= $this->getPositionId(trim($row['POSITION']));
		    $employee->paytype			= 2;
		    $employee->ratetype			= 2;
		    $employee->rate					= trim($row['RATE_HR']);
		    $employee->ecola				= trim($row['RATE_HR']);
		    $employee->allowance1		= trim($row['ALW1_RATE']);
		    $employee->allowance2		= trim($row['ALW2_RATE']);
		    $employee->phicno				= trim($row['PHEALTH_NO']);
		    $employee->hdmfno				= trim($row['PBIG_NO']);
		    $employee->tin 					= trim($row['WTAX_NO']);
		    $employee->sssno 				= trim($row['SSS_NO']);
		    $employee->empstatus		= $this->getEmpstatus(trim($row['EMP_STUS']));
		    $employee->datestart		= Carbon::parse(trim($row['STARTED']));
		    //$employee->datehired		= trim($row['ALW2_RATE']);
		    //$employee->datestop			= trim($row['ALW2_RATE']);
		    $employee->punching			= 1;
		    $employee->processing		= 1;
		    $employee->address			= trim($row['ADDRESS1']).', '.trim($row['ADDRESS2']).', '.trim($row['ADDRESS3']);
		    $employee->phone 				= trim($row['TEL']);
		    //$employee->fax 					= trim($row['TEL']);
		    $employee->mobile 			= trim($row['CEL']);
		    $employee->email 				= trim($row['EMAIL']);
		    $employee->gender 			= trim($row['SEX'])=='M' ? 1:2;
		    $employee->civstatus 		= trim($row['CIV_STUS'])=='SINGLE' ? 1:2;
		    $employee->height 			= str_replace("'",'.',trim($row['HEIGHT']));
		    $employee->weight 			= trim($row['WEIGHT']);
		    $employee->birthdate		= Carbon::parse(trim($row['BIRTHDATE']));
		    $employee->birthplace		= trim($row['BIRTHPLC']);
		    $employee->religionid		= trim($this->getReligionId($row['RELIGION']));
		    $employee->hobby				= trim($row['HOBBIES']);
		    $employee->notes				= 'UNIFORM:'.trim($row['UNIFORM']).'; '.
		    													'SP_NOTES1:'.trim($row['SP_NOTES1']).'; '.
		    													'SP_NOTES2:'.trim($row['SP_NOTES2']).'; ';
		    
		    
		    $childrens = [];
		    if(!empty(trim($row['CHILDREN1'])) && trim($row['CHILDREN1'])!='N/A') {
		    	$c1 = new Children;
		    	$c1->firstname = trim($row['CHILDREN1']);
		    	$c1->lastname = $employee->lastname;
		    	$c1->id = $c1->get_uid();
		    	array_push($childrens, $c1);
		    	$children_ctr++;
		    }

		    if(!empty(trim($row['CHILDREN2'])) && trim($row['CHILDREN2'])!='N/A') {
		    	$c2 = new Children;
		    	$c2->firstname = trim($row['CHILDREN2']);
		    	$c2->lastname = $employee->lastname;
		    	$c2->id = $c2->get_uid();
		    	array_push($childrens, $c2);
		    	$children_ctr++;
		    }

		    if($import)
		    	$employee->childrens()->saveMany($childrens);



		    if(!empty(trim($row['EMER_NAM'])) && trim($row['EMER_NAM'])!='N/A') {
		    	$emer = explode(' ', trim($row['EMER_NAM']));
		    	$e = new Ecperson;
		    	$e->firstname = empty($emer[0])?'':$emer[0];
		    	$e->lastname = empty($emer[1])?'':$emer[1];
		    	$e->mobile = trim($row['EMER_NO']);
		    	$e->id = $e->get_uid();
		    	$ecperson_ctr++;
		    	if($import)
		    		$employee->ecperson()->save($e);	
		    }


		    if(!empty(trim($row['EDUCATION'])) && trim($row['EDUCATION'])!='N/A') {
		    	$edu = new Education;
		    	$edu->school = trim($row['EDUCATION']);
		    	$edu->id = $edu->get_uid();
		    	

		    	if($import)
		    		$employee->educations()->saveMany([$edu]);	
		    	$education_ctr++;
		    }
		    

		    $works = [];
		    if(!empty(trim($row['WORKHIST1'])) && trim($row['WORKHIST1'])!='N/A') {
		    	$w1 = new Workexp;
		    	$w1->company = trim($row['WORKHIST1']);
		    	$w1->id = $w1->get_uid();
		    	array_push($works, $w1);
		    	$work_ctr++;
		    }

		    if(!empty(trim($row['WORKHIST2'])) && trim($row['WORKHIST2'])!='N/A') {
		    	$w2 = new Workexp;
		    	$w2->company = trim($row['WORKHIST2']);
		    	$w2->id = $w2->get_uid();
		    	array_push($works, $w2);
		    	$work_ctr++;
		    }

		    if(!empty(trim($row['WORKHIST3'])) && trim($row['WORKHIST3'])!='N/A') {
		    	$w3 = new Workexp;
		    	$w3->company = trim($row['WORKHIST3']);
		    	$w3->id = $w3->get_uid();
		    	array_push($works, $w3);
		    	$work_ctr++;
		    }

		    if(!empty(trim($row['WORKHIST4'])) && trim($row['WORKHIST4'])!='N/A') {
		    	$w4= new Workexp;
		    	$w4->company = trim($row['WORKHIST2']);
		    	$w4->id = $w4->get_uid();
		    	array_push($works, $w4);
		    	$work_ctr++;
		    }

		    if($import)
		    	$employee->workexps()->saveMany($works);


		    if(!empty(trim($row['SPOUS_NAM'])) && trim($row['SPOUS_NAM'])!='N/A' && trim($row['SPOUS_NAM'])!='NA/A' ) {
		    	$sp = preg_split("/\s+(?=\S*+$)/", trim($row['SPOUS_NAM']));
		    	$spou = new Spouse;
		    	$spou->firstname = empty($sp[0])?'':$sp[0];
		    	$spou->lastname = empty($sp[1])?'':$sp[1];
		    	$spou->id = $spou->get_uid();
		    	$spouse_ctr++;
		    	if($import)
		    		$employee->spouse()->save($spou);	
		    }

		    
				

		    if($import)
		     	$employee->save();

		   	if(!$import) {
			    echo '<tr>';
					foreach ($header as $key => $value) {
						//if($value['name']=='CO_NAME')
							//echo '<td>'.$this->getCompanyId($row[$value['name']]).'</td>';
						//else
							echo '<td>'.$row[$value['name']].'</td>';
					}
					echo '</tr>';
		   	}
		 }

		if($import) {
			echo $brcode.' imported! </br>';
			$handle = fopen($logfile, 'a');
			$content = $brcode."\n\temployee:\t\t". $record_numbers ."\n";
			$content .= "\tspouse:\t\t\t". $spouse_ctr ."\n";
			$content .= "\tchildren:\t\t". $children_ctr ."\n";
			$content .= "\tecperson:\t\t". $ecperson_ctr ."\n";
			$content .= "\tworkexp:\t\t". $work_ctr ."\n";
	    fwrite($handle, $content);
	    fclose($handle);
		}



			dbase_close($db);
		}

	}


	public function getEmpstatus($c){
		 
		switch (trim($c)) {
			case "CONTRACT":
				return 2;
				break;
			case "TRAINEE":
				return 0;
				break;
			case "TEMPORARY":
				return 1;
				break;
			case "REGULAR":
				return 3;
				break;
			default:
				return '';
				break;
		}
	}



	public function getCompanyId($c){
		 
		switch (trim($c)) {
			case "ALQUIROS FOOD CORP.":
				return '29E4E2FA672C11E596ECDA40B3C0AA12';
				break;
			case "GILIGAN'S ISLAND BAGUIO, INC.":
				return '43400E83673811E596ECDA40B3C0AA12';
				break;
			case "IONE-6 FOODS":
				return '6A2F5687673611E596ECDA40B3C0AA12';
				break;
			case "SHA-DINE-6 DINERS":
				return '81D62659673611E596ECDA40B3C0AA12';
				break;
			case "FIJON-6 FOODS":
				return '43B6B571673611E596ECDA40B3C0AA12';
				break;
			case "ROSE FOUR DINERS":
				return '7E8F8AC3673611E596ECDA40B3C0AA12';
				break;
			case "NATHANAEL-6 FOODS":
				return '70F73EAD673611E596ECDA40B3C0AA12';
				break;
			case "FILBERT'S-6 FOODS":
				return '57F10712673611E596ECDA40B3C0AA12';
				break;
			case "FJN6 FOOD CORPORATION":
				return '5C010584673611E596ECDA40B3C0AA12';
				break;
			case "KAWBINADIT CORP.":
				return '7A859059673611E596ECDA40B3C0AA12';
				break;
			case "NIKDER SIX FOODS":
				return '74B1CBDC673611E596ECDA40B3C0AA12';
				break;
			default:
				return '';
				break;
		}
	}

	public function getDeptId($dept){

		if(starts_with($dept, 'KIT'))
			return '71B0A2D2674011E596ECDA40B3C0AA12';
		if(starts_with($dept, 'DIN'))
			return '75B34178674011E596ECDA40B3C0AA12';
		if(starts_with($dept, 'OPS'))
			return '201E68D4674111E596ECDA40B3C0AA12';
		if(starts_with($dept, 'CSH'))
			return '20767330A25B11E583CA00FF59FBB323';
		if(starts_with($dept, 'ADM'))
			return 'D2E8E339A47B11E592E000FF59FBB323';
		return '';	
	
	}


	public function getReligionId($c){
		 
		switch (trim($c)) {
			case "R.CATH":
				return '1A95F32E674811E596ECDA40B3C0AA12';
				break;
			case "R. CATH":
				return '1A95F32E674811E596ECDA40B3C0AA12';
				break;
			case "R.CATH,":
				return '1A95F32E674811E596ECDA40B3C0AA12';
				break;
			case "R.CATH,":
				return '1A95F32E674811E596ECDA40B3C0AA12';
				break;
			case "R,CATH":
				return '1A95F32E674811E596ECDA40B3C0AA12';
				break;
			case "R'CATHOLIC":
				return '1A95F32E674811E596ECDA40B3C0AA12';
				break;
			case "R.CATH.":
				return '1A95F32E674811E596ECDA40B3C0AA12';
				break;
			case "MARRIED":
				return '1A95F32E674811E596ECDA40B3C0AA12';
				break;
			case "CATHOLIC":
				return '1A95F32E674811E596ECDA40B3C0AA12';
				break;
			case "CATH":
				return '1A95F32E674811E596ECDA40B3C0AA12';
				break;
			case "CAM. SUR":
				return '1A95F32E674811E596ECDA40B3C0AA12';
				break;
			case "CHRISTIAN":
				return '2975665F674811E596ECDA40B3C0AA12';
				break;
			case "JEHOVA":
				return '465B9151A30E11E592E000FF59FBB323';
				break;
			case "INC":
				return '2D6A8A3A674811E596ECDA40B3C0AA12';
				break;
			case "I.N.C.":
				return '2D6A8A3A674811E596ECDA40B3C0AA12';
				break;
			case "IGLESIA":
				return '2D6A8A3A674811E596ECDA40B3C0AA12';
				break;
			case "AGLIPAYIN":
				return '9ED09932A3D511E592E000FF59FBB323';
				break;
			case "S.D.A":
				return 'A87C6E4EA3DE11E592E000FF59FBB323';
				break;
			case "SDA":
				return 'A87C6E4EA3DE11E592E000FF59FBB323';
				break;
			case "7DAY ADVNT":
				return 'A87C6E4EA3DE11E592E000FF59FBB323';
				break;
			case "BAPTIST":
				return 'AF2E222CA3DE11E592E000FF59FBB323';
				break;
			case "BORN AGAIN":
				return '71FC2C52A3E311E592E000FF59FBB323';
				break;
			case "PROTESTANT":
				return '71FC2C52A3E311E592E000FF59FBB323';
				break;
			case "METHODIST":
				return '14D98381A47A11E592E000FF59FBB323';
				break;
			case "ALLIANCE":
				return '45942FF9A47A11E592E000FF59FBB323';
				break;
			case "L.D.SAINTS":
				return '052FE585A48011E592E000FF59FBB323';
				break;
			case "CRUSADER":
				return '0EEEE7B6A48411E592E000FF59FBB323';
				break;

				
			default:
				return '';
				break;
		}
	}


	public function getPositionId($pos){
		$p = Position::where('descriptor', $pos)->first();
		if(!is_null($p))
			return $p->id;

		switch (trim($pos)) {
			case "Dining Supv.":
				return 'B3622DDF666611E596ECDA40B3C0AA12';
				break;
			case "Dining Super":
				return 'B3622DDF666611E596ECDA40B3C0AA12';
				break;
			case "Cashier Seni":
				return '69427592A5E111E385D3C0188508F93C';
				break;
			case "Cashier Sr.":
				return '69427592A5E111E385D3C0188508F93C';
				break;
			case "Dining Asst.":
				return '8EF16963673A11E596ECDA40B3C0AA12';
				break;
			case "Kitchen Supe":
				return 'A7006EB7A3D411E592E000FF59FBB323';
				break;
			case "Kitchen Asst":
				return 'D02091AB673A11E596ECDA40B3C0AA12';
				break;
			case "OIC Kitchen":
				return '81BCB53BA3D711E592E000FF59FBB323';
				break;
			case "Kitchen Supv":
				return 'A7006EB7A3D411E592E000FF59FBB323';
				break;
			case "Manager - Op":
				return '55FC33F0A30211E592E000FF59FBB323';
				break;
			case "Mngr Branch":
				return '55FC33F0A30211E592E000FF59FBB323';
				break;
			case "Management T":
				return 'EC5ED785673A11E596ECDA40B3C0AA12';
				break;
			case "Mgmt Trainee":
				return 'EC5ED785673A11E596ECDA40B3C0AA12';
				break;
			case "Utility Staf":
				return '67B0F27F673B11E596ECDA40B3C0AA12';
				break;
			case "Tech'n":
				return 'F55DA154A47B11E592E000FF59FBB323';
				break;
			case "Tech'n Sr.":
				return '553820C0A47C11E592E000FF59FBB323';
				break;
			default:
				return '';
				break;
		}


	}

}