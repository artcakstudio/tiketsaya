<?php namespace Modules\Travel\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Traveltransaction extends Model {

     protected $fillable = [];
    protected $table='TRAVEL_TRANSACTION';
    //	const update_at = 'TRAVEL_TRANSACTION_UPDATE';
    public $timestamps = false;
    

    public function setUpdateAtAttribute($value){

    }
    public function scopegetAllTransaction($query)
	{
    	return $query->select(['TRAVEL_TRANSACTION.*','MEMBER.*','TRAVEL_TRANSACTION_STATUS.TRAVEL_TRANSACTION_STATUS_NAME'])
    			->join('MEMBER','MEMBER.MEMBER_ID','=','TRAVEL_TRANSACTION.MEMBER_ID')
    			->join('TRAVEL_TRANSACTION_STATUS','TRAVEL_TRANSACTION_STATUS.TRAVEL_TRANSACTION_STATUS_ID','=','TRAVEL_TRANSACTION.TRAVEL_TRANSACTION_STATUS_ID');
    }
    function scopefindTransaction($query,$id){
    	return $query->where('TRAVEL_TRANSACTION_ID','=',$id);
    }

}