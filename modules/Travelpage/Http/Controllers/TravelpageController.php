<?php namespace Modules\Travelpage\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Travel\Entities\Travelschedule;
use Modules\Vehicle\Entities\City;
use Input;

class TravelpageController extends Controller {
	
	public function index()
	{
		$city=City::all();
		return view('travelpage::travel-search',compact('city'));
	}
	function scheduleSearch()
	{
		$city=City::all();
		$data=Input::all();
		//print_r($data);
		$schedule=Travelschedule::travelSchedule($data['depart'],$data['dest'])->get();
		//print_r($schedule);
		return view('travelpage::hasil-search', compact('schedule','city'));
	}
	
}