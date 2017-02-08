<?php namespace App\Models;


use App\Models\BaseModel;
use Carbon\Carbon;

class Salesmtdhdr extends BaseModel {


	protected $table = 'salesmtdhdr';
 	protected $fillable = ['year', 'month', 'time', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun', 'branchid'];
	//protected $guarded = ['id'];
 

 	public function getTimeAttribute($value){
      return Carbon::parse($this->year.'-'.$this->month.'-01 '.$value);
  }
	
  
}