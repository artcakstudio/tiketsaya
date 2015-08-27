<?php namespace Modules\Registrasi\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Vehicle\Entities\City;
use Modules\Vehicle\Entities\Partner;
use Modules\Vehicle\Entities\PartnerType;
use Modules\Registrasi\Entities\Member;
use Input;
use Redirect;
class RegistrasiController extends Controller {
	
	public function index()
	{
		$partner_type=PartnerType::all();
		return view('registrasi::partner_registrasi',compact('city','partner_type'));
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
		print_r($data);
		$partner=Partner::check_login($data['PARTNER_USERNAME'],md5($data['PARTNER_PASSWORD']))->get();
		print_r($partner);
		if(sizeof($partner)>0) echo "sukses";
		else{
			$member=['MEMBER_USERNAME'=>$data['PARTNER_USERNAME'], 'MEMBER_PASSWORD'=>md5($data['PARTNER_PASSWORD'])];
			$member=Member::check_login($member)->get();
			if (sizeof($member)>0) echo "member";
			else echo "login gagal";
		}
	}
}