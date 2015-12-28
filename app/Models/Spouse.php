<?php namespace App\Models;

use App\Models\BaseModel;

class Spouse extends BaseModel {
 
	//protected $connection = 'hr';
	protected $table = 'spouse';
 	protected $fillable = ['employeeid', 'lastname', 'firstname'];

	public function employee() {
    return $this->belongsTo('App\Models\Employee', 'employeeid');
  }


    //
}
