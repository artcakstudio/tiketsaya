<?php namespace Modules\Rentpartner\Http\Controllers;


use Pingpong\Modules\Routing\Controller;
use Session;
use Modules\Rent\Entities\Rentschedule;
use Modules\Vehicle\Entities\City;
use Modules\Vehicle\Entities\Vehicle;
use Modules\vehicle\Entities\VehicleType;
use Datatables;
use Input;

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
		print_r($data);
		$tanggal=$data['tanggal'];
		unset($data['tanggal'],$data['_token']);
		$data['RENT_SCHEDULE_CREATEBY']=Session::get('id');
		foreach ($tanggal as $row) {
			$data['RENT_SCHEDULE_DATE']=date('Y-m-d h:i', strtotime($row));
			Rentschedule::insert($data);
		}
	}
	function jadwalharian($tanggal){		
		$schedule =rentschedule::partnerSchedule($this->partner_id,$tanggal)->get();
        return Datatables::of($schedule)
         ->addColumn('action', function ($schedule) {
         		return '<li  class="dropdown dropdown-no-type"><a data-toggle="dropdown" class="dropdown-toggle btn btn-xs btn-primary" href="#" > Pilihan <b class="caret"></b></a><ul class="dropdown-menu"><li><button class="btn btn-primary edit" id="'.$schedule->RENT_SCHEDULE_ID.'">Edit</button></li><li><button class="btn btn-danger" id="'.$schedule->RENT_SCHEDULE_ID.'" data-target="#hapusUser">Hapus</button></li></ul></li>';
            })
            ->make(true);
	}
	function jadwal_harian($tanggal)
	{
		return view('rentpartner::jadwal.jadwal_harian',compact('tanggal','route','vehicle'));
	}
	function mingguan()
	{
		return view('rentpartner::jadwal.mingguan');
	}
	function addJadwalMingguan()
	{
		$data=Input::all();
		print_r($data);
		$start=$data['start'];
		$stop=$data['stop'];
		$tanggal=$data['tanggal'];
		unset($data['tanggal'],$data['_token'],$data['start'],$data['stop']);
		$data['RENT_SCHEDULE_CREATEBY']=Session::get('id');
		while($start <=$stop) {
			$index= date('N',strtotime($start)) -1; 
			if (in_array($index, $tanggal))
			{
				echo 'laal';
				$data['RENT_SCHEDULE_DATE']=date('Y-m-d h:i', strtotime($start));				
				Rentschedule::insert($data);
			}
			$start=date('Y-m-d',strtotime('+1 day',strtotime($start)));
		}
	}
	
}