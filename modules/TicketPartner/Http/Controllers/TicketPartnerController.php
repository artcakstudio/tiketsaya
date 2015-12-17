<?php namespace Modules\Ticketpartner\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Session;
use Modules\Vehicle\Entities\Partner;
use Modules\TicketPartner\Entities\TicketTransaction;
use Datatables;
class TicketPartnerController extends Controller {
	
	public function index()
	{
		$id=Session::get('id');
		$partner=Partner::where('PARTNER_ID','=',$id)->first();

		return view('ticketpartner::index',compact('partner'));
	}
	function list_booking(){
		return view("ticketpartner::list_booking");
	}
	public function get_list_boking()
	{
		$path=public_path().'/Assets/pesawatlogo';
		$list_booking =TicketTransaction::join('TICKET_TRANSACTION_STATUS','TICKET_TRANSACTION_STATUS.TICKET_TRANSACTION_STATUS_ID','=','TICKET_TRANSACTION.TICKET_TRANSACTION_STATUS_ID')
						->join('costumer','costumer.COSTUMER_ID','=','TICKET_TRANSACTION.COSTUMER_ID')
						->get();
        return Datatables::of($list_booking)
         ->addColumn('action', function ($list_booking) {
         			return '<button class="btn  btn-xs btn-primary" id="'.$list_booking->TICKET_TRANSACTION_ID.'"><i class="fa fa-pencil"></i> </button></a><button class="btn  btn-xs btn-warning" id="'.$list_booking->TICKET_TRANSACTION_ID.'"><i class="fa fa-circle"></i> </button>';
            })
 
            ->make(true);
	}
	
}