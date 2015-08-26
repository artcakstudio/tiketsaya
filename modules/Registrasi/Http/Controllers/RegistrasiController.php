<?php namespace Modules\Registrasi\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Vehicle\Entities\City;
use Modules\Vehicle\Entities\Partner;
use Input;
use Redirect;
class RegistrasiController extends Controller {
	
	public function index()
	{
		$city=[];
		return view('registrasi::partner_registrasi',compact('city'));
	}
	public function store()
	{
		$data=Input::all();
		unset($data['_token']);
		$data['PARTNER_CREATEBY']='0';
		$data['PARTNER_PASSWORD']=md5($data['PARTNER_PASSWORD']);
		Partner::insert($data);
		print_r($data);
		return redirect::to('registrasi/login')->with('message','pendaftaran berhasil');

	}
	function login()
	{
		return view('registrasi::partner_login');
	}
	function checkLogin()
	{
		$data=Input::all();
		$partner=Partner::check_login($data['PARTNER_USERNAME'],md5($data['PARTNER_PASSWORD']))->get();
		if(sizeof($partner)>0) echo "sukses";
		else echo "fail";
	}
}