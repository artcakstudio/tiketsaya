<?php namespace Modules\Travel\Entities;
   
use Illuminate\Database\Eloquent\Model;
use DB;
class TravelScheduleUmum extends Model {

    protected $fillable = [];
    protected $table='TRAVEL_SCHEDULE_UMUM';
    public $timestamps=false;

    function scopescheduleMingguan($query){
    	return $query->select(['TRAVEL_SCHEDULE_UMUM.*', 'DAY.*',DB::raw('getCityName(ROUTE_DEPARTURE) as ROUTE_DEPARTURE'), DB::raw('getCityName(ROUTE_DEST) as ROUTE_DEST'),'TRAVEL_SCHEDULE.*','VEHICLE.*'])
    				->join('TRAVEL_SCHEDULE_UMUMXDAY','TRAVEL_SCHEDULE_UMUMXDAY.TRAVEL_SCHEDULE_UMUM_ID','=', 'TRAVEL_SCHEDULE_UMUM.TRAVEL_SCHEDULE_UMUM_ID')
    				->join('DAY','DAY.DAY_ID','=','TRAVEL_SCHEDULE_UMUMXDAY.DAY_ID')
    				->join('TRAVEL_SCHEDULE','TRAVEL_SCHEDULE.TRAVEL_SCHEDULE_UMUM_ID','=','TRAVEL_SCHEDULE_UMUM.TRAVEL_SCHEDULE_UMUM_ID')
    				->join('VEHICLE','VEHICLE.VEHICLE_ID','=','TRAVEL_SCHEDULE.VEHICLE_ID')
	                ->join('VEHICLE_TYPE','VEHICLE_TYPE.VEHICLE_TYPE_ID','=','VEHICLE.VEHICLE_TYPE_ID')
	                ->join('ROUTE','ROUTE.ROUTE_ID','=','TRAVEL_SCHEDULE.ROUTE_ID') 
	                ->join('PARTNER','PARTNER.PARTNER_ID','=','VEHICLE.PARTNER_ID')
	                ->groupBy('TRAVEL_SCHEDULE_UMUM.TRAVEL_SCHEDULE_UMUM_ID');
	    }
}