<?php
namespace App;

use DB;

trait EnumHelper {
	public static function getEnumValues($field){
		$instance = new static;
		$type = DB::select(DB::raw('SHOW COLUMNS FROM '.$instance->getTable().' WHERE Field = "'.$field.'"'))[0]->Type;
		preg_match('/^enum\((.*)\)$/', $type, $matches);
		$values = array();
		foreach(explode(',', $matches[1]) as $value){
			$values[] = trim($value, "'");
		}
		return $values;
	}
}
