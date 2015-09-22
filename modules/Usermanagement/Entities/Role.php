<?php namespace Modules\Usermanagement\Entities;
   
use Illuminate\Database\Eloquent\Model;

class role extends Model {

    protected $fillable = [];
    function scopepenggunaxroles($query,$id){
    	$query->whereNotIn('ROLES_ID', function ($query) use ($id)
        {
            $query->select('ROLES_ID')
                ->from('penggunaxroles')
                ->where('USERS_ID', '=', $id);
        });
    }
    function scopeuserRole($query,$id){
    	$query->select ('ROLES.*')
    	->join('penggunaxroles','penggunaxroles.ROLES_ID','=','ROLES.ROLES_ID')
    	->where('penggunaxroles.USERS_ID','=',$id);

    }
}