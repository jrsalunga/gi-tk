<?php namespace App\Models;

use App\Models\BaseModel;

class Education extends BaseModel {
 
	//protected $connection = 'hr';
	protected $table = 'education';
 	protected $fillable = ['employeeid', 'school'];

	public function employee() {
    return $this->belongsTo('App\Models\Employee', 'employeeid');
  }


    //
}
