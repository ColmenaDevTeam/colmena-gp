<?php

namespace App;

use \DB;
use Carbon\Carbon;


class Minning {
	
	const MODELS_TABLE = 'data_minning_models';
	const VARIABLES_TABLE = 'data_minning_variables';
	const VALUES_TABLE = 'data_minning_values';

	const DIS_TASK_STATUS = array('Asignada' => 1, 'Revision' => 2, 'Cumplida'=> 3, 'Cancelada' => 4, 'Diferida' => 5, 'Retardada' => 6);
	const DIS_TASK_TYPE = array('Academico-Docente' => 1, 'Administrativas' => 2, 'Creacion-Intelectual' => 3 , 'Integracion Social' => 4, 'Administrativo-Docente' => 5, 'Produccion' => 6);
	const DIS_USER_TYPE = array('Docente' => 1, 'Administrativo' => 2, 'Mantenimiento' => 3);


	public static function getVariables(array $variables_id = null){
		
		return is_null($variables_id) ? DB::table(self::VARIABLES_TABLE)->get()
			   : DB::table(self::VARIABLES_TABLE)->whereIn('id', $variables_id)->get();
	}

	public static function countRecords(array $variables_id){
		
		$variables = self::getVariables($variables_id);
		$rawQuery = self::prepareQuery($variables);

		$count = DB::select("select count(*) as total from (select " . $rawQuery['columns'] . "from" . $rawQuery['tables'] . $rawQuery['querys'] . ") count")[0]->total;
		return $count;
	}

	public static function generateModel($data){
		$model_id = DB::table(self::MODELS_TABLE)->insertGetId([
			'name' => $data['name'],
			#'description' => $data['description'],
			'clusters' => $data['clusters'],
			'min_selected' => $data['range_min'],
			'max_selected' => $data['range_max'],
			'total_avaliable' => $data['count'],
			'variables' => json_encode($data['variables'])
		]);
		return $model_id;
	}

	public static function getModels(){
		return DB::table(self::MODELS_TABLE)->get();
	}

	public static function getModel($model_id){
		return DB::table(self::MODELS_TABLE)->where('id', $model_id)->first();
	}

	public static function deleteModel($id){
		DB::table(self::MODELS_TABLE)->delete();
		return ;
	}

	public static function getRecords(array $variables_id, $min, $max){
		$variables = self::getVariables($variables_id);
		$rawQuery = self::prepareQuery($variables);
		$records = DB::select("select " . $rawQuery['columns'] . "from" . $rawQuery['tables'] . $rawQuery['querys'] . " LIMIT " . ($max-$min) . " OFFSET " . ($min-1));
		return $records;
	}

	public static function discretize($value, $variable){
		$discretized = null;

		switch ($variable) {
			case 'tasks_estimated_date':
				$discretized = (int)str_replace("-","",$value);
				break;
			case 'users_has_tasks_deliver_date':
				$discretized = (int)str_replace("-","",$value);
				break;
			case 'users_has_tasks_status':
				$discretized = self::DIS_TASK_STATUS[$value];
				break;
			case 'tasks_type':
				$discretized = self::DIS_TASK_TYPE[$value];
				break;				
			case 'absences_type':
				$discretized = $value ? 1 : 2;
				break;								
			case 'users_user_type':
				$discretized = self::DIS_USER_TYPE[$value];
				break;								
			default:
				$discretized = $value;
				break;
		}
		return $discretized;
	}

	public static function normalize($values, $variables){
		$done = [];
		$aloneVar = [];
		for ($i=0; $i < count($variables); $i++) { 
			$aloneVar[$variables[$i]] = array_column($values, $variables[$i]);
		}
		$vars = array_keys($aloneVar);
		$media = array();
		$stdDev = array();
		for ($i=0; $i < count($vars); $i++) { 
			$media[$vars[$i]] = 0;
			$stdDev[$vars[$i]] = 0;
		}
		foreach ($aloneVar as $var => $value) {
			$count = count($value);
			$sum = 0;
			foreach ($value as $key) {
				$sum += $key[1];
			}
			$media[$var] = $sum/$count;
			$summation = 0;
			foreach ($value as $key) {
				$summation += ($key[1] - $media[$var])^2;
			}
			$stdDev[$var] = sqrt( $summation/$count );
		}
		foreach ($values as $value) {
			for ($i=0; $i < count($vars); $i++) { 
				$value[$vars[$i]][] = ( $value[$vars[$i]][1] - $media[$vars[$i]] ) / $stdDev[$vars[$i]];
				$value[$vars[$i]] = json_encode($value[$vars[$i]]);
			}
			$done[] = $value;
		}
		return $done;
	}

	public static function prepareQuery($variables){
		$tables = [];
		$columns = [];
		$querys = [];
		foreach ($variables as $var) {
			if (!in_array($var->sql_table, $tables)) {
				$tables[] = $var->sql_table;
			}
			$querys[] = $var->sql_query;
			$columns[] = $var->sql_name;		
		}
		
		$tables_query = '';
		for ($i=0; $i < count($tables); $i++) { 
			$tables_query = ($i == count($tables) - 1) 
							? $tables_query . ' ' . $tables[$i]
							: $tables_query . ' ' . $tables[$i] . ',' ;
		}

		$columns_query = '';
		for ($i=0; $i < count($columns); $i++) { 
			$columns_query = ($i == count($columns) - 1) 
							? $columns_query . ' ' . $columns[$i] . ' as '.str_replace(".","_",$columns[$i]).' '
							: $columns_query . ' ' . $columns[$i] . ' as '.str_replace(".","_",$columns[$i]).',' ;
		}

		$sql = "";
		for ($i=0; $i < count($querys); $i++) { 
			$sql = $sql . ' ' . $querys[$i];
		}
		return array('tables' => $tables_query, 'columns' => $columns_query, 'querys' => $sql);
	}

	public static function saveValues($dataArray){
		DB::table(self::VALUES_TABLE)->insert($dataArray);
	}

	public static function clusterize(){

	}
}
