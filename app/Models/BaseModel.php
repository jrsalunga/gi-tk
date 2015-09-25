<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model {

	public static function get_uid(){
		$id = \DB::select('SELECT UUID() as id');
		$id = array_shift($id);
		return strtoupper(str_replace("-", "", $id->id));
	}


	public function next($fields = ['id']) {
		$class = get_called_class();
		$res = $class::where('id', '>', $this->id)->orderBy('id', 'ASC')->get($fields)->first();
		return !empty($res) ? $res : 'false';
	}

	public function previous($fields = ['id']) {
		$class = get_called_class();
		$res = $class::where('id', '<', $this->id)->orderBy('id', 'DESC')->get($fields)->first();
		return !empty($res) ? $res : 'false';
	}
	
}
