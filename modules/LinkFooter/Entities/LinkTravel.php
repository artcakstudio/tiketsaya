<?php namespace Modules\Linkfooter\Entities;
   
use Illuminate\Database\Eloquent\Model;
use DB;
class linkTravel extends Model {

    protected $fillable = [];
    public $table='LINK_TRAVEL';
    public $timestamps=false;

    public function scopeTravelSearch($query)
    {
    	return $query->select('LINK_TRAVEL.*',DB::raw('getCityName(LINK_TRAVEL_DEPARTURE) as ROUTE_DEPARTURE'), DB::raw('getCityName(LINK_TRAVEL_DEST) as ROUTE_DEST'));
    }
}