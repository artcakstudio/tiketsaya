<?php namespace Modules\Linkfooter\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\linkFooter\Entities\LinkTravel;
use Modules\linkFooter\Entities\LinkRent;
use Modules\Vehicle\Entities\City;
use Datatables;
use Input;
use Session;
use Redirect;
class LinkFooterController extends Controller {
	
	public function index()
	{
		return view('linkfooter::index');
	}
	public function rentSearch(){
		$city=City::all();
		return view('linkfooter::rentSearch', compact('city'));
	}
	function dataRentSearch()
	{
		$schedules =LinkRent::RentSearch()->get();
        return Datatables::of($schedules)
         ->addColumn('action', function ($schedule) {
               return '<button class="btn  btn-xs btn-primary" id="'.$schedule->LINK_RENT_ID.'"><i class="fa fa-pencil"></i> </button></a><button class="btn  btn-xs btn-danger" id="'.$schedule->LINK_RENT_ID.'" data-target="#hapusUser""><i class="fa fa-times"></i> </button>';
            })
            ->make(true);
	}
	function rentStore(){
		$data=Input::all();
		unset($data['_token']);
		$data['LINK_RENT_CREATEBY']=Session::get('id');
		LinkRent::insert($data);
		return Redirect::back();
	}
	function rentDestroy()
	{
		$id=Input::get('LINK_RENT_ID');
		$link=LinkRent::where('LINK_RENT_ID','=',$id);
		$link->delete();
		return Redirect::back();
	}

	function travelSearch(){
		$city=City::all();
		return view('linkfooter::travelSearch',compact('city'));
	}
	function dataTravelSearch()
	{
		$schedules =LinkTravel::TravelSearch()->get();
        return Datatables::of($schedules)
         ->addColumn('action', function ($schedule) {
               return '<button class="btn  btn-xs btn-primary" id="'.$schedule->LINK_TRAVEL_ID.'"><i class="fa fa-pencil"></i> </button></a><button class="btn  btn-xs btn-danger" id="'.$schedule->LINK_TRAVEL_ID.'" data-target="#hapusUser""><i class="fa fa-times"></i> </button>';
            })
            ->make(true);
	}
	function travelStore(){
		$data=Input::all();
		unset($data['_token']);
		$data['LINK_TRAVEL_CREATEBY']=Session::get('id');
		LinkTravel::insert($data);
		return Redirect::back();
	}
	function travelDestroy()
	{
		$id=Input::get('LINK_TRAVEL_ID');
		$link=LinkTravel::where('LINK_TRAVEL_ID','=',$id);
		$link->delete();
		return Redirect::back();
	}
}