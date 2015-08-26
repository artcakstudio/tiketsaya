<?php namespace Modules\Travel\Entities;
   
use Illuminate\Database\Eloquent\Model;
use DB;
class traveltransactiondetail extends Model {

    protected $fillable = [];
    protected $table='TRAVEL_TRANSACTION_DETAIL';
    public function scopeGetDetail($query,$id)
    {
    	return $query->select(['TRAVEL_SCHEDULE.TRAVEL_SCHEDULE_ARRIVETIME','TRAVEL_SCHEDULE.TRAVEL_SCHEDULE_DEPARTTIME', DB::raw('getCityName(ROUTE_DEST) as ROUTE_DEST'),DB::raw('getCityName(ROUTE_DEPARTURE) as ROUTE_DEPARTURE')])
    				->where('TRAVEL_TRANSACTION_DETAIL.TRAVEL_TRANSACTION_ID','=',$id)
			    	->join('TRAVEL_SCHEDULE','TRAVEL_SCHEDULE.TRAVEL_SCHEDULE_ID','=','TRAVEL_TRANSACTION_DETAIL.TRAVEL_SCHEDULE_ID')
			    	->join('ROUTE','ROUTE.ROUTE_ID','=','TRAVEL_SCHEDULE.ROUTE_ID');
    }

}