<?php namespace Modules\Travel\Entities;
   
use Illuminate\Database\Eloquent\Model;
use DB;
class Traveltransaction extends Model {

     protected $fillable = [];
    protected $table='TRAVEL_TRANSACTION';
    //	const update_at = 'TRAVEL_TRANSACTION_UPDATE';
    public $timestamps = false;
    

    public function setUpdateAtAttribute($value){

    }
    public function scopegetAllTransaction($query)
	{
    	return $query->select(['TRAVEL_SCHEDULE.*','TRAVEL_TRANSACTION.*','TRAVEL_TRANSACTION_STATUS_NAME','COSTUMER.*',DB::raw('getCityName(ROUTE_DEPARTURE) as ROUTE_DEPARTURE'), DB::raw('getCityName(ROUTE_DEST) as ROUTE_DEST')])
    			->join('COSTUMER','COSTUMER.COSTUMER_ID','=','TRAVEL_TRANSACTION.COSTUMER_ID')
    			->join('TRAVEL_TRANSACTION_STATUS','TRAVEL_TRANSACTION_STATUS.TRAVEL_TRANSACTION_STATUS_ID','=','TRAVEL_TRANSACTION.TRAVEL_TRANSACTION_STATUS_ID')
                ->join('TRAVEL_SCHEDULE','TRAVEL_SCHEDULE.TRAVEL_SCHEDULE_ID','=','TRAVEL_TRANSACTION.TRAVEL_SCHEDULE_ID')
                ->join('ROUTE','ROUTE.ROUTE_ID','=','TRAVEL_SCHEDULE.ROUTE_ID');
    }
    function scopefindTransaction($query,$id){
    	return $query->where('TRAVEL_TRANSACTION_ID','=',$id);
    }
/*    function scopetotalPenumpang($query,$id_schedule){
        return $query->select('SUM (TRAVEL_TRANSACTION_PASSENGER)')
                        ->where('TRAVEL_SCHEDULE_ID','=',$id_schedule);
    }*/
}