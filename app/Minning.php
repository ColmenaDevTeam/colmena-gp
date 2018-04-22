<?php

namespace App;

use \DB;
use Carbon\Carbon;


class Minning {
	
	const VARIABLES_TABLE = 'data_minning_variables';
	const VALUES = 'data_minning_values';

	const DIS_TASK_STATUS = array('Asignada' => 1, 'Revision' => 2, 'Cumplida'=> 3, 'Cancelada' => 4, 'Diferida' => 5, 'Retardada' => 6);
	const DIS_TASK_TYPE = array('Academico-Docente' => 1, 'Administrativas' => 2, 'Creacion-Intelectual' => 3 , 'Integracion Social' => 4, 'Administrativo-Docente' => 5, 'Produccion' => 6);

	public static function getVariables(array $variables_id = null){
		
		return is_null($variables_id) ? DB::table(self::VARIABLES_TABLE)->get()
			   : DB::table(self::VARIABLES_TABLE)->whereIn('id', $variables_id)->get();
	}

	public static function countRecords(array $variables_id){
		
		$variables = self::getVariables($variables_id);
		$crudeQuery = self::prepareQuery($variables);
		
		$count = count(DB::select("select" . $crudeQuery['columns'] . "from" . $crudeQuery['tables'] . $crudeQuery['querys']));
		return $count;
	}
	public static function discretize($collectionObj){

	}

	public static function normalize($collectionObj){
		
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
							? $columns_query . ' ' . $columns[$i] . ' '
							: $columns_query . ' ' . $columns[$i] . ',' ;
		}

		$sql = "";
		for ($i=0; $i < count($querys); $i++) { 
			$sql = $sql . ' ' . $querys[$i];
		}
		return array('tables' => $tables_query, 'columns' => $columns_query, 'querys' => $sql);
	}

	public static function clusterize(){

	}
}
