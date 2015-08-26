<?php namespace Modules\Rentpage\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Rent\Entities\Rentschedule;
use Modules\Vehicle\Entities\City;
use Input;
class RentpageController extends Controller {
	
	public function index()
	{
		return view('rentpage::index');
	}
	public function scheduleSearch()
	{
		$data=Input::all();	
		$duration=$data['DURATION'];	
		$vehicle=Rentschedule::rentSchedule($data['CITY_ID'],$data['DATE'],$data['DURATION'])->get();
		$city=City::all();
		return view('rentpage::hasil-search', compact('vehicle','city','duration'));
	}
}