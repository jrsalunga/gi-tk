<?php namespace App\Models;

use App\Models\BaseModel;

class Ecperson extends BaseModel {
 
	//protected $connection = 'hr';
	protected $table = 'ecperson';
 	protected $fillable = ['employeeid', 'lastname', 'firstname'];

	public function employee() {
    return $this->belongsTo('App\Models\Employee', 'employeeid');
  }


    //
}
