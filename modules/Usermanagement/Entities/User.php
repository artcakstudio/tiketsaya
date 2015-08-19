<?php namespace Modules\Usermanagement\Entities;
   
use Illuminate\Database\Eloquent\Model;

class user extends Model {

	protected $table='users';
	public $timestamps=false;    

	function scopechecklogin($query, $data)
	{
		return $query->where('users_username','=',$data['username'])
					->where('users_password','=',$data['password']);
	}
	function scopegetHakAkses($query,$id){
		return $query->select("roles_name",'roles.roles_id')
					->where('users.users_id','=',$id)
					->join('penggunaxroles','users.users_id','=','penggunaxroles.users_id')
					->join('roles','penggunaxroles.roles_id','=','roles.roles_id');
	}
	public function scopegetUser($query, $id)
	{
		$query->where('USERS_ID','=',$id);
	}

}