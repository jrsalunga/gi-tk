<?php namespace App\Models;

use App\Models\BaseModel;

class Children extends BaseModel {
 
	//protected $connection = 'hr';
	protected $table = 'children';
 	protected $fillable = ['employeeid', 'lastname', 'firstname'];

	public function employee() {
    return $this->belongsTo('App\Models\Employee', 'employeeid');
  }


    //
}
