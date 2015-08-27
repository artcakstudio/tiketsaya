<?php namespace Modules\Rent\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\rent\Entities\RentSchedule;
use Modules\vehicle\Entities\Vehicle;
use Input;
use Session;
use Datatables;
class RentController extends Controller {
	
	public function index()
	{
		$vehicle=Vehicle::all();
		return view('rent::rent_schedule.index',compact('vehicle'));
	}
	public function store()
	{
		$data=Input::all();
		unset($data['_token']);
		$data['RENT_SCHEDULE_CREATEBY']=session::get('id');
		$data['RENT_SCHEDULE_DATE']=date('Y-m-d',strtotime($data['RENT_SCHEDULE_DATE']));
		print_r($data);
		rentschedule::insert($data);
		return back();
	}
	function show($tanggal)
	{
		$vehicle=vehicle::all();
		return view('rent::rent_schedule.listschedule',compact('tanggal','vehicle'));
	}
	function getScheduleDay($tanggal){
		$schedule =rentschedule::getScheduleDay($tanggal)->get();
		$path=url('public/Assets/vehiclePhoto/');
        return Datatables::of($schedule)
         ->addColumn('action', function ($schedule) {
         		return '<li class="dropdown dropdown-no-type"><a data-toggle="dropdown" class="dropdown-toggle btn btn-xs btn-primary" href="#" > Pilihan <b class="caret"></b></a><ul class="dropdown-menu"><li><button class="btn btn-danger" id="'.$schedule->RENT_SCHEDULE_ID.'" data-target="#hapusUser">Hapus</button></li><li><button class="btn btn-primary edit" id="'.$schedule->RENT_SCHEDULE_ID.'" data-target="#editSchedule">Edit</button></li></ul></li>';
            })
         ->addColumn('picture', function ($vehicle) use ($path) {
         		return "<img src=".$path."/".$vehicle['VEHICLE_PHOTO']." style='width:50px; height:50px'>";
         	
            })	
            ->make(true);
	}
	function destroy()
	{
		$data=Input::all();
		$rent_schedule=rentschedule::findRentSchedule($data['RENT_SCHEDULE_ID']);
		print_r($data);
		$rent_schedule->delete();
		return back();
	}
	function update()
	{
		$data=Input::all();
		unset($data['_token']);
		$schedule=RentSchedule::where('RENT_SCHEDULE_ID','=',$data['RENT_SCHEDULE_ID']);
		$schedule->update($data);
		return back();
	}
}