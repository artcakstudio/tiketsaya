<?php namespace Modules\Vehicle\Entities;
   
use Illuminate\Database\Eloquent\Model;

class vehicle extends Model {

    protected $fillable = [];
    protected $table="vehicle";
    public $timestamp=false;
    const UPDATED_AT = 'VEHICLE_UPDATE';

    public function scopegetAllVehicle($query)
    {
    	return $query->select(['CITY_NAME','VEHICLE_NAME','VEHICLE_CAPACITY','PARTNER_NAME','VEHICLE_DESCRIPTION','VEHICLE_PHOTO','VEHICLE_TYPE_NAME','VEHICLE_STATUS_NAME','VEHICLE_ID'])
    		->join('PARTNER','PARTNER.PARTNER_ID','=','VEHICLE.PARTNER_ID')
    		->join('CITY','CITY.CITY_ID','=','VEHICLE.CITY_ID')
    		->join('VEHICLE_STATUS','VEHICLE_STATUS.VEHICLE_STATUS_ID','=','VEHICLE.VEHICLE_STATUS_ID')
    		->join('VEHICLE_TYPE','VEHICLE_TYPE.VEHICLE_TYPE_ID','=','VEHICLE.VEHICLE_TYPE_ID');

    }
    public function scopegetSingleVehicle($query,$id)
    {
        return $query->select(['CITY_NAME','VEHICLE_NAME','VEHICLE_CAPACITY','PARTNER_NAME','VEHICLE_DESCRIPTION','VEHICLE_PHOTO','VEHICLE_TYPE_NAME','VEHICLE_STATUS_NAME','VEHICLE_ID'])
            ->join('PARTNER','PARTNER.PARTNER_ID','=','VEHICLE.PARTNER_ID')
            ->join('CITY','CITY.CITY_ID','=','VEHICLE.CITY_ID')
            ->join('VEHICLE_STATUS','VEHICLE_STATUS.VEHICLE_STATUS_ID','=','VEHICLE.VEHICLE_STATUS_ID')
            ->join('VEHICLE_TYPE','VEHICLE_TYPE.VEHICLE_TYPE_ID','=','VEHICLE.VEHICLE_TYPE_ID')
            ->where('VEHICLE_ID','=',$id);

    }
    function scopefindVehicle($query,$id)
    {
        return $query->where('VEHICLE_ID','=',$id);
    }
    function scopegetCapacity($query,$id_schedule)
    {
        return $query->select(['VEHICLE_CAPACITY'])
                    ->join('TRAVEL_SCHEDULE','TRAVEL_SCHEDULE.VEHICLE_ID','=','VEHICLE.VEHICLE_ID')
                    ->where('TRAVEL_SCHEDULE.TRAVEL_SCHEDULE_ID','=',$id_schedule);
    }
}