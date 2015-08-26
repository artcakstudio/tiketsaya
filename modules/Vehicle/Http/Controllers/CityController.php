<?php namespace Modules\Vehicle\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\vehicle\Entities\City;
use Datatables;
use Input;
use Session;
class CityController extends Controller {
	
	public function index()
	{
		return view('vehicle::city.index');
	}
	function getAllCity()
	{
		$city =City::all();
        return Datatables::of($city)
         ->addColumn('action', function ($city) {
         		return '<li  class="dropdown dropdown-no-type"><a data-toggle="dropdown" class="dropdown-toggle btn btn-xs btn-primary" href="#" > Pilihan <b class="caret"></b></a><ul class="dropdown-menu"><li><button class="btn btn-primary" id="'.$city->CITY_ID.'">Edit</button></li><li><button class="btn btn-danger" id="'.$city->CITY_ID.'" data-target="#hapusUser">Hapus</button></li></ul></li>';
            })
         ->addColumn('photo', function ($vehicle) {
         		return '<img src="public/Assets\vehiclePhoto/'.$vehicle['VEHICLE_PHOTO'].'" style="width:50px; height:50px">';
         	
            })
 
            ->make(true);
	}
	function store()
	{
		$data=Input::all();
		unset($data['_token']);
		$data['CITY_CREATEBY']=session::get('id');
		City::insert($data);
		return back();
	}
	function edit()
	{
		$data=Input::all();
		$city=City::findCity($data['CITY_ID'])->first();
		return json_encode($city);
	}
	function update()
	{
		$data['CITY_NAME']=Input::get('CITY_NAME');
		$id=Input::get('CITY_ID');
		$city=City::findCity($id);
		$city->update($data);
		return back();
	}
	function destroy()
	{
		$id=Input::get('CITY_ID');
		$city=City::findCity($id);
		$city->delete();
		return back();
	}
}