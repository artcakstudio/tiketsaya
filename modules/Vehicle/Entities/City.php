<?php namespace Modules\Vehicle\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Session;
class city extends Model {

    protected $fillable = [];
    protected $table='CITY';

    const UPDATED_AT = 'CITY_UPDATE';
    function scopefindCity($query, $id)
    {
    	return $query->where('CITY_ID','=',$id);
    }
    function scopeCityPartner($query){
    	return $query->join('VEHICLE','VEHICLE.CITY_ID','=','CITY.CITY_ID')
    				->join('PARTNER','PARTNER.PARTNER_ID','=','VEHICLE.PARTNER_ID')
    				->where('PARTNER.PARTNER_ID','=',Session::get('id'));
    }
}