<?php namespace Modules\Pesawat\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class PesawatController extends Controller {
	
	public function index()
	{
		return view('pesawat::index');
	}
	public function search()
	{
		$path=url('jsonfile/example_airasia.json');
		$string = file_get_contents("$path");
		$schedule['AIRASIA'] = json_decode($string, true);
		
		$path=url('jsonfile/example_lionair.json');
		$string = file_get_contents("$path");
		$schedule['LIONAIR'] = json_decode($string, true);

		$path=url('jsonfile/example_citilink.json');
		$string = file_get_contents("$path");
		$schedule['CITILINK'] = json_decode($string, true);
		$type="pesawat";
		//print_r($schedule);
		return view('pesawat::hasil-search',compact('schedule'));
	}
	
}