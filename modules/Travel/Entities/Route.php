<?php namespace Modules\Travel\Entities;
   
use Illuminate\Database\Eloquent\Model;
use DB;
class route extends Model {

    protected $fillable = [];
    protected $table='route';
    const update_at='ROUTE_UPDATE';
    public $timestamps = false;

    function scopegetAllRoute($query){
    	return $query->select([DB::raw('getCityName(ROUTE_DEPARTURE) as ROUTE_DEPARTURE'), 'ROUTE_ID', DB::raw('getCityName(ROUTE_DEST) as ROUTE_DEST')])
    		->from('ROUTE');
    }
    function scopefindRoute($query,$id)
    {
    	return $query->where('ROUTE_ID','=',$id);
    }
    function scopegetRoutePartner($query, $partner_id)
    {
        return $query->select([DB::raw('getCityName(ROUTE_DEPARTURE) as ROUTE_DEPARTURE'), 'ROUTE_ID', DB::raw('getCityName(ROUTE_DEST) as ROUTE_DEST')])
            ->from('ROUTE')
            ->where('ROUTE_CREATEBY','=',$partner_id);
    }
    
}