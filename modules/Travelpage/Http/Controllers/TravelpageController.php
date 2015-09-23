<?php namespace Modules\Travelpage\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Travel\Entities\Travelschedule;
use Modules\Vehicle\Entities\Vehicle;
use Modules\Vehicle\Entities\City;
use Modules\Travel\Entities\LinkTravel;
use Input;
use Session;
use Modules\Registrasi\Entities\Costumer;
use DB;
use Modules\Travel\Entities\TravelTransaction;
use Redirect;
class TravelpageController extends Controller {
	
	public function index()
	{
		$city=City::all();
		$link_travel=LinkTravel::all();
		return view('travelpage::travel-search',compact('city','link_travel'));
	}
	function scheduleSearch()
	{
		$city=City::all();
		$data=Input::all();
		//print_r($data);
		Session::flash('search',['depart'=>$data['depart'],'date'=>$data['TRAVEL_SCHEDULE_DATE'], 'dest'=>$data['dest'],'type'=>'travel']);
		$schedule=Travelschedule::travelSchedule($data['depart'],$data['dest'],$data['TRAVEL_SCHEDULE_DATE'])->get();
		//print_r($schedule);
		return view('travelpage::hasil-search', compact('schedule','city'));
	}
	function transaksi_step1()
	{
		$id_schedule=Input::get('TRAVEL_SCHEDULE_ID');
		$passenger_count=Traveltransaction::where('TRAVEL_SCHEDULE_ID','=',$id_schedule)->sum('TRAVEL_TRANSACTION_PASSENGER');

		$schedule=Travelschedule::getSchedule()->where('TRAVEL_SCHEDULE.TRAVEL_SCHEDULE_ID','=',$id_schedule);
		$jadwal=$schedule->first();
		session(['DATA_TRAVEL'=>['ROUTE_DEPARTURE'=>$jadwal['ROUTE_DEPARTURE'],'ROUTE_DEST'=>$jadwal['ROUTE_DEST'],'TRAVEL_SCHEDULE_ARRIVETIME'=>$jadwal['TRAVEL_SCHEDULE_ARRIVETIME'], 'TRAVEL_SCHEDULE_DEPARTTIME'=>$jadwal['TRAVEL_SCHEDULE_DEPARTTIME'] ,'TRAVEL_SCHEDULE_PRICE'=>$jadwal['TRAVEL_SCHEDULE_PRICE'],'VEHICLE_NAME'=>$jadwal['VEHICLE_NAME'],'VEHICLE_PHOTO'=>$jadwal['VEHICLE_PHOTO'], 'PARTNER_NAME'=>$jadwal['PARTNER_NAME'], 'PARTNER_PHOTO'=>$jadwal['PARTNER_PHOTO'] ] ]);
		$sisa=$jadwal['VEHICLE_CAPACITY']-$passenger_count;
	
		return view('travelpage::transaksi',compact('id_schedule','sisa','harga'));
	}
	function transaksiSubmit()
	{
		$data=Input::all();
		$flag=$data['flag'];
		print_r($data);
		$schedule=Travelschedule::findschedule($data['TRAVEL_SCHEDULE_ID'])->first();
		unset($data['_token']);
		$schedule_id=$data['TRAVEL_SCHEDULE_ID'];
		unset($data['_token'], $data['flag']);
		$costumer=$data;
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
		if ($flag==1){
			return redirect::back();
		}
		else return redirect::to('/');
	}
	function preview()
	{
		$data=Input::all();
//		$no_pemesanan=DB::select('select travel_code() as code_pesan')[0]->code_pesan;
		
		//if(!Session::has('NO_PEMESANAN')) {
			$no_pemesanan = 'T' . strtoupper(bin2hex(openssl_random_pseudo_bytes(3)));
			session(['DATA_COSTUMER' => $data, 'NO_PEMESANAN' => $no_pemesanan]);
		//}
		return view('travelpage::preview');
	}
	function scheduleSearchRentang(){
		$data=Input::all();
		$city=City::all();
		$data=Input::all();
		$tanggal=$data['TRAVEL_SCHEDULE_DATE'];
		$start =date('Y-m-d', strtotime(' -7 day',strtotime($tanggal)));
		$finish =date('Y-m-d', strtotime(' +7 day',strtotime($tanggal)));
		
		$schedule=Travelschedule::travelScheduleRentang($data['depart'],$data['dest'],$start,$finish)->get();
		
		return view('travelpage::hasil-search', compact('schedule','city'));
	}
}
