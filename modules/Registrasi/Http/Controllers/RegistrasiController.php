<?php namespace Modules\Registrasi\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Vehicle\Entities\City;
use Modules\Vehicle\Entities\Partner;
use Modules\Vehicle\Entities\PartnerType;
use Modules\Registrasi\Entities\Member;
use Input;
use Redirect;
use Session;
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
		$partner_type=PartnerType::all();
		return view('registrasi::partner_login',compact('partner_type'));
	}
	function checkLogin()
	{
		$data=Input::all();
		
		$partner=Partner::check_login($data['PARTNER_USERNAME'],md5($data['PARTNER_PASSWORD']))
							->where('PARTNER_TYPE_ID','=',$data['PARTNER_TYPE_ID'])->first();
							print_r($partner);
		if(sizeof($partner)>0) {
			print_r($partner);
			if ($partner['PARTNER_TYPE_ID']==1){
				Session(['id'=>$partner['PARTNER_ID'], 'hak'=>'partner_travel']);
				return redirect::to('travelpartner');
			}
			else if($partner['PARTNER_TYPE_ID']==2){
				Session(['id'=>$partner['PARTNER_ID'], 'hak'=>'partner_rent']);
				return redirect::to('rentpartner');	
			}
			else{
				Session(['id'=>$partner['PARTNER_ID'], 'hak'=>'partner_ticket']);
				return redirect::to('ticketpartner');
			}
		}
		else{
			$member=['MEMBER_USERNAME'=>$data['PARTNER_USERNAME'], 'MEMBER_PASSWORD'=>md5($data['PARTNER_PASSWORD'])];
			$member=Member::check_login($member)->get();
			if (sizeof($member)>0) echo "member";
			else{
				Session::flash('message','Password yang anda masukkan salah');
				return redirect::back();
			};
		}
	}
	function checkusername()
	{
		$data=Input::all();
		$partner=Partner::where('PARTNER_USERNAME','=',$data['PARTNER_USERNAME'])
							->where('PARTNER_TYPE_ID','=',$data['PARTNER_TYPE_ID'])->get();
		return json_encode($partner);
	}
}