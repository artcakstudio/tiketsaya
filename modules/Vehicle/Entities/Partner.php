<?php namespace Modules\Vehicle\Entities;
   
use Illuminate\Database\Eloquent\Model;

class partner extends Model {

    protected $fillable = [];
    protected $table='partner';
    public $timestamps=false;
    public function scopefindPartner($query, $id)
    {
    	return $query->where('PARTNER_ID','=',$id);
    }
    function scopecheck_login($query,$username,$password){
    	return $query->where('PARTNER_USERNAME','=',$username)
    				->where('PARTNER_PASSWORD','=',$password);
    }
    public function scopepartner($query)
    {
        return $query->select(['PARTNER_ID', 'PARTNER_NAME']);
    }
}