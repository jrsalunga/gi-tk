<?php namespace App\Models;


use App\Models\BaseModel;

class Salesmtd extends BaseModel {


	protected $table = 'salesmtd';
 	protected $fillable = ['tblno', 'wtrno', 'ordno', 'cusno', 'cuscount', 'cusname', 'prodno', 
 												'prodname', 'orddate', 'ordtime', 'catname', 'record', 'branchid'];
	//protected $guarded = ['id'];
 

 
	
  
}