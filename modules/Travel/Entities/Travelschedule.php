<?php namespace Modules\Travel\Entities;
   
use Illuminate\Database\Eloquent\Model;
use DB;
class travelschedule extends Model {

	protected $fillable = [];
    protected $table='TRAVEL_SCHEDULE';
    const update_at='TRAVEL_SCHEDULE_UPDATE';
    public $timestamps = false;

    function scopegetScheduleDay($query,$tanggal){
    	return $query->select([DB::raw('getCityName(ROUTE_DEPARTURE) as ROUTE_DEPARTURE'), DB::raw('getCityName(ROUTE_DEST) as ROUTE_DEST'),'TRAVEL_SCHEDULE.*','VEHICLE_NAME'])
                ->where('TRAVEL_SCHEDULE_DEPARTTIME','LIKE',$tanggal.'%')
    			->join('ROUTE','ROUTE.ROUTE_ID','=','TRAVEL_SCHEDULE.ROUTE_ID')
                ->join('VEHICLE','VEHICLE.VEHICLE_ID','=','TRAVEL_SCHEDULE.VEHICLE_ID');

    }
    function scopefindSchedule($query,$id){
    	return $query->where('TRAVEL_SCHEDULE_ID','=',$id);
    }
    function scopetravelSchedule($query,$depart, $dest, $date){
        return $query->select(['TRAVEL_SCHEDULE.*','VEHICLE.*',DB::raw('getCityName(ROUTE_DEPARTURE) as ROUTE_DEPARTURE'), DB::raw('getCityName(ROUTE_DEST) as ROUTE_DEST'), 'PARTNER.*', 'VEHICLE_TYPE_NAME'])
                ->where('TRAVEL_SCHEDULE.TRAVEL_SCHEDULE_DEPARTTIME','LIKE',$date.'%')
                ->join('VEHICLE','VEHICLE.VEHICLE_ID','=','TRAVEL_SCHEDULE.VEHICLE_ID')
                ->join('VEHICLE_TYPE','VEHICLE_TYPE.VEHICLE_TYPE_ID','=','VEHICLE.VEHICLE_TYPE_ID')
                ->join('ROUTE','ROUTE.ROUTE_ID','=','TRAVEL_SCHEDULE.ROUTE_ID')
                ->where('ROUTE.ROUTE_DEPARTURE','=',$depart)
                ->where('ROUTE.ROUTE_DEST','=',$dest)
                ->join('CITY','CITY.CITY_ID','=','ROUTE.ROUTE_ID')
                ->join('PARTNER','PARTNER.PARTNER_ID','=','VEHICLE.PARTNER_ID')
            /*    ->where('VEHICLE.VEHICLE_CAPACITY', '>', function($query) use($date){
                    $query->select('TRAVEL_SCHEDULE.TRAVEL_SCHEDULE_ID')
                        ->from('TRAVEL_TRANSACTION')
                        ->join('TRAVEL_SCHEDULE','TRAVEL_SCHEDULE.TRAVEL_SCHEDULE_ID','=','TRAVEL_TRANSACTION.TRAVEL_SCHEDULE_ID')
                        ->where('TRAVEL_SCHEDULE.TRAVEL_SCHEDULE_DEPARTTIME','LIKE',$date.'%')
                        ->sum('TRAVEL_SSCHEDULE.TRAVEL_SCHEDULE_ID');
                })*/;
    }
}