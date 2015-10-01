<?php namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Manskedhdr;


class Manskedhdr extends BaseModel {

	

	public function __construct(){
		
	}

	protected $table = 'manskedhdr';
 	protected $fillable = ['refno', 'date', 'branchid', 'managerid', 'mancost', 'weekno', 'notes', 'createdate'];
 	//public static $header = ['code', 'descriptor'];

 	public function manskeddays() {
 		return $this->hasMany('App\Models\Manskedday', 'manskedid');
 	}

	public function branch() {
    return $this->belongsTo('App\Models\Branch', 'branchid');
  }

  public function manager() {
    return $this->belongsTo('App\Models\Employee', 'managerid');
  }


  public static function getWeeks($year) {
  	$mw = Manskedhdr::select('weekno')->where(\DB::raw('YEAR(date)'), '=',  $year)->get();
  	$m = $mw->pluck('weekno')->toArray();
  	
  	for($week_ctr = 0; $week_ctr <= (date("W", mktime(0,0,0,12,28,$year))+1);  $week_ctr++){
			//array_push($weeks, $week_ctr+1);
			$weeks[$week_ctr]['week'] = $week_ctr + 1;;
			$weeks[$week_ctr]['created'] = in_array($week_ctr, $m) ? 'yes':'no';
		}
		return $weeks;
  }


  public static function checkWeeks(){

  }

  public static function paginateWeeks(Request $request, $year='2015', $limit=10) {
  	$weeks = self::getWeeks($year);
  	$page = !empty($request->input('page')) ? $request->input('page'):1;
  	$offset = (intval($page) - 1) * $limit;
  	//$paginator = new Paginator(array_slice($weeks, $offset), $limit);
  	//dd(Collection::make($weeks));
  	$sliced = array_slice($weeks, $offset, $limit);
  	$paginator = new Paginator($sliced, count($weeks), $limit);
  	$paginator->setPath('mansked');
  	
  	return $paginator;

  }

 




  
}
