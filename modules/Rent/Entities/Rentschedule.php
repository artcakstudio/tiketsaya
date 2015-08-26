<?php namespace Modules\Rent\Entities;
   
use Illuminate\Database\Eloquent\Model;

class rentschedule extends Model {

    protected $fillable = [];
    protected $timestamp=false;
    const UPDATE_AT='RENT_SCHEDULE_UPDATE';
    protected $table='RENT_SCHEDULE';
    function scopegetScheduleDay($query,$tanggal){
    	return $query->select(['VEHICLE.*','RENT_SCHEDULE.*'])
    			->join('VEHICLE','VEHICLE.VEHICLE_ID','=','RENT_SCHEDULE.VEHICLE_ID')
                ->where('RENT_SCHEDULE.RENT_SCHEDULE_DATE','LIKE','%'.$tanggal)	;

    }
    function scopefindRentSchedule($query,$id){
    	return $query->where('RENT_SCHEDULE_ID','=',$id);
    }
     function scoperentSchedule($query,$city, $date,$duration){
        return $query->select(['RENT_SCHEDULE.*','VEHICLE.*', 'PARTNER.*','CITY_NAME','VEHICLE_TYPE_NAME'])
                ->where('RENT_SCHEDULE_DATE','=',$date)
                ->whereNotIn('RENT_SCHEDULE_ID',function($query){
                    $query->select(['RENT_SCHEDULE_ID'])
                        ->from('RENT_TRANSACTION_DETAIL');})
                ->join('VEHICLE','VEHICLE.VEHICLE_ID','=','RENT_SCHEDULE.VEHICLE_ID')
                ->join('CITY','CITY.CITY_ID','=','VEHICLE.CITY_ID')
                ->where('CITY.CITY_ID','=',$city)
                ->join('PARTNER','PARTNER.PARTNER_ID','=','VEHICLE.PARTNER_ID')
                ->join('VEHICLE_TYPE','VEHICLE_TYPE.VEHICLE_TYPE_ID','=','VEHICLE.VEHICLE_TYPE_ID');
    }
}