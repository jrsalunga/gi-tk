<?php namespace App\Models;

use App\Models\BaseModel;

class Branch extends BaseModel {

	protected $table = 'branch';
 	protected $fillable = ['code', 'descriptor'];
 	public static $header = ['code', 'descriptor'];

 	public function __construct(array $attributes = [])
  {
    parent::__construct($attributes);
    if (app()->environment()==='production')
      $this->setConnection('mysql-hr');
      
    $this->setConnection('mysql-hr');
  }

	public function employee() {
    return $this->hasMany('App\Models\Employee', 'employeeid');
  }
  
}
