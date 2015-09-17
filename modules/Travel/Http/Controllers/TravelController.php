<?php namespace Modules\Travel\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\travel\Entities\Route;
use Modules\travel\Entities\Travelschedule;
use Modules\vehicle\Entities\Vehicle;
use Input;
use Session;
use Datatables;
use Redirect;
class TravelController extends Controller {
	
	public function index()
	{
		$route=Route::getAllRoute()->get();
		$vehicle=Vehicle::all();
		return view('travel::travel.index',compact('route','vehicle'));
	}
	public function store()
	{
		$data=Input::all();
		
		$data['TRAVEL_SCHEDULE_DEPARTTIME']= date('Y-m-d H:i', strtotime($data['date']." ".$data['depart_hour'].":".$data['depart_minute']));

		$plus=$data['hour_estimate']*60+$data['minute_estimate'];
		$hour_arrive=date('H:i', strtotime('+'.$plus.' minutes', strtotime($data['TRAVEL_SCHEDULE_DEPARTTIME'])));
		$data['TRAVEL_SCHEDULE_ARRIVETIME'] =date('Y-m-d H:i', strtotime($hour_arrive));
		
		unset($data['_token']);
		unset($data['date']);
		unset($data['depart_hour'],$data['depart_minute'], $data['hour_estimate'], $data['minute_estimate']);
		
		$data['TRAVEL_SCHEDULE_CREATEBY']=Session::get('id');

		travelschedule::insert($data);
		return redirect::back();
	}
	function show($tanggal)
	{
		$route=Route::getAllRoute()->get();
		$vehicle=Vehicle::all();
		return view('travel::travel.listschedule',compact('tanggal','route','vehicle'));
	}
	function getScheduleDay($tanggal){
		$schedule =travelschedule::getScheduleDay($tanggal)->get();
        return Datatables::of($schedule)
         ->addColumn('action', function ($schedule) {
         		return '<li  class="dropdown dropdown-no-type"><a data-toggle="dropdown" class="dropdown-toggle btn btn-xs btn-primary" href="#" > Pilihan <b class="caret"></b></a><ul class="dropdown-menu"><li><button class="btn btn-primary edit" id="'.$schedule->TRAVEL_SCHEDULE_ID.'">Edit</button></li><li><button class="btn btn-danger" id="'.$schedule->TRAVEL_SCHEDULE_ID.'" data-target="#hapusUser">Hapus</button></li></ul></li>';
            })
            ->make(true);
	}

	function update()
	{
		$data=Input::all();
		
		$data['TRAVEL_SCHEDULE_DEPARTTIME']= date('Y-m-d H:i', strtotime($data['date']." ".$data['depart_hour'].":".$data['depart_minute']));

		$plus=$data['hour_estimate']*60+$data['minute_estimate'];
		$hour_arrive=date('H:i', strtotime('+'.$plus.' minutes', strtotime($data['TRAVEL_SCHEDULE_DEPARTTIME'])));
		$data['TRAVEL_SCHEDULE_ARRIVETIME'] =date('Y-m-d H:i', strtotime($hour_arrive));
		
		unset($data['_token']);
		unset($data['date']);
		unset($data['depart_hour'],$data['depart_minute'], $data['hour_estimate'], $data['minute_estimate']);
		
		$data['TRAVEL_SCHEDULE_CREATEBY']=Session::get('id');

		$travel=travelschedule::findSchedule($data['TRAVEL_SCHEDULE_ID']);
		
		$travel->update($data);
		return redirect::back()->with('tanggal');
	}
	function destroy()
	{
		$id=Input::get('TRAVEL_SCHEDULE_ID');
		$travel=travelschedule::findSchedule($id);

	
		$travel->delete();
		return redirect::back()->with('tanggal');
	}
}