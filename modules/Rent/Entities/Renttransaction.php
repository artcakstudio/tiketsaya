<?php namespace Modules\Rent\Entities;
   
use Illuminate\Database\Eloquent\Model;

class renttransaction extends Model {

    protected $fillable = [];
    protected $table='RENT_TRANSACTION';
    //	const update_at = 'RENT_TRANSACTION_UPDATE';
    public $timestamps = false;
    

    public function setUpdateAtAttribute($value){

    }
    public function scopegetAllTransaction($query)
	{
    	return $query->select(['RENT_TRANSACTION.*','MEMBER.*','STATUS_TRANSACTION_RENT_NAME'])
    			->join('MEMBER','MEMBER.MEMBER_ID','=','RENT_TRANSACTION.MEMBER_ID')
    			->join('STATUS_TRANSACTION_RENT','STATUS_TRANSACTION_RENT.STATUS_TRANSACTION_RENT_ID','=','RENT_TRANSACTION.STATUS_TRANSACTION_RENT_ID');
    }
    function scopefindTransaction($query,$id){
    	return $query->where('RENT_TRANSACTION_ID','=',$id);
    }
}