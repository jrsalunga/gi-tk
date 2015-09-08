<?php namespace App\Models;

use App\Models\BaseModel;

class Employee extends BaseModel {

	protected $table = 'employee';
 	protected $fillable = ['code', 'lastname', 'firstname', 'middlename', 'position', 'branchid', 'punching', 'processing'];
 	public static $header = ['code', 'lastname'];


 	public function timelogs() {
    return $this->hasMany('App\Models\Timelog', 'employeeid');
  }

  public function branch() {
    return $this->belongsTo('App\Models\Branch', 'branchid');
  }
	
}
