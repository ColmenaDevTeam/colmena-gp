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
				if ($weekDay == 7) {
					$week++;
				};
			}
		}
		return $months;
	}
	public static function getDateArray($customDates = []){
		if (count($customDates) > 0) {
			$dates = $customDates;
		}else {
			$dates = self::all();
		}
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

	public static function getNextWorkableDate($now){#now must be a string in datestring format (Y/m/d)
		$next = self::where('workable_date', '>',$now.' 0:0:0'/*timestamp formating*/)->get()->first();
		return is_null($next) ? null : $next->workable_date->toDateString();#output will be a string in datestring format (Y/m/d)
	}

	public function getAbleWorkableDates(){
		$dates = self::where('workable_date', '>=', date('Y/m/d').' 0:0:0'/*timestamp formating*/)->get();
		return count($dates) ? self::getDateArray($dates) : null;
	}

	public static function checkAvailability(){
		return count(self::where('workable_date', '>=', date('Y/m/d').' 0:0:0')->count()) > 0 ? true : false;
	}
}
