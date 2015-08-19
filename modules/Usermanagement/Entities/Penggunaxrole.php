<?php namespace Modules\Usermanagement\Entities;
   
use Illuminate\Database\Eloquent\Model;

class penggunaxrole extends Model {

    protected $fillable = [];
    function scopehapusRoleUser($query, $id_user, $id_role){
    	$query->where('ROLES_ID','=',$id_role)
    		->where('USERS_ID','=',$id_user);
    }
    
}