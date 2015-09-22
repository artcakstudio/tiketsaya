<?php namespace Modules\Rentpartner\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Session;
use Modules\Rent\Entities\Rentvehicle;
use Modules\Vehicle\Entities\City;
use Modules\Vehicle\Entities\Vehicle;
use Modules\vehicle\Entities\VehicleType;
use Modules\Travel\Entities\Route;
use Datatables;
use Input;
class RouteController extends Controller {

private $partner_id;

	public function __construct()
	{
		$this->partner_id=Session::get('id');
	}
	function armada()
	{

		$armada=Vehicle::where('VEHICLE_CREATEBY','=',$this->partner_id)->get();
		$route=Route::getRoutePartner($this->partner_id);
		$city=City::all();
		$type=VehicleType::all();
		return view('rentpartner::armada.index',compact('armada','route','city','type'));
	}
	function getarmada()
	{
		$path=url("public/Assets/vehiclePhoto");
		$vehicles =Vehicle::getarmada($this->partner_id)->distinct()->get();
        return Datatables::of($vehicles)
         ->addColumn('action', function ($vehicle){
              //  return '<a href="#edit-'.$user->USERS_ID.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a><a href="#hapus-'.$user->USERS_ID.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-edit"></i> Hapus</a>';
         		return '<button class="btn  btn-xs btn-primary" id="'.$vehicle->VEHICLE_ID.'"><i class="fa fa-pencil"></i> </button></a><button class="btn  btn-xs btn-danger" id="'.$vehicle->VEHICLE_ID.'" data-target="#hapusUser""><i class="fa fa-times"></i> </button>';
            })
         ->addColumn('photo', function ($vehicle) use($path) {
         		return '<img src="'.$path.'/'.$vehicle['VEHICLE_PHOTO'].'" style="width:50px; height:50px">';
         	
            })
            ->make(true);
	}
};