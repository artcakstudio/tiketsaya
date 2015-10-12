<?php namespace Modules\Pesawat\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Input;
use Session;
use View;
class PesawatController extends Controller {
	
	public $schedule_search=[];
	public function index()
	{
		return view('pesawat::index');
	}
	public function search()
	{
//		$path=url('jsonfile/input.json');
		/*$input=Input::all();
		unset($input['_token']);
		$input['depart_date']=date('Y-m-d',strtotime($input['depart_date']));
		$input['return_date']=date('Y-m-d',strtotime($input['return_date']));
		$data=json_encode($input);
//		$input=file_get_contents("/var/www/tiketsaya/jsonfile/input.json");
		$schedule_search=[];
		$link[0]='schedule/airasia';
		$link[1]='schedule/citilink';
		$link[2]='schedule/lionair';
		$path=["/var/www/tiketsaya/jsonfile/example_airasia.json","/var/www/tiketsaya/jsonfile/example_citilink.json", "/var/www/tiketsaya/jsonfile/example_lionair.json"];
		foreach ($link as $row) {
			$url='localhost:6070/'.$row;
			$ch = curl_init();
	
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch,CURLOPT_POST, TRUE);
			curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_HEADER, 0); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			$result = curl_exec($ch);
			curl_close($ch);

//			print_r($result);
			$result = json_decode($result,true);
			array_push($schedule_search, $result);
//print_r($result);
			}
			$input["type"]="pesawat";*/
		
//		print_r($schedule_search);
			$input=Input::all();
			unset($input['input']['_token']);
			$path=url('jsonfile/example_lionair.json');
			$temp=json_decode(file_get_contents("$path"),true);
			$schedule_search=$temp['depart'];
			
			$path=url('jsonfile/example_citilink.json');
			$temp=json_decode(file_get_contents("$path"),true);
			//$schedule_search=$schedule_search+$temp['depart'];
			$schedule_search=array_merge($schedule_search , $temp['depart']);
			
			Session(['PESAWAT.input'=>$input]);
			$schedule_search=$this->bubbleSort($schedule_search,'price',1);
		//dd($schedule_search);
		return view('pesawat::hasil-search',compact('schedule_search','type'));
	}

	function hasil_search(){
		
		$data=Input::all();
		$schedule_search=$this->bubbleSort($data['schedule_search'],$data['parameter'],$data['x']);
		return view::make('pesawat::search-ajax',compact('schedule_search'));
	}
	function step1()
	{
		
		$data=Input::all();
		
		$temp=json_decode($data['data'],true);
		unset($data['data']);

		if(!isset(Session::get('PESAWAT')['DATA_PESAWAT'])){
			session(['PESAWAT.DATA_PESAWAT'=>$temp]);
		}
		
//Session::flush();
		//dd(Session::all());
		return view('pesawat::step1');
	}
	function preview(){
		$data=Input::all();
		unset($data['_token']);

		Session(['PESAWAT.DATA_COSTUMER'=>$data]);

		//dd(Session::all());
		return view('pesawat::preview');
	}
	
function bubbleSort($arr,$parameter,$sort) {
    $sorted = false;

    if($sort==1)
    {
	    while (false === $sorted) {
	        $sorted = true;
	        for ($i = 0; $i < count($arr)-1; ++$i) {
	            $current = $arr[$i];
	            $next = $arr[$i+1];
			

				if ($parameter=="berangkat"){
		            $current_compare=date('H:i', strtotime($current['time'][0]));
		            $next_compare=date('H:i', strtotime($next['time'][0]));
	            }
	            elseif ($parameter=="tiba") {
	            	$current_compare=date("H:i", strtotime($current['time'][1]));
	            	$next_compare=date('H:i', strtotime($next['time'][1]));
	            }
	            elseif ($parameter=="durasi") {
	            	$current_compare=$current['time'][1]-$current['time'][0];
	            	$next_compare=$next['time'][1]-$next['time'][0];	
	            }
	            else{
	            	$current_compare=$current[$parameter];
	            	$next_compare=$next[$parameter];
	            }

	            if ($next_compare < $current_compare) {
	                $arr[$i] = $next;
	                $arr[$i+1] = $current;
	                $sorted = false;
	            }
	        }
	    }
    }
    else{
    	while (false === $sorted) {
	        $sorted = true;
	        for ($i = 0; $i < count($arr)-1; ++$i) {
	            $current = $arr[$i];
	            $next = $arr[$i+1];


	            if ($parameter=="berangkat"){
	            $current_compare=date('H:i', strtotime($current['time'][0]));
	            $next_compare=date('H:i', strtotime($next['time'][0]));
	            }
	            elseif ($parameter=="tiba") {
	            	$current_compare=date("H:i", strtotime($current['time'][1]));
	            	$next_compare=date('H:i', strtotime($next['time'][1]));
	            }
	            elseif ($parameter=="durasi") {
	            	$current_compare=$current['time'][1]-$current['time'][0];
	            	$next_compare=$next['time'][1]-$next['time'][0];	
	            }
	            else{
	            	$current_compare=$current[$parameter];
	            	$next_compare=$next[$parameter];
	            }

	            if ($next_compare > $current_compare) {
	                $arr[$i] = $next;
	                $arr[$i+1] = $current;
	                $sorted = false;
	            }
	        }
	    }	
    }
    return $arr;
}

function filter_harga(){
	$data=Input::all();
	//print_r($data);
	$harga_maksimum = preg_replace('/\D/', '', $data['harga_maksimum']);
	$schedule_search=[];
	foreach ($data['schedule_search'] as $row) {
		if($row['price']<=$harga_maksimum){
			array_push($schedule_search, $row);
		}
	}
	
	//print_r($schedule_search);
	return view::make('pesawat::search-ajax',compact('schedule_search'));
}


}
