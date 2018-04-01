<?php
namespace App;

use DB;

trait EnumHelper {
	public static function getEnumValues($field){
		$instance = new static();
		if (env('DB_CONNECTION') == 'pgsql') {
			$types = DB::select("
			select matches[1]
			from pg_constraint,
			regexp_matches(consrc, '''(.+?)''', 'g') matches
			where contype = 'c'
			and conname = '".$instance->getTable()."_".$field."_check'
			and conrelid = 'public.tasks'::regclass;
			");
			$values = array();
			foreach($types as $type){
				$values[] = $type->matches;
			}
			return $values;
		}elseif (env('DB_CONNECTION') == 'mysql') {
			$type = DB::select(DB::raw('SHOW COLUMNS FROM '.$instance->getTable().' WHERE Field = "'.$field.'"'))[0]->Type;
			preg_match('/^enum\((.*)\)$/', $type, $matches);
			$values = array();
			foreach(explode(',', $matches[1]) as $value){
				$values[] = trim($value, "'");
			}
			return $values;
		}else {
			return null;
		}
	}
}
