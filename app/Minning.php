<?php

namespace App;

use \DB;
use Carbon\Carbon;


class Minning {
	
	const VARIABLES_TABLE = 'data_minning_variables';
	const VALUES = 'data_minning_values';

	const DIS_TASK_STATUS = array('Asignada' => 1, 'Revision' => 2, 'Cumplida'=> 3, 'Cancelada' => 4, 'Diferida' => 5, 'Retardada' => 6);
	const DIS_TASK_TYPE = array('Academico-Docente' => 1, 'Administrativas' => 2, 'Creacion-Intelectual' => 3 , 'Integracion Social' => 4, 'Administrativo-Docente' => 5, 'Produccion' => 6);

	public static function getVariables(){
		return \DB::table(self::VARIABLES_TABLE)->get();
	}

	public static function countRecords(array $variables_id){

		return ;
	}


	public static function discretize($collectionObj){

	}

	public static function nomalize($collectionObj){
		
	}

	public static function prepareQuery(){

	}

	public static function clusterize(){

	}
}
