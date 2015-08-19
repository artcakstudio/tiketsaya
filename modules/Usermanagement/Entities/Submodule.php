<?php namespace Modules\Usermanagement\Entities;
   
use Illuminate\Database\Eloquent\Model;

class submodule extends Model {

    protected $fillable = [];
    protected $table='sub_modules';

    public function scopegetModuleNotIn($query, $id)
    {
    	$query->whereNotIn('SUB_MODULES_ID', function($query) use ($id){
    		$query->select('SUB_MODULES_ID')
    			->from('HAK_AKSES')
    			->where('MODULES.MODULES_ID','=',$id)
    			->join('MODULES', 'MODULES.MODULES_ID','=','HAK_AKSES.MODULES_ID');
    	});
    }
    public function scopegetModuleIn($query, $id)
    {
    	$query->select(['SUB_MODULES.SUB_MODULES_ID','SUB_MODULES.SUB_MODULES_NAME','MODULES.MODULES_NAME'])
    			->join('HAK_AKSES', 'HAK_AKSES.SUB_MODULES_ID','=','SUB_MODULES.SUB_MODULES_ID')
    			->join('MODULES', 'MODULES.MODULES_ID','=','HAK_AKSES.MODULES_ID')
    			->whereIn('SUB_MODULES.SUB_MODULES_ID', function($query) use ($id){
    			$query->select('SUB_MODULES_ID')
    			->from('HAK_AKSES')
    			->where('MODULES.MODULES_ID','=',$id)
    			->orderBy('MODULES.MODULES_NAME');;
    	});
    }
    public function scopegetModule($query, $roleId){
    	$query->select(['MODULES.MODULES_NAME','SUB_MODULES.SUB_MODULES_ID','SUB_MODULES.SUB_MODULES_NAME','MODULES.MODULES_ID'])
    		->join('HAK_AKSES', 'HAK_AKSES.SUB_MODULES_ID','=','SUB_MODULES.SUB_MODULES_ID')
    		->join('MODULES','MODULES.MODULES_ID','=','HAK_AKSES.MODULES_ID')	
    		->where('HAK_AKSES.ROLES_ID','=',$roleId);
    }

}
