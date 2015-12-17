<?php namespace Modules\Rentpartner\Http\Controllers;


use Pingpong\Modules\Routing\Controller;
use Session;
use Modules\Rent\Entities\Rentschedule;
use Modules\Vehicle\Entities\City;
use Modules\Vehicle\Entities\Vehicle;
use Modules\Vehicle\Entities\VehicleType;
use Datatables;
use Input;
use Redirect;
class JadwalController extends Controller {
private $vehicle;
public $partner_id;
	function __construct(){
		$this->partner_id=Session::get('id');
		
		$this->vehicle=Vehicle::where('PARTNER_ID','=', $this->partner_id)->get();
	}
	public function index()
	{
		return view('rentpartner::index');
	}
	function jadwal($date)
	{
		$vehicle=$this->vehicle;
		$jadwal=Rentschedule::partnerSchedule($this->partner_id, substr($date, 0,7))->get();
	
		return view('rentpartner::jadwal.index',compact('jadwal','route','vehicle','date'));
	}
	function addJadwal()
	{

		$data=Input::all();
		$error=["Ada Jadwal Yang bentrok, Mohon Periksa Kembali"];
		$tanggal=$data['tanggal'];
		unset($data['tanggal'],$data['_token']);
		$data['RENT_SCHEDULE_CREATEBY']=Session::get('id');
		$i=0;
		foreach ($tanggal as $row) {
			$data['RENT_SCHEDULE_DATE']=date('Y-m-d H:i', strtotime($row));
			$flag=Rentschedule::whereDate('RENT_SCHEDULE_DATE','=',date('Y-m-d',strtotime($data['RENT_SCHEDULE_DATE'])))
								->where('VEHICLE_ID','=',$data['VEHICLE_ID'])->count();
			if($flag==0) {
				Rentschedule::insert($data);
				
			}
			elseif ($flag>0 && $i!=1) {
				echo json_encode($error);
				$i=1;
			}
		}
	}
	function jadwalharian($tanggal){		
		$schedule =rentschedule::partnerSchedule($this->partner_id)
								->where('RENT_SCHEDULE_DATE',  'LIKE',$tanggal.'%' )->get();
		  $patherror=url('assets/images/noimage.png');
		$path=url('public/Assets/vehiclePhoto');
        return Datatables::of($schedule)
         ->addColumn('action', function ($schedule) {
         		return '<button class="btn  btn-xs btn-primary" id="'.$schedule->RENT_SCHEDULE_ID.'"><i class="fa fa-pencil"></i> </button></a><button class="btn  btn-xs btn-danger" id="'.$schedule->RENT_SCHEDULE_ID.'" data-target="#hapusUser""><i class="fa fa-times"></i> </button>';
            })
        ->addColumn('picture', function ($vehicle) use ($path,$patherror) {
         		return "<img src=".$path."/".$vehicle['VEHICLE_PHOTO']." style='width:50px; height:50px' onError=this.onerror=null;this.src='".$patherror."'>";
         	})
		->make(true);
	}
	function jadwal_harian($tanggal)
	{
		$vehicle=$this->vehicle;
		
		return view('rentpartner::jadwal.jadwal_harian',compact('tanggal','vehicle','city'));
	}
	function mingguan()
	{
		return view('rentpartner::jadwal.mingguan');
	}
	function addJadwalMingguan()
	{
		$data=Input::all();
		$start=date('Y-m-d', strtotime($data['start']));
		$stop=date('Y-m-d',strtotime($data['stop']));
		$tanggal=$data['tanggal'];
		unset($data['tanggal'],$data['_token'],$data['start'],$data['stop']);
		$data['RENT_SCHEDULE_CREATEBY']=Session::get('id');
		$i=0; $flag=0;
		while($start <=$stop) {
			$index= date('N',strtotime($start)) -1; 
			if (in_array($index, $tanggal))
			{
				$data['RENT_SCHEDULE_DATE']=date('Y-m-d H:i', strtotime($start));

				$flag=Rentschedule::whereDate('RENT_SCHEDULE_DATE','=',date('Y-m-d',strtotime($data['RENT_SCHEDULE_DATE'])))
								->where('VEHICLE_ID','=',$data['VEHICLE_ID'])->count();
				if($flag==0) {
					Rentschedule::insert($data);
				}
				elseif ($flag>0 && $i!=1) {
					echo json_encode("Ada jadwal yang bentrok, silahkan periksa kembali jadwal anda");
					$i=1;
				}			
			}
			$start=date('Y-m-d',strtotime('+1 day',strtotime($start)));
		}
	}
	function addJadwalHarian(){
		$data=Input::all();
		unset($data['_token']);
		$data['RENT_SCHEDULE_CREATEBY']=Session::get('id');
		$flag=Rentschedule::whereDate('RENT_SCHEDULE_DATE','=',date('Y-m-d',strtotime($data['RENT_SCHEDULE_DATE'])))
							->where('VEHICLE_ID','=',$data['VEHICLE_ID'])->count();
		if($flag==0) {
			Rentschedule::insert($data);			}
		else {
			Session::flash("error","Ada jadwal yang bentrok, mohon periksa kembali");
		}
		return Redirect::back();
	}

	function detail_jadwal(){
		$data=Input::all();

		$schedule=rentschedule::partnerSchedule($this->partner_id)
							->where('RENT_SCHEDULE_ID','=',$data['RENT_SCHEDULE_ID'])->get();
		return json_encode($schedule);
	}
	
}