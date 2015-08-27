<?php namespace Modules\Travelpage\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Travel\Entities\Travelschedule;
use Modules\Vehicle\Entities\Vehicle;
use Modules\Vehicle\Entities\City;
use Input;
use Session;
use Modules\Registrasi\Entities\Costumer;
use DB;
use Modules\Travel\Entities\Traveltransaction;
use Redirect;
class TravelpageController extends Controller {
	
	public function index()
	{
		$city=City::all();
		return view('travelpage::travel-search',compact('city'));
	}
	function scheduleSearch()
	{
		$city=City::all();
		$data=Input::all();
		//print_r($data);
		$schedule=Travelschedule::travelSchedule($data['depart'],$data['dest'],$data['TRAVEL_SCHEDULE_DATE'])->get();
		//print_r($schedule);
		return view('travelpage::hasil-search', compact('schedule','city'));
	}
	function transaksi($id_schedule)
	{
		$passenger_count=Traveltransaction::where('TRAVEL_SCHEDULE_ID','=',$id_schedule)->sum('TRAVEL_TRANSACTION_PASSENGER');
		$harga=Travelschedule::where('TRAVEL_SCHEDULE_ID','=',$id_schedule)->first()['TRAVEL_SCHEDULE_PRICE'];
		$capacity_total=Vehicle::getCapacity($id_schedule)->first()['VEHICLE_CAPACITY'];
		$sisa=$capacity_total-$passenger_count;
		return view('travelpage::transaksi',compact('id_schedule','sisa','harga'));
	}
	function transaksiSubmit()
	{
		$data=Input::all();
		$schedule=Travelschedule::findschedule($data['TRAVEL_SCHEDULE_ID'])->first();
		unset($data['_token']);
		$schedule_id=$data['TRAVEL_SCHEDULE_ID'];
		$costumer=$data;
		unset($data['_token']);
		unset($data['COSTUMER_EMAIL'],$data['COSTUMER_NAME'], $data['COSTUMER_TELP']);
		
		if(!is_null(Session::get('id')) and Session::get('hak')=='COSTUMER')
		{
			$data['MEMBER_ID']=Session::get('id');
		}
		else{
			unset($costumer['TRAVEL_SCHEDULE_ID'],$costumer['TRAVEL_TRANSACTION_PASSENGER'],$costumer['TRAVEL_TRANSACTION_PRICE']);
			Costumer::insert($costumer);
			$id= DB::getPdo()->lastInsertId();
			$data['COSTUMER_ID']=$id;
		}
		$data['TRAVEL_TRANSACTION_STATUS_ID']=1;
		Traveltransaction::insert($data);
		$idtransaksi=DB::getPdo()->lastInsertId();
		$code=DB::select('select travel_code() as code');
		$code=$code[0]->code;
		$code_transaksi=['TRAVEL_TRANSACTION_CODE'=> $code];
		$transaksi=Traveltransaction::where('TRAVEL_TRANSACTION_ID','=',$idtransaksi);
		$transaksi->update($code_transaksi);
		return redirect::to('/');
	}
	
}