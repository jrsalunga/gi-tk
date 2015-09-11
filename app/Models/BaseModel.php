<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model {

	public static function get_uid(){
		$id = \DB::select('SELECT UUID() as id');
		$id = array_shift($id);
		return strtoupper(str_replace("-", "", $id->id));
	}
	
}
