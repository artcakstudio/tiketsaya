<?php namespace Modules\Travelpartner\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use  Modules\Travel\Entities\TravelTransaction;
use Modules\Travel\Entities\Statustransactiontravel;
use Session;
use Datatables;
class TransaksiController extends Controller {
	
	public function index()
	{
		return view('travelpartner::index');
	}
	function transaksi(){
		$status=statustransactiontravel::all();	
		return view('travelpartner::transaksi.index',compact('status'));
	}
	function getTransaksi(){
		$transaksi=TravelTransaction::getAllTransaction()
					->join('VEHICLE','VEHICLE.VEHICLE_ID','=','TRAVEL_SCHEDULE.VEHICLE_ID')
					->where('VEHICLE.PARTNER_ID','=',Session::get('id'));
		return Datatables::of($transaksi)
         ->addColumn('action', function ($transaksi) {
         		return '<button class="btn  btn-xs btn-primary" id="'.$transaksi->TRAVEL_TRANSACTION_ID.'"><i class="fa fa-pencil"></i> </button>';
            })
            ->make(true);
	}
	
}