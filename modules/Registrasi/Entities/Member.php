<?php namespace Modules\Registrasi\Entities;
   
use Illuminate\Database\Eloquent\Model;

class member extends Model {
	protected $table='MEMBER';
    protected $fillable = [];

    public function scopecheck_login($query,$data)
    {
    	return $query->where('MEMBER_USERNAME','=',$data['MEMBER_USERNAME'])
    				->where('MEMBER_PASSWORD','=',$data['MEMBER_PASSWORD']);
    }

}