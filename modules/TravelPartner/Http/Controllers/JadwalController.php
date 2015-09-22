<?php namespace Modules\Travelpartner\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Session;
use Modules\Travel\Entities\Travelschedule;
use Modules\Vehicle\Entities\City;
use Modules\Vehicle\Entities\Vehicle;
use Modules\Vehicle\Entities\VehicleType;
use Modules\Travel\Entities\TravelScheduleUmum;
use Modules\Travel\Entities\TravelScheduleUmumXDay;
use Modules\Travel\Entities\Route;
use Datatables;
use Input;
use DB;

class JadwalController extends Controller {
private $route;
private $vehicle;
public $partner_id;
	function __construct(){
		$this->partner_id=Session::get('id');

	}
	public function index()
	{
		return view('travelpartner::index');
	}
	function jadwal($date)
	{
		//ini_set('memory_limit','256M');
		$jadwal=Travelschedule::partnerSchedule($this->partner_id)->get();
		$route=Route::getRoutePartner($this->partner_id)->get();
		$vehicle=Vehicle::where('PARTNER_ID','=', $this->partner_id)->get();
	
		return view('travelpartner::jadwal.index',compact('jadwal','route','vehicle','date'));
	}
	function addJadwal()
	{
		$data=Input::all();
		print_r($data);
		$tanggal=$data['tanggal'];
		unset($data['tanggal'],$data['_token']);
		$data['TRAVEL_SCHEDULE_CREATEBY']=Session::get('id');
		$hour_estimate=$data['hour_estimate']; $minute_estimate=$data['minute_estimate'];

		$hour_depart=date('H:i',strtotime($data['hour_depart'].":".$data['minute_depart']));
		$flag=0; $i=0;
		unset($data['_token']);
		unset($data['date']);
		unset($data['depart_hour'],$data['depart_minute'], $data['hour_estimate'], $data['minute_estimate']);
		unset($data['hour_depart'],$data['minute_depart']);
		foreach ($tanggal as $row) {
			$data['TRAVEL_SCHEDULE_DEPARTTIME']=date('Y-m-d H:i', strtotime($row." ".$hour_depart));
			$hour_arrive=date('Y-m-d H:i', strtotime('+'.$hour_estimate.' hour', strtotime($data['TRAVEL_SCHEDULE_DEPARTTIME'])));
			$data['TRAVEL_SCHEDULE_ARRIVETIME']=date('Y-m-d H:i', strtotime('+'.$minute_estimate.' minutes', strtotime($hour_arrive)));
			
			$flag=Travelschedule::where(function($query) use ($data){
				$query->where('TRAVEL_SCHEDULE_DEPARTTIME','<=',date('Y-m-d H:i',strtotime($data['TRAVEL_SCHEDULE_ARRIVETIME'])))
					->where('TRAVEL_SCHEDULE_ARRIVETIME','>=',date('Y-m-d H:i',strtotime($data['TRAVEL_SCHEDULE_ARRIVETIME'])));
				})
				->orWhere(function($query) use ($data){
				$query->where('TRAVEL_SCHEDULE_DEPARTTIME','<=',date('Y-m-d H:i',strtotime($data['TRAVEL_SCHEDULE_DEPARTTIME'])))
					->where('TRAVEL_SCHEDULE_ARRIVETIME','>=',date('Y-m-d H:i',strtotime($data['TRAVEL_SCHEDULE_DEPARTTIME'])));
				})
				->orWhere(function($query)use ($data){
					$query->where('TRAVEL_SCHEDULE_DEPARTTIME','>=',date('Y-m-d H:i',strtotime($data['TRAVEL_SCHEDULE_DEPARTTIME'])))
							->where('TRAVEL_SCHEDULE_ARRIVETIME','<=',date('Y-m-d H:i',strtotime($data['TRAVEL_SCHEDULE_ARRIVETIME'])));
				})
				->where('VEHICLE_ID','=',$data['VEHICLE_ID'])->count();
			
			if($flag==0) {
				Travelschedule::insert($data);
			}
			elseif ($flag>0 && $i!=1) {
				echo json_encode("Ada jadwal yang bentrok, mohon periksa kembali");
				$i=1;
			}
		}
	}

	function jadwalharian($tanggal){		
		$schedule =travelschedule::getScheduleDayPartner($tanggal,$this->partner_id)->get();
        return Datatables::of($schedule)
         ->addColumn('action', function ($schedule) {
         		//return '<li  class="dropdown dropdown-no-type"><a data-toggle="dropdown" class="dropdown-toggle btn btn-xs btn-primary" href="#" > Pilihan <b class="caret"></b></a><ul class="dropdown-menu"><li><button class="btn btn-primary edit" id="'.$schedule->TRAVEL_SCHEDULE_ID.'">Edit</button></li><li><button class="btn btn-danger" id="'.$schedule->TRAVEL_SCHEDULE_ID.'" data-target="#hapusUser">Hapus</button></li></ul></li>';
         		return '<button class="btn  btn-xs btn-primary" id="'.$schedule->TRAVEL_SCHEDULE_ID.'"><i class="fa fa-pencil"></i> </button></a><button class="btn  btn-xs btn-danger" id="'.$schedule->TRAVEL_SCHEDULE_ID.'" data-target="#hapusUser""><i class="fa fa-times"></i> </button><button class="btn  btn-xs btn-warning" id="'.$schedule->TRAVEL_SCHEDULE_ID.'" data-target="#tambahPenumpang""><i class="fa fa-plus-circle "></i> </button>';
            })
            ->make(true);
	}
	function jadwal_harian($tanggal)
	{
		$route=Route::getRoutePartner($this->partner_id)->get();
		$vehicle=Vehicle::where('PARTNER_ID','=', $this->partner_id)->get();
		return view('travelpartner::jadwal.jadwal_harian',compact('tanggal','route','vehicle'));
	}
	function mingguan()
	{
		return view('travelpartner::jadwal.mingguan');
	}
	function addJadwalMingguan()
	{
		$data=Input::all();

		$start=date('Y-m-d', strtotime($data['start']));
		$stop=date('Y-m-d', strtotime($data['stop']));
		$tanggal=$data['tanggal'];
		unset($data['tanggal'],$data['_token']);
		$data['TRAVEL_SCHEDULE_CREATEBY']=Session::get('id');
		$hour_depart=date('H:i', strtotime($data['hour_depart'].':'.$data['minute_depart']));
		$plus=$data['hour_estimate']*60+$data['minute_estimate'];
		$hour_arrive=date('H:i', strtotime('+'.$plus.' minutes', strtotime($hour_depart)));
		unset($data['hour_depart'],$data['minute_estimate'],$data['hour_estimate'],$data['minute_depart'],$data['start'],$data['stop']);
		$i=0; $flag=0;
		//$data_mingguan=["TRAVEL_SCHEDULE_UMUM_FROM"=>$start,'TRAVEL_SCHEDULE_UMUM_TO'=>$stop];
		//TravelScheduleUmum::insert($data_mingguan);
		//$data['TRAVEL_SCHEDULE_UMUM_ID']=DB::getPdo()->lastInsertId();
		while($start <=$stop) {

			$index=date('N',strtotime($start))-1;
			if (in_array($index, $tanggal))
			{
				$data['TRAVEL_SCHEDULE_DEPARTTIME']=date('Y-m-d H:i', strtotime($start." ".$hour_depart));
				$data['TRAVEL_SCHEDULE_ARRIVETIME']=date('Y-m-d H:i', strtotime($start." ".$hour_arrive));
				
				$flag=Travelschedule::where(function($query) use ($data){
				$query->where('TRAVEL_SCHEDULE_DEPARTTIME','<=',date('Y-m-d H:i',strtotime($data['TRAVEL_SCHEDULE_ARRIVETIME'])))
					->where('TRAVEL_SCHEDULE_ARRIVETIME','>=',date('Y-m-d H:i',strtotime($data['TRAVEL_SCHEDULE_ARRIVETIME'])));
				})
				->orWhere(function($query) use ($data){
				$query->where('TRAVEL_SCHEDULE_DEPARTTIME','<=',date('Y-m-d H:i',strtotime($data['TRAVEL_SCHEDULE_DEPARTTIME'])))
					->where('TRAVEL_SCHEDULE_ARRIVETIME','>=',date('Y-m-d H:i',strtotime($data['TRAVEL_SCHEDULE_DEPARTTIME'])));
				})
				->orWhere(function($query)use ($data){
					$query->where('TRAVEL_SCHEDULE_DEPARTTIME','>=',date('Y-m-d H:i',strtotime($data['TRAVEL_SCHEDULE_DEPARTTIME'])))
							->where('TRAVEL_SCHEDULE_ARRIVETIME','<=',date('Y-m-d H:i',strtotime($data['TRAVEL_SCHEDULE_ARRIVETIME'])));
				})
				->where('VEHICLE_ID','=',$data['VEHICLE_ID'])->count();
			
				if($flag==0) {
					Travelschedule::insert($data);
				}
				elseif ($flag>0 && $i!=1) {
					echo json_encode("Ada jadwal yang bentrok, mohon periksa kembali");
					$i=1;
				}
			}
			$start=date('Y-m-d',strtotime('+1 day',strtotime($start)));
		
		}
		/*foreach ($tanggal as $key) {
			$temp=['DAY_ID'=>$key+1,'TRAVEL_SCHEDULE_UMUM_ID'=>$data['TRAVEL_SCHEDULE_UMUM_ID']];
			//TravelScheduleUmumXDay::insert($temp);
		}*/
	;
	}

	function jadwalUmum(){
		$jadwalTravelschedule::partnerSchedule($this->partner_id)->get();
		$route=Route::getRoutePartner($this->partner_id)->get();
		$vehicle=Vehicle::where('PARTNER_ID','=', $this->partner_id)->get();
		return view('travelpartner::jadwal.umum_index',compact('jadwal','route','vehicle'));
	}
	function umum_mingguan(){
		$path=url('public/Assets\vehiclePhoto');
		$schedule =TravelScheduleUmum::scheduleMingguan()->distinct()->get();
        return Datatables::of($schedule)
         ->addColumn('action', function ($schedule) {
         		return '<button class="btn  btn-xs btn-primary" id="'.$schedule->TRAVEL_SCHEDULE_UMUM_ID.'"><i class="fa fa-pencil"></i> </button></a><button class="btn  btn-xs btn-danger" id="'.$schedule->TRAVEL_SCHEDULE_UMUM_ID.'" data-target="#hapusUser""><i class="fa fa-times"></i> </button>';
            })
         ->addColumn('photo', function ($schedule) use($path) {
         		return '<img src="'.$path.'/'.$schedule['VEHICLE_PHOTO'].'" style="width:50px; height:50px">';
         	
            })
            ->make(true);
	}
	function mingguan_detail(){
		$id=Input::get('TRAVEL_SCHEDULE_UMUM_ID');
		$data=TravelScheduleUmumXDay::where('TRAVEL_SCHEDULE_UMUMXDAY.	TRAVEL_SCHEDULE_UMUM_ID','=',$id)
									->join('TRAVEL_SCHEDULE_UMUM','TRAVEL_SCHEDULE_UMUM.TRAVEL_SCHEDULE_UMUM_ID','=','TRAVEL_SCHEDULE_UMUMXDAY.TRAVEL_SCHEDULE_UMUM_ID')
									->join('TRAVEL_SCHEDULE','TRAVEL_SCHEDULE.TRAVEL_SCHEDULE_UMUM_ID','=','TRAVEL_SCHEDULE_UMUM.TRAVEL_SCHEDULE_UMUM_ID')
									->groupBy('TRAVEL_SCHEDULE_UMUMXDAY.DAY_ID')
									->get();
		return  json_encode($data);
	}
	function detail_jadwal(){
		$data=Input::all();
		$schedule=travelschedule::partnerSchedule($this->partner_id)
							->where('TRAVEL_SCHEDULE_ID','=',$data['TRAVEL_SCHEDULE_ID'])->get();
		return json_encode($schedule);
	}
	
}