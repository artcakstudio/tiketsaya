<?php namespace Modules\Usermanagement\Entities;
   
use Illuminate\Database\Eloquent\Model;

class hakakses extends Model {

    protected $fillable = [];
    protected $table='hak_akses';
    public function scopehapusHakAkses($query,$data)
    {
    	$query->where('SUB_MODULES_ID','=',$data['SUB_MODULES_ID'])
    		->where('MODULES_ID','=',$data['MODULES_ID']);
    }
}