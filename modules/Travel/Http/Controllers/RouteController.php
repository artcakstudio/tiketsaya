<?php namespace Modules\Travel\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Travel\Entities\Route;
use Modules\Vehicle\Entities\City;
use Datatables;
use Input;
use Session;
class RouteController extends Controller {
	
	public function index()
	{
		$city=City::all();
		return view('travel::route.index',compact('city'));
	}
	function getAllRoute()
	{
		$route=Route::getAllRoute();
        return Datatables::of($route)
         ->addColumn('action', function ($route) {
         		return '<li class="dropdown dropdown-no-type"><a data-toggle="dropdown" class="dropdown-toggle btn btn-xs btn-primary" href="#" > Pilihan <b class="caret"></b></a><ul class="dropdown-menu"><li><button class="btn btn-primary" id="'.$route->ROUTE_ID.'">Edit</button></li><li><button class="btn btn-danger" id="'.$route->ROUTE_ID.'" data-target="#hapusRoute">Hapus</button></li></ul></li>';
            })
        ->make(true);
	}
	function store()
	{
		$data=Input::all();
		unset($data['_token']);
		$data['ROUTE_CREATE']=session::get('id');
		Route::insert($data);
		return back();
	}
	function update()
	{
		$data=Input::all();
		unset($data['_token']);
		$route=Route::findRoute($data['ROUTE_ID']);
		$data['ROUTE_UPDATEBY']=session::get('id');
		$data['ROUTE_UPDATE']=date("y-m-d hh:mm:ss");
		$route->update($data);
		return back();
	}
	function destroy()
	{
		$data=Input::all();
		$route=Route::findRoute($data['ROUTE_ID']);
		$route->delete();
		return back();
	}
}