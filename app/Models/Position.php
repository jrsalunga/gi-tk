<?php namespace App\Models;

use App\Models\BaseModel;

class Position extends BaseModel {

	protected $table = 'position';
 	protected $fillable = ['code', 'descriptor'];
 	public static $header = ['code', 'descriptor'];

	
  
}
