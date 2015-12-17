<?php namespace Modules\Usermanagement\Entities;
   
use Illuminate\Database\Eloquent\Model;
use DB;

class module extends Model {

    protected $fillable = [];
    public function scopegetAllModule($query)
    {
    	$data=DB::select('SELECT s.SUB_MODULES_NAME, m.MODULES_NAME,s.SUB_MODULES_ID, m.MODULES_ID FROM SUB_MODULES AS s,MODULES AS m WHERE s.SUB_MODULES_ID NOT IN (SELECT h.SUB_MODULES_ID FROM HAK_AKSES AS h WHERE h.MODULES_ID = m.MODULES_ID) ORDER BY m.MODULES_NAME');
    	return $data;
    }

}