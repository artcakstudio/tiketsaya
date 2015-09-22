<?php namespace Modules\Rent\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Rent\Entities\Renttransaction;
use Modules\Rent\Entities\Statustransactionrent;
use Modules\Rent\Entities\Renttransactiondetail;
use Datatables;
use Input;
class RenttransactionController extends Controller {
	
	public function index()
	{
		$status=statustransactionrent::all();	
		return view('rent::transaction.index',compact('status'));
	}
	function getAllTransaction()
	{
		$transaction =Renttransaction::getAllTransaction();
        return Datatables::of($transaction)
         ->addColumn('action', function ($transaction) {
         		return '<li  class="dropdown dropdown-no-type "><a data-toggle="dropdown" class="dropdown-toggle btn btn-xs btn-primary" href="#" > Pilihan <b class="caret"></b></a><ul class="dropdown-menu"><li><button class="btn btn-primary editstatus" id="'.$transaction->RENT_TRANSACTION_ID.'">Edit Status</button></li><li><button class="btn btn-warning detail" id="'.$transaction->RENT_TRANSACTION_ID.'">Detail</button></li></ul></li>';
            })
            ->make(true);
	}
	function editStatus()
	{
		$data=Input::all();
		unset($data['_token']);
		$transaction=Renttransaction::findTransaction($data['RENT_TRANSACTION_ID']);
		$data['RENT_TRANSACTION_UPDATE']=date('y-m-d H:i:s');
		print_r($data);
		$transaction->update($data);
		return back();
	}
	function detail($id_transaction){

		$transaction=renttransactiondetail::getDetail($id_transaction)->get();
		echo json_encode($transaction);
	}
}