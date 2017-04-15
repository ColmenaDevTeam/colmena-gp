<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Calendar extends Model
{
	const MONTHS = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'workable_date'
	];

	protected $dates = ['workable_date'];
	public $timestamps = false;
    protected $table = 'calendar';
	protected $primaryKey = 'workable_date';
	public $incrementing = false;
	
	public static function generateDates(){
		for ($j=1; $j <=12 ; $j++) {
			$month = strtotime(date('Y').'-'.$j);
			//dd($month);
			$week = 1;
			for($i=1;$i<=date('t',$month);$i++) {
				$weekDay = date('N', strtotime(date('Y').'-'.$j.'-'.$i));
				//dd($day_week);
				$months[$j][$week][$weekDay] = $i;
				if ($weekDay == 7) { $week++; };
			}
		}
		return $months;
	}
	public static function getDateArray(){
		$dates = self::all();
		$array = [];

		foreach ($dates as $date) {
			$array[] = $date->workable_date->toDateString();
		}

		return $array;
	}

	public static function checkYear(){
		$date = self::all()->first();
		$actual = date("Y");
		if (!is_null($date) && $actual > $date->workable_date->year )
			self::truncate();
	}
	/*
	public static function comparaAno(){

        $Ocalendario = Ccalendario::all()->first();
        $ultima= $Ocalendario->getOriginal('fecLab');
        $actual = date("Y-m-d");

        $aActual=explode("-", $actual);
        $aUltima=explode("-", $ultima);

        if ($aActual[0]>$aUltima[0])
            return true;
        else return false;
    }

    public static function getProxima($actual){
        $proximaFecha = Ccalendario::where('fecLab', '>',$actual)->get()->first();
        if (is_null($proximaFecha)) {
          return NULL;
        }
        return $proximaFecha->getOriginal('fecLab');

    }

	    public static function getFechasDisponibles(){
	        return $fechasDisponibles = Ccalendario::all();
	    }

	*/
}
