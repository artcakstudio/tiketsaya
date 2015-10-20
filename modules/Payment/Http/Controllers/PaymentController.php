<?php namespace Modules\Payment\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
require_once base_path().'/vendor/veritrans/veritrans-php/Veritrans.php'; 
use Input;
use Redirect;
use Session;
use Mail;
use DB;

define("SUCCESS", "1");
define("PENDING", "2");
define("DENIED", "3");
define("CHALLENGE", "4");

class PaymentController extends Controller {
	
	protected $transaction_details;
	protected $token_id;
	protected $data_type;
    protected $server_key = "VT-server-vcxip7_cFu7fcbymYowGQa9Y";
    protected $is_production = false;
    protected $code_booking;

	public function index()
	{
        if(Session::has('DATA_RENT'))
        {
            $this->data_type = 'RENT';
        }
        else if(Session::has('DATA_TRAVEL'))
        {
            $this->data_type = 'TRAVEL';

        }
        else if(Session::has('PESAWAT')){
            $this->data_type='TICKET';
            $gross_amount = Session::get('PESAWAT')['DATA_COSTUMER'][$this->data_type.'_TRANSACTION_PRICE'];\
            Session(['type'=>'PESAWAT']);
        }
//print_r(Session::get('DATA_COSTUMER'));
//dd(Session::all());
	    return view('payment::index', compact('gross_amount'));

	}

    public function getCodeBooking()
    {
        
    }

    public function setOrderIdType($order_id)
    {
        if($order_id[0] == "R")
        {
            $this->data_type = "RENT";
        }
        else if($order_id[0] == "T")
        {
            $this->data_type = "TRAVEL";
        }
    }

	public function checkout()
	{
        $link=["Citilink"=>"citilink","Sriwijaya Air"=>"sriwijaya"];
        $data=Session::get('PESAWAT')['input'];
        unset($data['type']);
        //print_r($data);
        $data=array_merge($data, ["depart_value"=>Session::get('PESAWAT')['DATA_PESAWAT']['input']['value'],
        'return_value'=>preg_replace('/[\-]/', '','0~P~~P~RGFR~~1~X|QG~ 819~ ~~CGK~02/13/2016 21:10~SUB~02/13/2016 22:40~')]);
        $data_booking['passengers']['adults']=[];
         $data_booking['passengers']['children']=[];
         $data_booking['passengers']['infants']=[];
         $passenger_type=["adult"=>'adults','children'=>'children','infant'=>'infants'];
        for($i=0; $i<sizeof(Session::get('PESAWAT')['DATA_COSTUMER']['PASSENGER_DETAIL_TITTLE']); $i++){
                array_push($data_booking['passengers'][$passenger_type[Session::get('PESAWAT')['DATA_COSTUMER']['passenger_type'][$i]]], array("first_name"=>Session::get('PESAWAT')['DATA_COSTUMER']['PASSENGER_DETAIL_NAME'][$i],
                    "last_name"=>"Ripas", "title"=>Session::get('PESAWAT')['DATA_COSTUMER']['PASSENGER_DETAIL_TITTLE'][$i],
                    "wheelchair"=>false, "id"=>"5104032709940003"));
/*                array_push($data_booking['passenger'][Session::get('PESAWAT')['DATA_COSTUMER']['passenger_type'][$i]], array("last_name"=>""));
                array_push($data_booking['passenger'][Session::get('PESAWAT')['DATA_COSTUMER']['passenger_type'][$i]], array("title"=>Session::get('PESAWAT')['DATA_COSTUMER']['PASSENGER_DETAIL_TITTLE'][$i]));
                array_push($data_booking['passenger'][Session::get('PESAWAT')['DATA_COSTUMER']['passenger_type'][$i]], array("wheelchair"=>false));
                array_push($data_booking['passenger'][Session::get('PESAWAT')['DATA_COSTUMER']['passenger_type'][$i]], array("id"=>"5104032709940003"));*/
        }
        $data_booking['passengers']['contact']['first_name']=Session::get('PESAWAT')['DATA_COSTUMER']['COSTUMER_NAME'];
        $data_booking['passengers']['contact']['last_name']="Ripas";
        $data_booking['passengers']['contact']['origin_phone']='0'.Session::get('PESAWAT')['DATA_COSTUMER']['COSTUMER_TELP'];
/*   
      echo json_encode($data_booking);*/
        //echo json_encode('/');
        $data=array_merge($data,$data_booking);
      $data=json_encode($data);
      $data=stripslashes($data);
$data=str_replace(' ', '', $data);
//

        $url='localhost:6070/schedule/'.$link[Session::get('PESAWAT')['DATA_PESAWAT']['airline']].'/reserve';
            $ch = curl_init();
    
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch,CURLOPT_POST, TRUE);
            curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HEADER, 0); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            $result = curl_exec($ch);
            curl_close($ch);
            
            $result = json_decode($result,true);
            
           $this->code_booking=$result['booking_code'];
           Session(['booking_code'=>$result['booking_code']]);
     //  dd(Session::all());
        $this->setOrderIdType(Session::get('NO_PEMESANAN'));

        \Veritrans_Config::$serverKey = $this->server_key;
        \Veritrans_Config::$isProduction = $this->is_production;

        $transaction_details = array(
            'order_id' => Session::get(Session::get('type'))['DATA_COSTUMER']['NO_PEMESANAN'] ,
            'gross_amount' => Session::get(Session::get('type'))['DATA_'.Session::get('type')]['price'],
            );

        $input = Input::except('_token');
        $payment_method = $input['payment_method'];
        
        $this->transaction_details = $transaction_details;
        
        if($payment_method == "credit_card")
        {
            $this->token_id = $input['token-id'];
            $status_code = $this->payWithCreditCard();

            $this->saveData($payment_method, $status_code);
            $this->forgetSession();

            if($status_code == "200" or $status_code == "201")
            {
                return view('payment::response.success');
            }
            else
            {
                return view('payment::response.fail');
            }
        }
        
        else if($payment_method == "bank_transfer")
        {
            $status_code = $this->payWithBankTransfer();
            

            $this->saveData($payment_method, $status_code);
            $this->forgetSession();

            if($status_code == "201")
            {
                return view('payment::response.instruction');
            }
            else
            {
                return view('payment::response.fail');
            }
        }
        Session::forget("PESAWAT");
	}


    public function forgetSession()
    {
        $this->setOrderIdType(Session::get('NO_PEMESANAN'));
        Session::forget('DATA_COSTUMER');
        Session::forget('DATA_'.$this->data_type);
        Session::forget('NO_PEMESANAN');
    }

    public function saveData($payment_method, $status_code)
    {
        $TRANSACTION_STATUS = null;
        if($payment_method == "credit_card" && $status_code == "201")
        {
            $TRANSACTION_STATUS = CHALLENGE;
        }
        else if($status_code == "200")
        {
            $TRANSACTION_STATUS = SUCCESS;
        }
        else if($status_code == "201")
        {
            $TRANSACTION_STATUS = PENDING;
        }
        else if($status_code == "202")
        {
            $TRANSACTION_STATUS = DENIED;
        }

        if(Session::has('DATA_TRAVEL'))
        {
            $COSTUMER_ID = DB::table('costumer')->insertGetId([
                    'COSTUMER_NAME' => Session::get(Session::get('type'))['DATA_COSTUMER']['COSTUMER_NAME'],
                    'COSTUMER_EMAIL' => Session::get(Session::get('type'))['DATA_COSTUMER']['COSTUMER_EMAIL'],
                    'COSTUMER_TELP' => Session::get(Session::get('type'))['DATA_COSTUMER']['nohp_prefix'].Session::get(Session::get('type'))['DATA_COSTUMER']['COSTUMER_TELP'],
                ]);

            // Where is TRAVEL SCHEDULE ID?
            DB::table('TRAVEL_TRANSACTION')->insert([
                'COSTUMER_ID' => $COSTUMER_ID,
                'TRAVEL_TRANSACTION_CODE' => Session::get('NO_PEMESANAN'),
                'TRAVEL_TRANSACTION_PRICE' => Session::get('DATA_COSTUMER')['TRAVEL_TRANSACTION_PRICE'],
                'TRAVEL_TRANSACTION_STATUS_ID' => $TRANSACTION_STATUS,
                'TRAVEL_SCHEDULE_ID' => Session::get('DATA_COSTUMER')['TRAVEL_SCHEDULE_ID'],
                'TRAVEL_TRANSACTION_PASSENGER'=>Session::get('DATA_COSTUMER')['TRAVEL_TRANSACTION_PASSENGER'],
                
            ]);

        }
   /*     else if(Session::has('DATA_RENT'))
        {
            $COSTUMER_ID = DB::table('costumer')->insertGetId([
                'COSTUMER_NAME' => Session::get('DATA_COSTUMER')['COSTUMER_NAME'],
                'COSTUMER_EMAIL' => Session::get(Session::get('type'))['DATA_COSTUMER']['COSTUMER_EMAIL'],
                'COSTUMER_TELP' => Session::get('DATA_COSTUMER')['nohp_prefix'].Session::get('DATA_COSTUMER')['COSTUMER_TELP'],
            ]);

            DB::table('RENT_TRANSACTION')->insert([
                'COSTUMER_ID' => $COSTUMER_ID,
                'RENT_TRANSACTION_CODE' => Session::get('NO_PEMESANAN'),
                'RENT_TRANSACTION_price' => Session::get('DATA_COSTUMER')['RENT_TRANSACTION_PRICE'],
                'STATUS_TRANSACTION_RENT_ID' => $TRANSACTION_STATUS,
                'RENT_SCHEDULE_ID' => Session::get('DATA_COSTUMER')['RENT_SCHEDULE_ID'],
            ]);
        }*/
        else if(Session::get('type')=='PESAWAT'){
             $COSTUMER_ID = DB::table('costumer')->insertGetId([
                'COSTUMER_NAME' => Session::get('PESAWAT')['DATA_COSTUMER']['COSTUMER_NAME'],
                'COSTUMER_EMAIL' => Session::get('PESAWAT')['DATA_COSTUMER']['COSTUMER_EMAIL'],
                'COSTUMER_TELP' => Session::get('PESAWAT')['DATA_COSTUMER']['nohp_prefix'].Session::get('DATA_COSTUMER')['COSTUMER_TELP'],
            ]);

           $TICKET_ID=DB::table('TICKET_TRANSACTION')->insertGetId([
                'COSTUMER_ID' => $COSTUMER_ID,
                'TICKET_TRANSACTION_CODE' => Session::get('PESAWAT')['DATA_COSTUMER']['NO_PEMESANAN'],
                'TICKET_TRANSACTION_PRICE' => Session::get('PESAWAT')['DATA_PESAWAT']['price'],
                'TICKET_TRANSACTION_STATUS_ID' => '1',
                'TICKET_TRANSACTION_BOOKING_CODE'=>Session::get('booking_code'),
            ]);
                for($i=0; $i<sizeof(Session::get('PESAWAT')['DATA_COSTUMER']['PASSENGER_DETAIL_TITTLE']); $i++){
                    DB::table('PASSENGER_DETAIL')->insert([
                        'TICKET_TRANSACTION_ID'=>$TICKET_ID,
                        'PASSENGER_DETAIL_NAME'=>Session::get('PESAWAT')['DATA_COSTUMER']['PASSENGER_DETAIL_NAME'][$i],
                        'PASSENGER_DETAIL_KTP'=>'',
                        'PASSENGER_DETAIL_TITTLE'=>Session::get('PESAWAT')['DATA_COSTUMER']['PASSENGER_DETAIL_TITTLE'][$i],
                    ]);
                }

                DB::table('TICKET_TRANSACTION_DETAIL')->insert([
                    'TICKET_TRANSACTION_ID'=>$TICKET_ID,
                    'TICKET_TRANSACTION_DETAIL_CODE_PESAWAT'=>Session::get('PESAWAT')['DATA_PESAWAT']['plane'],
                    'TICKET_TRANSACTION_DETAIL_DEPARTURE'=>Session::get('PESAWAT')['DATA_PESAWAT']['ports'][0],
                    'TICKET_TRANSACTION_DETAIL_DESTINATION'=>Session::get('PESAWAT')['DATA_PESAWAT']['ports'][1],
                    'TICKET_TRANSACTION_DETAIL_AIRLINE'=>Session::get('PESAWAT')['DATA_PESAWAT']['airline'],
                    'TICKET_TRANSACTION_DETAIL_TIMEDEPART'=>Session::get('PESAWAT')['DATA_PESAWAT']['time'][0],
                    'TICKET_TRANSACTION_DETAIL_TIMEARRIVE'=>Session::get('PESAWAT')['DATA_PESAWAT']['time'][1],
                    'TICKET_TRANSACTION_DETAIL_TOTAL_PASSENGER'=>sizeof(Session::get('PESAWAT')['DATA_COSTUMER']['PASSENGER_DETAIL_TITTLE']),
                    'TICKET_TRANSACTION_DETAIL_DETAIL'=>json_encode(Session::get('PESAWAT')['DATA_PESAWAT']),
                    ]);
        }
    }
	
	public function payWithCreditCard()
    {

        // Data that will be send for credit card charge TRANSACTION request.
        $transaction_data = array(
          'payment_type'    => 'credit_card', 
          'credit_card'     => array(
            'token_id'      => $this->token_id,
            'bank'          => 'bni'
            ),
          'transaction_details'   => $this->transaction_details,
          );
              
        $result = \Veritrans_VtDirect::charge($transaction_data);

        if($result->status_code == "200")
        {
            // success
            // kirim invoice
            Mail::send('payment::mail-templates.invoice', compact('result'), function($message) use ($result) {
                $message->to(Session::get(Session::get('type'))['DATA_COSTUMER']['COSTUMER_EMAIL'],
                    Session::get('DATA_COSTUMER')['COSTUMER_NAME'])->subject('Invoice '.$result->order_id);
            });
        }
        else if($result->status_code == "202")
        {
            // denied
        }
        else if($result->status_code == "201")
        {
            // challenge
        }
        else
        {
            //error
            echo "Error occurred on the sent TRANSACTION data.<br />";
            echo "<h3>Result:</h3>";
            var_dump($result);
        }
        return $result->status_code;
    }
    
    public function payWithBankTransfer()
    {
        // Data that will be send for credit card charge TRANSACTION request.
        $transaction_data = array(
          'payment_type'    => 'bank_transfer',
          'bank_transfer' => array(
              'bank' => 'permata',
              ),
          'transaction_details'   => $this->transaction_details,
          );
          
        $result = \Veritrans_VtDirect::charge($transaction_data);
        $code_booking=$this->code_booking;
        if($result->status_code == "201")
        {
            // pending
            Mail::send('payment::mail-templates.va-instruction', compact('result','code_booking'), function($message) use ($result) {
                $message->to(Session::get(Session::get('type'))['DATA_COSTUMER']['COSTUMER_EMAIL'],
                    Session::get('DATA_COSTUMER')['COSTUMER_NAME'])->subject('Instruksi Pembayaran '.$result->order_id);
            });
        }
        return $result->status_code;
    }

    public function receiveNotification(){

        $result = Input::all();
        $status_code = $result['status_code'];
        $payment_type = $result['payment_type'];
        $order_id = $result['order_id'];
        $this->setOrderIdType($order_id);


    /*    Mail::send('payment::mail-templates.dummy', array(), function ($message) {
            $prep_transaction_code = $this->data_type . '_TRANSACTION_CODE';
            $message->to('reisuke.raizan@gmail.com',
                'Reisuke')->subject('Ayam');
        });
*/
//        if($payment_type == "bank_transfer") {
//            if($this->data_type == "TRAVEL") {
//
//                $query = DB::table($this->data_type . '_TRANSACTION')
//                    ->join('costumer',
//                        $this->data_type . '_TRANSACTION.COSTUMER_ID',
//                        '=',
//                        'COSTUMER.COSTUMER_ID')
//                    ->join($this->data_type . '_TRANSACTION_STATUS',
//                        $this->data_type . '_TRANSACTION.' . $this->data_type . '_TRANSACTION_STATUS_ID',
//                        '=',
//                        $this->data_type . '_TRANSACTION_STATUS.' . $this->data_type . '_TRANSACTION_STATUS_ID')
//                    ->join($this->data_type . '_SCHEDULE',
//                        $this->data_type . '_TRANSACTION.' . $this->data_type . '_SCHEDULE_ID',
//                        '=',
//                        $this->data_type . '_SCHEDULE.' . $this->data_type . '_SCHEDULE_ID')
//                    ->join('ROUTE',
//                        $this->data_type . '_SCHEDULE.ROUTE_ID',
//                        '=',
//                        'ROUTE.ROUTE_ID'
//                    )
//                    ->join('VEHICLE',
//                        'VEHICLE.VEHICLE_ID',
//                        '=',
//                        $this->data_type.'_SCHEDULE.VEHICLE_ID'
//                    )
//                    ->join('PARTNER',
//                        'PARTNER.PARTNER_ID',
//                        '=',
//                        'VEHICLE.PARTNER_ID')
//                    ->where($this->data_type . '_TRANSACTION.' . $this->data_type . '_TRANSACTION_CODE',
//                        '=',
//                        $order_id)
//                    ->first();
//
//                if($status_code == "200") {
//                    // success
//                    $route_dest = $query->ROUTE_DEST;
//                    $route_departure = $query->ROUTE_DEPARTURE;
//                    $depart = DB::table('CITY')->where('CITY_ID', '=', $route_departure)->first();
//                    $arrive = DB::table('CITY')->where('CITY_ID', '=', $route_dest)->first();
//
//                    DB::table($this->data_type . '_TRANSACTION')
//                        ->where($this->data_type.'_TRANSACTION_CODE',
//                                '=',
//                                $order_id)
//                        ->update([$this->data_type . '_TRANSACTION_STATUS_ID' => SUCCESS]);
//
//                    $data_type = $this->data_type;
//                    Mail::send('payment::mail-templates.invoice', compact('result', 'query', 'depart', 'arrive', 'data_type'), function ($message) use ($query) {
//                        $prep_transaction_code = $this->data_type . '_TRANSACTION_CODE';
//                        $message->to($query->COSTUMER_EMAIL,
//                            $query->COSTUMER_NAME)->subject('Invoice Travel ' . $query->$prep_transaction_code);
//                    });
//                }
//                else if($status_code == "201") {
//                    // pending
//                }
//                else if($status_code == "202") {
//                    // denied
//                    DB::table($this->data_type . '_TRANSACTION')
//                        ->where($this->data_type.'_TRANSACTION_CODE',
//                            '=',
//                            $order_id)
//                        ->update([$this->data_type . '_TRANSACTION_STATUS_ID' => DENIED]);
//                }
//            }
//            else if($this->data_type == "RENT") {
//
//                $query = DB::table($this->data_type . '_TRANSACTION')
//                    ->join('costumer',
//                        $this->data_type . '_TRANSACTION.COSTUMER_ID',
//                        '=',
//                        'COSTUMER.COSTUMER_ID')
//                    ->join('STATUS_TRANSACTION_'.$this->data_type,
//                        $this->data_type . '_TRANSACTION.' .'STATUS_TRANSACTION_'.$this->data_type .'_ID',
//                        '=',
//                        $this->data_type . '_TRANSACTION_STATUS.' .'STATUS_TRANSACTION_'.$this->data_type .'_ID')
//                    ->join($this->data_type . '_SCHEDULE',
//                        $this->data_type . '_TRANSACTION.' . $this->data_type . '_SCHEDULE_ID',
//                        '=',
//                        $this->data_type . '_SCHEDULE.' . $this->data_type . '_SCHEDULE_ID')
//                    ->join('VEHICLE',
//                        'VEHICLE.VEHICLE_ID',
//                        '=',
//                        $this->data_type.'_SCHEDULE.VEHICLE_ID'
//                    )
//                    ->join('PARTNER',
//                        'PARTNER.PARTNER_ID',
//                        '=',
//                        'VEHICLE.PARTNER_ID')
//                    ->join('CITY',
//                        'CITY.CITY_ID',
//                        '=',
//                        'VEHICLE.CITY_ID')
//                    ->where($this->data_type . '_TRANSACTION.' . $this->data_type . '_TRANSACTION_CODE',
//                        '=',
//                        $order_id)
//                    ->first();
//
//
//                if($status_code == "200") {
//                    // success
//
//                    DB::table($this->data_type . '_TRANSACTION')
//                        ->where($this->data_type.'_TRANSACTION_CODE',
//                            '=',
//                            $order_id)
//                        ->update(['STATUS_TRANSACTION_'.$this->data_type . '_ID' => SUCCESS]);
//
//                    $data_type = $this->data_type;
//
//                    Mail::send('payment::mail-templates.invoice', compact('result', 'query', 'data_type'), function ($message) use ($query) {
//                        $prep_transaction_code = $this->data_type . '_TRANSACTION_CODE';
//                        $message->to($query->costumer_email,
//                            $query->costumer_name)->subject('Invoice Rental ' . $query->$prep_transaction_code);
//                    });
//                }
//                else if($status_code == "201") {
//                    // pending
//                }
//                else if($status_code == "202") {
//                    // denied
//                    DB::table($this->data_type . '_TRANSACTION')
//                        ->where($this->data_type.'_TRANSACTION_CODE',
//                            '=',
//                            $order_id)
//                        ->update(['STATUS_TRANSACTION_'.$this->data_type . '_ID' => DENIED]);
//                }
//            }
//        }
        if($payment_type == "bank_transfer") {
            if($this->data_type == "TRAVEL") {

                $query = DB::table($this->data_type . '_TRANSACTION')
                    ->join('costumer',
                        $this->data_type . '_TRANSACTION.COSTUMER_ID',
                        '=',
                        'costumer.COSTUMER_ID')
                    ->join($this->data_type . '_TRANSACTION_STATUS',
                        $this->data_type . '_TRANSACTION.' . $this->data_type . '_TRANSACTION_STATUS_ID',
                        '=',
                        $this->data_type . '_TRANSACTION_STATUS.' . $this->data_type . '_TRANSACTION_STATUS_ID')
                    ->join($this->data_type . '_SCHEDULE',
                        $this->data_type . '_TRANSACTION.' . $this->data_type . '_SCHEDULE_ID',
                        '=',
                        $this->data_type . '_SCHEDULE.' . $this->data_type . '_SCHEDULE_ID')
                    ->join('ROUTE',
                        $this->data_type . '_SCHEDULE.ROUTE_ID',
                        '=',
                        'ROUTE.ROUTE_ID'
                    )
                    ->join('VEHICLE',
                        'VEHICLE.VEHICLE_ID',
                        '=',
                        $this->data_type.'_SCHEDULE.VEHICLE_ID'
                    )
                    ->join('PARTNER',
                        'PARTNER.PARTNER_ID',
                        '=',
                        'VEHICLE.PARTNER_ID')
                    ->where($this->data_type . '_TRANSACTION.' . $this->data_type . '_TRANSACTION_CODE',
                        '=',
                        $order_id)
                    ->first();

                if($status_code == "200") {
                    // success
                    $route_dest = $query->ROUTE_DEST;
                    $route_departure = $query->ROUTE_DEPARTURE;
                    $depart = DB::table('CITY')->where('CITY_ID', '=', $route_departure)->first();
                    $arrive = DB::table('CITY')->where('CITY_ID', '=', $route_dest)->first();

                    DB::table($this->data_type . '_TRANSACTION')
                        ->where($this->data_type.'_TRANSACTION_CODE',
                                '=',
                                $order_id)
                        ->update([$this->data_type . '_TRANSACTION_STATUS_ID' => SUCCESS]);

                    $data_type = $this->data_type;
                    Mail::send('payment::mail-templates.invoice', compact('result', 'query', 'depart', 'arrive', 'data_type'), function ($message) use ($query) {
                        $prep_transaction_code = $this->data_type . '_TRANSACTION_CODE';
                        $message->to($query->COSTUMER_EMAIL,
                            $query->COSTUMER_NAME)->subject('Invoice Travel ' . $query->$prep_transaction_code);
                    });
                }
                else if($status_code == "201") {
                    // pending
                }
                else if($status_code == "202") {
                    // denied
                    DB::table($this->data_type . '_TRANSACTION')
                        ->where($this->data_type.'_TRANSACTION_CODE',
                            '=',
                            $order_id)
                        ->update([$this->data_type . '_TRANSACTION_STATUS_ID' => DENIED]);
                }
            }
            else if($this->data_type == "RENT") {

                $query = DB::table($this->data_type . '_TRANSACTION')
                    ->join('costumer',
                        $this->data_type . '_TRANSACTION.COSTUMER_ID',
                        '=',
                        'costumer.COSTUMER_ID')
                    ->join('STATUS_TRANSACTION_'.$this->data_type,
                        $this->data_type . '_TRANSACTION.' .'STATUS_TRANSACTION_'.$this->data_type .'_ID',
                        '=',
                        'STATUS_TRANSACTION_'.$this->data_type.'.STATUS_TRANSACTION_'.$this->data_type .'_ID')
                    ->join($this->data_type . '_SCHEDULE',
                        $this->data_type . '_TRANSACTION.' . $this->data_type . '_SCHEDULE_ID',
                        '=',
                        $this->data_type . '_SCHEDULE.' . $this->data_type . '_SCHEDULE_ID')
                    ->join('VEHICLE',
                        'VEHICLE.VEHICLE_ID',
                        '=',
                        $this->data_type.'_SCHEDULE.VEHICLE_ID'
                    )
                    ->join('PARTNER',
                        'PARTNER.PARTNER_ID',
                        '=',
                        'VEHICLE.PARTNER_ID')
                    ->join('CITY',
                        'CITY.CITY_ID',
                        '=',
                        'VEHICLE.CITY_ID')
                    ->where($this->data_type . '_TRANSACTION.' . $this->data_type . '_TRANSACTION_CODE',
                        '=',
                        $order_id)
                    ->first();


                if($status_code == "200") {
                    // success

                    DB::table($this->data_type . '_TRANSACTION')
                        ->where($this->data_type.'_TRANSACTION_CODE',
                            '=',
                            $order_id)
                        ->update(['STATUS_TRANSACTION_'.$this->data_type . '_ID' => SUCCESS]);

                    $data_type = $this->data_type;

                    Mail::send('payment::mail-templates.invoice', compact('result', 'query', 'data_type'), function ($message) use ($query) {
                        $prep_transaction_code = $this->data_type . '_TRANSACTION_CODE';
                        $message->to($query->COSTUMER_EMAIL,
                            $query->COSTUMER_NAME)->subject('Invoice Rental ' . $query->$prep_transaction_code);
                    });
                }
                else if($status_code == "201") {
                    // pending
                }
                else if($status_code == "202") {
                    // denied
                    DB::table($this->data_type . '_TRANSACTION')
                        ->where($this->data_type.'_TRANSACTION_CODE',
                            '=',
                            $order_id)
                        ->update(['STATUS_TRANSACTION_'.$this->data_type . '_ID' => DENIED]);
                }
            }
        }
    }
}
