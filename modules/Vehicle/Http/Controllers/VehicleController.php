<?php namespace Modules\Vehicle\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\vehicle\Entities\Vehicle;
use Modules\vehicle\Entities\City;
use Modules\vehicle\Entities\VehicleType;
use Modules\vehicle\Entities\Partner;
use Datatables;
use View;
use Input;
use Session;
use Redirect;
use Html;
class VehicleController extends Controller {
	public function index()
	{
		$city=City::all();
		$type=VehicleType::all();
		$partner=Partner::all();
		return view('vehicle::index',compact('city','type','partner'));
	}
	public function getAllVehicle()
	{
		$path=public_path().'\Assets\vehiclePhoto';
		$vehicles =Vehicle::getAllVehicle()->distinct()->get();
        return Datatables::of($vehicles)
         ->addColumn('action', function ($vehicle) {
              //  return '<a href="#edit-'.$user->USERS_ID.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a><a href="#hapus-'.$user->USERS_ID.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-edit"></i> Hapus</a>';
         		return '<li style="decoration:none" class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle btn btn-xs btn-primary" href="#" > Pilihan <b class="caret"></b></a><ul class="dropdown-menu"><li><a href="vehicle/edit/'.$vehicle->VEHICLE_ID.'" class="btn  btn-primary">Edit</a></li><li><button class="btn btn-danger" id="'.$vehicle->VEHICLE_ID.'" data-target="#hapusUser">Hapus</button></li></ul></li>';
            })
         ->addColumn('photo', function ($vehicle) {
         		return '<img src="public/Assets\vehiclePhoto/'.$vehicle['VEHICLE_PHOTO'].'" style="width:50px; height:50px">';
         	
            })
 
            ->make(true);
	}
	public function edit($id)
	{
		$vehicle=Vehicle::getSingleVehicle($id)->first();
		$city=City::all();
		$type=VehicleType::all();
		$partner=Partner::all();
		return view::make('vehicle::editVehicle',compact('vehicle','city','partner','type','id'));
	}
	public function create()
	{
		$city=City::all();
		$type=VehicleType::all();
		$partner=Partner::all();
		return view::make('vehicle::addVehicle',compact('city','type','partner'));
	}
	function store()
	{
		$data=Input::all();
		unset($data['_token']);
		$data['VEHICLE_PHOTO']=md5(time()).'.jpg';
		$data['VEHICLE_STATUS_ID']='1';
		$destPath=public_path().'\Assets\vehiclePhoto';
		Input::file('VEHICLE_PHOTO')->move($destPath,$data['VEHICLE_PHOTO']);
		$data['VEHICLE_CREATEBY']=session::get('id');
		print_r($data);
		Vehicle::insert($data);
		return back();
	}
	function update(){
		$data=Input::all();
		$id=$data['VEHICLE_ID'];
		unset($data['_token']);
		unset($data['VEHICLE_ID']);

		$vehicle=Vehicle::where('VEHICLE_ID','=',$id);
		if(!isset($data['VEHICLE_PHOTO'])) unset($data['VEHICLE_PHOTO']);
		else{
			$foto=$vehicle->first()['VEHICLE_PHOTO'];
			@unlink(public_path().'\Assets\vehiclePhoto/'.$foto);
			$destPath=public_path().'\Assets\vehiclePhoto';
			$data['VEHICLE_PHOTO']=md5(time()).'.jpg';
			Input::file('VEHICLE_PHOTO')->move($destPath,$data['VEHICLE_PHOTO']);
		}
		$data['VEHICLE_UPDATEBY']=session::get('id');
		$vehicle->update($data);
		return back();
	}
	function destroy()
	{
		$id=Input::get('VEHICLE_ID');
		print_r($id);
		$vehicle=Vehicle::findVehicle($id);
		$vehicle->delete();
		return back();
	}
}