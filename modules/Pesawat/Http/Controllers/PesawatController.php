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
		$schedule = json_decode($string, true);

		//print_r($schedule);
		return view('pesawat::hasil-search',compact('schedule'));
	}
	
}