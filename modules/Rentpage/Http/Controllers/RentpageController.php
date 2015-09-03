<?php namespace Modules\Rentpage\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Rent\Entities\Rentschedule;
use Modules\Vehicle\Entities\City;
use Modules\Rent\Entities\Renttransaction;
use Modules\Rent\Entities\Renttransactiondetail;
use Modules\Registrasi\Entities\Costumer;
use DB;
use Input;
use Session;
use Redirect;
class RentpageController extends Controller {
	
	public function index()
	{
		$city=City::all();
		return view('rentpage::index','city');
	}
	public function scheduleSearch()
	{
		$data=Input::all();	
		
		$finish=date('y-m-d',strtotime('+'.$data['DURATION'], strtotime($data['DATE'])));
		$vehicle=Rentschedule::rentSchedule($data['CITY_ID'],$data['DATE'],$finish)->get();
		$city=City::all();
		$duration=$data['DURATION'];
		session(['duration'=>$duration]);
		return view('rentpage::hasil-search', compact('vehicle','city','duration'));
	}
	function transaksipage($id_schedule)
	{
		$schedule=Rentschedule::findRentschedule($id_schedule);
		$jadwal=$schedule->first();
		session(['DATA_RENT'=>$jadwal]);
		return view('rentpage::transaksi',compact('id_schedule'));
	}
	function transaksiSubmit()
	{
		$data=Input::all();
		$schedule=Rentschedule::findRentschedule($data['RENT_SCHEDULE_ID'])->first();
		unset($data['_token']);
		$schedule_id=$data['RENT_SCHEDULE_ID'];
		unset($data['RENT_SCHEDULE_ID']);
		$costumer=$data;

		$data['RENT_TRANSACTION_PRICE']=$schedule['RENT_SCHEDULE_PRICE'];
		unset($data['_token']);
		$data['RENT_TRANSACTION_DATE']=date('y-m-d');
		$data['RENT_TRANSACTION_CREATEBY']=session::get('id');
		unset($data['COSTUMER_EMAIL'],$data['COSTUMER_NAME'], $data['COSTUMER_TELP']);
		$data['RENT_TRANSACTION_PRICE']=session::get('duration');
		
		if(!is_null(session::get('id')) and session::get('hak')=='COSTUMER')
		{
			$data['MEMBER_ID']=session::get('id');
		}
		else{
			Costumer::insert($costumer);
			$id= DB::getPdo()->lastInsertId();
			$data['COSTUMER_ID']=$id;
		}
		Renttransaction::insert($data);
		$detail_transaksi=['RENT_TRANSACTION_ID'=>DB::getPdo()->lastInsertId(),'RENT_SCHEDULE_ID'=>$schedule_id];
		Renttransactiondetail::insert($detail_transaksi);
		return redirect::to('/');
	}
	function preview()
	{
		$data=Input::all();
		$no_pemesanan=DB::select('select rent_code() as code_pesan')[0]->code_pesan;
		
		session(['DATA_COSTUMER'=>$data,'NO_PEMESANAN'=>$no_pemesanan]);
		return view('rentpage::preview');
	}
}