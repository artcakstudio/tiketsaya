<?php namespace Modules\Rent\Entities;
   
use Illuminate\Database\Eloquent\Model;

class renttransactiondetail extends Model {

    protected $fillable = [];
    public $timestamps=false;
    protected $table='RENT_TRANSACTION_DETAIL';

    public function scopeGetDetail($query,$id)
    {
    	return $query->select(['RENT_SCHEDULE.RENT_SCHEDULE_DATE','VEHICLE.VEHICLE_NAME'])
    				->where('RENT_TRANSACTION_DETAIL.RENT_TRANSACTION_ID','=',$id)
			    	->join('RENT_SCHEDULE','RENT_SCHEDULE.RENT_SCHEDULE_ID','=','RENT_TRANSACTION_DETAIL.RENT_SCHEDULE_ID')
			    	->join('VEHICLE','VEHICLE.VEHICLE_ID','=','RENT_SCHEDULE.VEHICLE_ID');
    }
}