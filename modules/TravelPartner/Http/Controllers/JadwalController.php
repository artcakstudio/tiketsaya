<?php namespace Modules\Travelpartner\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Session;
use Modules\Travel\Entities\Travelschedule;
use Modules\Vehicle\Entities\City;
use Modules\Vehicle\Entities\Vehicle;
use Modules\vehicle\Entities\VehicleType;
use Modules\Travel\Entities\Route;
use Datatables;
use Input;

class JadwalController extends Controller {
private $route;
private $vehicle;
public $partner_id;
	function __construct(){
		$this->partner_id=Session::get('id');
		$this->route=Route::getRoutePartner($this->partner_id)->get();
		$this->jadwal=Travelschedule::partnerSchedule($this->partner_id)->get();
		$this->vehicle=Vehicle::where('PARTNER_ID','=', $this->partner_id)->get();
	}
	public function index()
	{
		return view('travelpartner::index');
	}
	function jadwal($date)
	{
		$jadwal=$this->jadwal;
		$route=$this->route;
		$vehicle=$this->vehicle;
	//	print_r($jadwal);
		return view('travelpartner::jadwal.index',compact('jadwal','route','vehicle','date'));
	}
	function addJadwal()
	{
		$data=Input::all();
		$tanggal=$data['tanggal'];
		unset($data['tanggal'],$data['_token']);
		$data['TRAVEL_SCHEDULE_CREATEBY']=Session::get('id');
		$hour_depart=$data['hour_depart']; $minute_depart=$data['minute_depart'];
		$hour_arrive=$data['hour_arrive']; $minute_arrive=$data['minute_arrive'];
		unset($data['hour_depart'],$data['minute_arrive'],$data['hour_arrive'],$data['minute_depart']);
		foreach ($tanggal as $row) {
			$data['TRAVEL_SCHEDULE_DEPARTTIME']=date('Y-m-d h:i', strtotime($row." ".$hour_depart.":".$minute_depart));
			$data['TRAVEL_SCHEDULE_ARRIVETIME']=date('Y-m-d h:i', strtotime($row." ".$hour_arrive.":".$minute_arrive));
			Travelschedule::insert($data);
		}
	}
	function jadwalharian($tanggal){		
		$schedule =travelschedule::getScheduleDayPartner($tanggal,$this->partner_id)->get();
        return Datatables::of($schedule)
         ->addColumn('action', function ($schedule) {
         		//return '<li  class="dropdown dropdown-no-type"><a data-toggle="dropdown" class="dropdown-toggle btn btn-xs btn-primary" href="#" > Pilihan <b class="caret"></b></a><ul class="dropdown-menu"><li><button class="btn btn-primary edit" id="'.$schedule->TRAVEL_SCHEDULE_ID.'">Edit</button></li><li><button class="btn btn-danger" id="'.$schedule->TRAVEL_SCHEDULE_ID.'" data-target="#hapusUser">Hapus</button></li></ul></li>';
         		return '<button class="btn  btn-xs btn-primary" id="'.$schedule->TRAVEL_SCHEDULE_ID.'"><i class="fa fa-pencil"></i> </button></a><button class="btn  btn-xs btn-danger" id="'.$schedule->TRAVEL_SCHEDULE_ID.'" data-target="#hapusUser""><i class="fa fa-times"></i> </button>';
            })
            ->make(true);
	}
	function jadwal_harian($tanggal)
	{
		$route=$this->route;
		$vehicle=$this->vehicle;
		return view('travelpartner::jadwal.jadwal_harian',compact('tanggal','route','vehicle'));
	}
	function mingguan()
	{
		return view('travelpartner::jadwal.mingguan');
	}
	function addJadwalMingguan()
	{
		$data=Input::all();
		$start=$data['start'];
		$stop=$data['stop'];
		$tanggal=$data['tanggal'];
		unset($data['tanggal'],$data['_token']);
		$data['TRAVEL_SCHEDULE_CREATEBY']=Session::get('id');
		$hour_depart=date('h:i', strtotime($data['hour_depart'].':'.$data['minute_depart']));
		$plus=$data['hour_estimate']*60+$data['minute_estimate'];
		$hour_arrive=date('h:i', strtotime('+'.$plus.' minutes', strtotime($hour_depart)));
		unset($data['hour_depart'],$data['minute_estimate'],$data['hour_estimate'],$data['minute_depart'],$data['start'],$data['stop']);

		while($start <=$stop) {

			$index=date('N',strtotime($start))-1;
			if (in_array($index, $tanggal))
			{
				$data['TRAVEL_SCHEDULE_DEPARTTIME']=date('Y-m-d h:i', strtotime($start." ".$hour_depart));
				$data['TRAVEL_SCHEDULE_ARRIVETIME']=date('Y-m-d h:i', strtotime($start." ".$hour_arrive));
				Travelschedule::insert($data);
			}
			$start=date('Y-m-d',strtotime('+1 day',strtotime($start)));
		}
	}
	
}