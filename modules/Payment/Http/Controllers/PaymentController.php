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
//print_r(Session::get('DATA_COSTUMER'));

		$gross_amount = Session::get('DATA_COSTUMER')[$this->data_type.'_TRANSACTION_PRICE'];
	    return view('payment::index', compact('gross_amount'));

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
        $this->setOrderIdType(Session::get('NO_PEMESANAN'));

        \Veritrans_Config::$serverKey = $this->server_key;
        \Veritrans_Config::$isProduction = $this->is_production;

        $transaction_details = array(
            'order_id' => Session::get('NO_PEMESANAN'),
            'gross_amount' => Session::get('DATA_COSTUMER')[$this->data_type.'_TRANSACTION_PRICE']
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
                    'COSTUMER_NAME' => Session::get('DATA_COSTUMER')['COSTUMER_NAME'],
                    'COSTUMER_EMAIL' => Session::get('DATA_COSTUMER')['COSTUMER_EMAIL'],
                    'COSTUMER_TELP' => Session::get('DATA_COSTUMER')['nohp_prefix'].Session::get('DATA_COSTUMER')['COSTUMER_TELP'],
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
        else if(Session::has('DATA_RENT'))
        {
            $COSTUMER_ID = DB::table('costumer')->insertGetId([
                'COSTUMER_NAME' => Session::get('DATA_COSTUMER')['COSTUMER_NAME'],
                'COSTUMER_EMAIL' => Session::get('DATA_COSTUMER')['COSTUMER_EMAIL'],
                'COSTUMER_TELP' => Session::get('DATA_COSTUMER')['nohp_prefix'].Session::get('DATA_COSTUMER')['COSTUMER_TELP'],
            ]);

            DB::table('RENT_TRANSACTION')->insert([
                'COSTUMER_ID' => $COSTUMER_ID,
                'RENT_TRANSACTION_CODE' => Session::get('NO_PEMESANAN'),
                'RENT_TRANSACTION_price' => Session::get('DATA_COSTUMER')['RENT_TRANSACTION_PRICE'],
                'STATUS_TRANSACTION_RENT_ID' => $TRANSACTION_STATUS,
                'RENT_SCHEDULE_ID' => Session::get('DATA_COSTUMER')['RENT_SCHEDULE_ID'],
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
                $message->to(Session::get('DATA_COSTUMER')['COSTUMER_EMAIL'],
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

        if($result->status_code == "201")
        {
            // pending
            Mail::send('payment::mail-templates.va-instruction', compact('result'), function($message) use ($result) {
                $message->to(Session::get('DATA_COSTUMER')['COSTUMER_EMAIL'],
                    Session::get('DATA_COSTUMER')['COSTUMER_NAME'])->subject('Instruksi Pembayaran '.$result->order_id);
            });
        }
        return $result->status_code;
    }

    public function receiveNotification(){

        $input = Input::all();
        $status_code = $input['status_code'];
        $payment_type = $input['payment_type'];
        $order_id = $input['order_id'];
        $this->setOrderIdType($order_id);

        if($payment_type == "bank_transfer") {
            if($this->data_type == "TRAVEL") {

                $query = DB::table($this->data_type . '_TRANSACTION')
                    ->join('costumer',
                        $this->data_type . '_TRANSACTION.COSTUMER_ID',
                        '=',
                        'COSTUMER.COSTUMER_ID')
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
                        'COSTUMER.COSTUMER_ID')
                    ->join('STATUS_TRANSACTION_'.$this->data_type,
                        $this->data_type . '_TRANSACTION.' .'STATUS_TRANSACTION_'.$this->data_type .'_ID',
                        '=',
                        $this->data_type . '_TRANSACTION_STATUS.' .'STATUS_TRANSACTION_'.$this->data_type .'_ID')
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
                        $message->to($query->costumer_email,
                            $query->costumer_name)->subject('Invoice Rental ' . $query->$prep_transaction_code);
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
