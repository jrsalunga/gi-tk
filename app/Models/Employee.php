<?php namespace App\Models;

use App\Models\BaseModel;

class Employee extends BaseModel {

  //protected $connection = 'hr';
	protected $table = 'employee';
 	protected $fillable = ['code', 'lastname', 'firstname', 'middlename', 'positionid', 'branchid', 'punching', 'processing'];
 	public static $header = ['code', 'lastname'];
  public $timestamps = false;

  public function __construct(array $attributes = [])
  {
    parent::__construct($attributes);
    if (app()->environment()==='production')
      $this->setConnection('mysql-hr');
      
    $this->setConnection('mysql-hr');
  }

 	public function timelogs() {
    return $this->hasMany('App\Models\Timelog', 'employeeid');
  }

  public function branch() {
    return $this->belongsTo('App\Models\Branch', 'branchid');
  }

  public function position() {
    return $this->belongsTo('App\Models\Position', 'positionid');
  }

  public function uploads() {
    return $this->hasMany('App\Models\Upload', 'employeeid');
  }

  public function manskeddtls() {
    return $this->hasMany('App\Models\Manskeddtl', 'employeeid');
  }

  public function manskedhdr() {
    return $this->hasMany('App\Models\Manskedhdr', 'managerid');
  }

  public function childrens() {
    return $this->hasMany('App\Models\Children', 'employeeid');
  }

  public function ecperson() {
    return $this->hasOne('App\Models\Ecperson', 'employeeid');
  }

  public function educations() {
    return $this->hasMany('App\Models\Education', 'employeeid');
  }

  public function workexps() {
    return $this->hasMany('App\Models\Workexp', 'employeeid');
  }

  public function spouse() {
    return $this->hasOne('App\Models\Spouse', 'employeeid');
  }




   /**
     * Query Scope.
     *
     */
   // Employee::Branchid('1')->get()
    public function scopeBranchid($query, $id)
    {
        return $query->where('branchid', $id);
    }
	
}
