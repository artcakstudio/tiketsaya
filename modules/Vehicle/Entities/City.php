<?php namespace Modules\Vehicle\Entities;
   
use Illuminate\Database\Eloquent\Model;

class city extends Model {

    protected $fillable = [];
    protected $table='city';

    const UPDATED_AT = 'CITY_UPDATE';
    function scopefindCity($query, $id)
    {
    	return $query->where('CITY_ID','=',$id);
    }
}