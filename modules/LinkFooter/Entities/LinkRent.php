<?php namespace Modules\Linkfooter\Entities;
   
use Illuminate\Database\Eloquent\Model;
use DB;
class linkRent extends Model {

     public $table='LINK_RENT';
    public $timestamps=false;

    public function scopeRentSearch($query)
    {
    	return $query->select('LINK_RENT.*',DB::raw('getCityName(LINK_RENT_CITY) as CITY_NAME'));
    }

}