<?php namespace Modules\Pesawat\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Input;
use Session;
class PesawatController extends Controller {
	
	public function index()
	{
		return view('pesawat::index');
	}
	public function search()
	{
//		$path=url('jsonfile/input.json');
		$input=Input::all();
		unset($input['_token']);
		$input['depart_date']=date('Y-m-d',strtotime($input['depart_date']));
		$input['return_date']=date('Y-m-d',strtotime($input['return_date']));
		$input=json_encode($input);
//		$input=file_get_contents("/var/www/tiketsaya/jsonfile/input.json");
		$schedule_search=[];
		$link[0]='schedule/airasia';
		$link[1]='schedule/citilink';
		$link[2]='schedule/lionair';
		$path=["/var/www/tiketsaya/jsonfile/example_airasia.json","/var/www/tiketsaya/jsonfile/example_citilink.json", "/var/www/tiketsaya/jsonfile/example_lionair.json"];
		foreach ($path as $row) {
			$ch = curl_init();
			$url='localhost:6070/'.$row;
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch,CURLOPT_POST, count($input));
			curl_setopt($ch,CURLOPT_POSTFIELDS, $input);
			
//			$result = curl_exec($ch);
			
#			print_r($result);
			curl_close($ch);
//			$result = json_decode($result,true);
			array_push($schedule_search, json_decode(file_get_contents("$row"),true));

			}
			$type="pesawat";
//		print_r($schedule_search);
		Session::flash('tanggal',date('Y-m-d'));
		return view('pesawat::hasil-search',compact('schedule_search'));
	}
	function step1()
	{
	}
}
