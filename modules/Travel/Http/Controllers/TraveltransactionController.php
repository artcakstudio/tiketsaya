<?php namespace Modules\Travel\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Travel\Entities\Traveltransaction;
use Modules\Travel\Entities\Statustransactiontravel;
use Modules\Travel\Entities\Traveltransactiondetail;
use Datatables;
use Input;
class traveltransactionController extends Controller {	
	public function index()
	{
		$status=statustransactiontravel::all();	
		return view('travel::transaction.index',compact('status'));
	}
	function getAllTransaction()
	{
		$transaction =traveltransaction::getAllTransaction();
        return Datatables::of($transaction)
         ->addColumn('action', function ($transaction) {
         		return '<li class="dropdown dropdown-no-type"><a data-toggle="dropdown" class="dropdown-toggle btn btn-xs btn-primary" href="#" > Pilihan <b class="caret"></b></a><ul class="dropdown-menu"><li><button class="btn btn-primary editstatus" id="'.$transaction->TRAVEL_TRANSACTION_ID.'">Edit Status</button></li><li><button class="btn btn-warning detail" id="'.$transaction->TRAVEL_TRANSACTION_ID.'">Detail</button></li></ul></li>';
            })
            ->make(true);
	}
	function editStatus()
	{
		$data=Input::all();
		unset($data['_token']);
		$transaction=Traveltransaction::findTransaction($data['TRAVEL_TRANSACTION_ID']);
		$data['TRAVEL_TRANSACTION_UPDATE']=date('y-m-d H:i:s');
		print_r($data);
		$transaction->update($data);
		return back();
	}
	function detail($id_transaction){

		$transaction=traveltransactiondetail::getDetail($id_transaction)->get();
		echo json_encode($transaction);
	}
}