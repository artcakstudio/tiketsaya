<?php namespace Modules\Vehicle\Http\Controllers;
use Pingpong\Modules\Routing\Controller;
use Modules\Vehicle\Entities\Partner;
use Datatables;
use Input;
use Session;
use Redirect;
class PartnerController extends Controller {
	
	public function index()
	{
		return view('vehicle::partner.index');
	}
	function getAllPartner()
	{
		$path=public_path().'\Assets\partnerPhoto';
		$url=url('public/Assets\partnerPhoto/');
		$partner =Partner::all();
        return Datatables::of($partner)
         ->addColumn('action', function ($partner) {
         		return '<li style="decoration:none" class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle btn btn-xs btn-primary" href="#" > Pilihan <b class="caret"></b></a><ul class="dropdown-menu"><li><a href="partner/edit/'.$partner->PARTNER_ID.'" class="btn  btn-primary">Edit</a></li><li><button class="btn btn-danger" id="'.$partner->PARTNER_ID.'" data-target="#hapusUser">Hapus</button></li></ul></li>';
            })
         ->addColumn('photo', function ($partner) use($url) {
         		return '<img src="'.$url.'/'.$partner['PARTNER_PHOTO'].'" style="width:50px; height:50px">';
         	
            })
 
            ->make(true);
	}
	function store()
	{
		$destPath=public_path().'\Assets\PartnerPhoto';
		$data=Input::all();
		unset($data['_token']);
		
		$data['PARTNER_PHOTO']=md5(time()).'.png';;
		Input::file('PARTNER_PHOTO')->move($destPath,$data['PARTNER_PHOTO']);
		
		$data['PARTNER_CREATEBY']=session::get('id');
		$data['PARTNER_PASSWORD']='123';
		Partner::insert($data);
		return back();
	}
	function edit($id)
	{
		$partner=Partner::findPartner($id)->first();
		
		return view('vehicle::partner.edit',compact('id','partner'));
	}
	function update()
	{
		$data=Input::all();
		$id=$data['PARTNER_ID'];
		unset($data['_token']);
		unset($data['PARTNER_ID']);

		$partner=Partner::where('PARTNER_ID','=',$id);
		if(!isset($data['PARTNER_PHOTO'])) unset($data['PARTNER_PHOTO']);
		else{
			$foto=$partner->first()['PARTNER_PHOTO'];
			@unlink(public_path().'\Assets\partnerPhoto/'.$foto);
			$destPath=public_path().'\Assets\partnerPhoto';
			$data['PARTNER_PHOTO']=md5(time()).'.png';
			Input::file('PARTNER_PHOTO')->move($destPath,$data['PARTNER_PHOTO']);
		}
		if(!isset($data['PARTNER_PASSWORD'])) unset($data['PARTNER_PASSWORD']);
		$data['PARTNER_UPDATEBY']=session::get('id');
		$partner->update($data);
		return redirect::to('vehicle/partner');
	}
	function destroy()
	{
		$data=Input::all();
		$partner=Partner::findPartner($data['PARTNER_ID']);
		$partner->delete();
		return back();
	}
}