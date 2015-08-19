<?php namespace Modules\Auth\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Input;
use Modules\Usermanagement\Entities\user;
use View;
use Redirect;
use Session;
class AuthController extends Controller {
	
	public function index()
	{
		return view('auth::index');
	}
	
	public function login()
	{
		$data=Input::all();
		$data['password']=md5($data['password']);
		

		$user=User::checklogin($data)->get();
			
		if (sizeof($user)>0){
			$rule=User::getHakAkses($user[0]['USERS_ID'])->get();

			session(['hak'=>$rule, 'name'=>$user[0]['USERS_NAME'], 'id'=>$user[0]['USERS_ID']]); 
	
		return redirect::to('usermanagement');
		}
		else{
			Session::flash('error', "Password dan Username yang anda masukkan salah");

			return redirect::back();
		}
	}
}