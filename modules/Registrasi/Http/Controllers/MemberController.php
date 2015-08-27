<?php namespace Modules\Registrasi\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Input;
use Modules\Registrasi\Entities\Member;
use Redirect;	
class memberController extends Controller {
	
	public function index()
	{
		return view('registrasi::member_registrasi');
	}
	function store()
	{
		$data=Input::all();
		$data['MEMBER_PASSWORD']=md5($data['MEMBER_PASSWORD']);
		unset($data['_token']);
		Member::insert($data);
		return Redirect::to('/');
	}
	
}