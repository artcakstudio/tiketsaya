<?php namespace Modules\Pesawat\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class PesawatController extends Controller {
	
	public function index()
	{
		return view('pesawat::index');
	}
	public function search()
	{
		$path=url('jsonfile/input.json');
		$input=file_get_contents($path);
		/*$path=url('jsonfile/example_airasia.json');
		$string = file_get_contents("$path");
		$schedule['AIRASIA'] = json_decode($string, true);
		
		$path=url('jsonfile/example_lionair.json');
		$string = file_get_contents("$path");
		$schedule['LIONAIR'] = json_decode($string, true);

		$path=url('jsonfile/example_citilink.json');
		$string = file_get_contents("$path");
		$schedule['CITILINK'] = json_decode($string, true);*/
		$schedule_search=[];
		$link[0]='schedule/airasia';
		$link[1]='schedule/citilink';
		$link[2]='schedule/lionair';
		foreach ($link as $row) {
			$ch = curl_init();
			$url='localhost:6070/'.$row;
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch,CURLOPT_POST, count($input));
			curl_setopt($ch,CURLOPT_POSTFIELDS, $input);
			
			$result = curl_exec($ch);
			curl_close($ch);
			}
			$type="pesawat";
		//print_r($schedule);
		//return view('pesawat::hasil-search',compact('schedule'));
	}
	
}