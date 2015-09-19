<?php namespace Modules\Rentpartner\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Vehicle\Entities\Partner;
use Session;
use Input;
use Redirect;

class RentpartnerController extends Controller {
	
public function index()
	{
		$id=Session::get('id');
		$partner=Partner::where('PARTNER_ID','=',$id)->first();

		return view('rentpartner::index',compact('partner'));
	}
	 function update()
	 {
	 	$data=Input::all();
	 	$partner=Partner::where('PARTNER_ID','=',$data['PARTNER_ID']);
	 	print_r($data);
	 	unset($data['_token']);
	 	if (isset($data['PARTNER_PHOTO'])){
	 		$data['PARTNER_PHOTO']=md5(time()).'.png';;
		 	$destPath=public_path().'\Assets\PartnerPhoto';
		 	Input::file('PARTNER_PHOTO')->move($destPath,$data['PARTNER_PHOTO']);
		 	@unlink(public_path().'\Assets\partnerPhoto/'.$partner->first()['PARTNER_PHOTO']);
	 	}
	 	else{
	 		unset($data['PARTNER_PHOTO']);
	 	}

	 	$partner->update($data);
	 	return redirect::back();
	 }
	 function updatepassword()
	 {
	 	$data=Input::all();
	 		
	 	$partnerObject=Partner::where('PARTNER_ID','=',$data['PARTNER_ID']);
	 	$partner=$partnerObject->first();
	 	
	 	if ($partner['PARTNER_PASSWORD']==md5($data['old_password'])) {
		 	if ($data['new_password']==$data['confirm_password']){;
			 	$password=[];
			 	$new_password=md5($data['confirm_password']);

		 		$password=['PARTNER_PASSWORD'=>$new_password];
		 		$partnerObject->update($password);
		 		Session::flash('message', "Perubahan Password Berhasil");
		 		return redirect::back();
		 	}
		 	else{
		 		Session::flash('message', "Password Yang Anda Masukkan Tidak sama, mohon ulang kembali");
		 		return redirect::back();
		 	}
	 	}
	 	else{
	 		Session::flash('message', "Password Yang Anda Masukkan Salah");
	 		return redirect::back();
	 	}
	 }
	 function logout()
	 {
	 	Session::flush();
	 	return redirect::to('/');
	 }
}