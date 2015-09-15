<?php namespace Modules\Rentpartner\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Rent\Entities\Renttransaction;
use Modules\Rent\Entities\Statustransactionrent;
use Datatables;
use Session;
class TransaksiController extends Controller {
	
	public function index()
	{
		return view('rentpartner::index');
	}
	function transaksi(){
		$status=statustransactionrent::all();	
		return view('rentpartner::transaksi.index',compact('status'));
	}
	function getTransaksi(){
		$transaksi=Renttransaction::getAllTransaction()
					->join('RENT_SCHEDULE','RENT_SCHEDULE.RENT_SCHEDULE_ID','=','RENT_TRANSACTION.RENT_SCHEDULE_ID')
					->join('VEHICLE','VEHICLE.VEHICLE_ID','=','RENT_SCHEDULE.VEHICLE_ID')
					->where('VEHICLE.PARTNER_ID','=',Session::get('id'));
		return Datatables::of($transaksi)
         ->addColumn('action', function ($transaksi) {
         		return '<button class="btn  btn-xs btn-primary" id="'.$transaksi->RENT_TRANSACTION_ID.'"><i class="fa fa-pencil"></i></button>';
            })
            ->make(true);
	}
	
}