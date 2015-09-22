<?php namespace Modules\Payment\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
require_once base_path().'/vendor/veritrans/veritrans-php/Veritrans.php'; 
use Input;
use Redirect;
use Session;
use Mail;
use DB;

class PaymentController extends Controller {
	
	protected $transaction_details;
	protected $token_id;
	protected $data_type;
    protected $server_key = "VT-server-vcxip7_cFu7fcbymYowGQa9Y";
    protected $is_production = false;

	public function index()
	{
//        dd(Session::all());
        if(Session::has('DATA_RENT'))
        {
            $this->data_type = 'RENT';
        }
        else if(Session::has('DATA_TRAVEL'))
        {
            $this->data_type = 'TRAVEL';
        }
		$gross_amount = Session::get('DATA_COSTUMER')[$this->data_type.'_TRANSACTION_PRICE'];
		return view('payment::index', compact('gross_amount'));

	}

    public function findOrderIdType($order_id)
    {
        // Travel Transaction
        $result = DB::table('travel_transaction')->where('travel_transaction_code', '=', $order_id);

        // Rent Transaction
        $result = DB::table('rent_transaction')->where('rent_transaction_code', '=', $order_id);
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
        $transaction_status = null;
        if($payment_method == "credit_card" && $status_code == "201")
        {
            $transaction_status = "challenge";
        }
        else if($status_code == "200")
        {
            $transaction_status = "success";
        }
        else if($status_code == "201")
        {
            $transaction_status = "pending";
        }
        else if($status_code == "202")
        {
            $transaction_status = "denied";
        }

        if(Session::has('DATA_TRAVEL'))
        {
            $costumer_id = DB::table('costumer')->insertGetId([
                    'costumer_name' => Session::get('DATA_COSTUMER')['COSTUMER_NAME'],
                    'costumer_email' => Session::get('DATA_COSTUMER')['COSTUMER_EMAIL'],
                    'costumer_telp' => Session::get('DATA_COSTUMER')['nohp_prefix'].Session::get('DATA_COSTUMER')['COSTUMER_TELP'],
                ]);

            $travel_transaction_status_id = DB::table('travel_transaction_status')->insertGetId([
                'travel_transaction_status_name' => $transaction_status
            ]);

            // Where is travel schedule ID?
            DB::table('travel_transaction')->insert([
                'costumer_id' => $costumer_id,
                'travel_transaction_code' => Session::get('NO_PEMESANAN'),
                'travel_transaction_price' => Session::get('DATA_COSTUMER')['TRAVEL_TRANSACTION_PRICE'],
                'travel_transaction_status_id' => $travel_transaction_status_id,
                'travel_schedule_id' => Session::get('DATA_COSTUMER')['TRAVEL_SCHEDULE_ID'],
            ]);

        }
        else if(Session::has('DATA_RENT'))
        {
            $costumer_id = DB::table('costumer')->insertGetId([
                'costumer_name' => Session::get('DATA_COSTUMER')['COSTUMER_NAME'],
                'costumer_email' => Session::get('DATA_COSTUMER')['COSTUMER_EMAIL'],
                'costumer_telp' => Session::get('DATA_COSTUMER')['nohp_prefix'].Session::get('DATA_COSTUMER')['COSTUMER_TELP'],
            ]);

            $rent_transaction_status_id = DB::table('rent_transaction_status')->insertGetId([
                'rent_transaction_status_name' => $transaction_status
            ]);

            DB::table('rent_transaction')->insert([
                'costumer_id' => $costumer_id,
                'rent_transaction_code' => Session::get('NO_PEMESANAN'),
                'rent_transaction_price' => Session::get('DATA_COSTUMER')['RENT_TRANSACTION_PRICE'],
                'rent_transaction_status_id' => $rent_transaction_status_id,
                'rent_schedule_id' => Session::get('DATA_COSTUMER')['RENT_SCHEDULE_ID'],
            ]);
        }
    }
	
	public function payWithCreditCard()
    {

        // Data that will be send for credit card charge transaction request.
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
            //deny

        }
        else if($result->status_code == "201")
        {
            //challenge

        }
        else
        {
            //error
            echo "Error occurred on the sent transaction data.<br />";
            echo "<h3>Result:</h3>";
            var_dump($result);
        }
        return $result->status_code;
    }
    
    public function payWithBankTransfer()
    {
        // Data that will be send for credit card charge transaction request.
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
          //success
            Mail::send('payment::mail-templates.va-instruction', compact('result'), function($message) use ($result) {
                $message->to(Session::get('DATA_COSTUMER')['COSTUMER_EMAIL'],
                    Session::get('DATA_COSTUMER')['COSTUMER_NAME'])->subject('Instruksi Pembayaran '.$result->order_id);
            });
        }
        return $result->status_code;
    }


    public function confirm($method, $order_id)
    {
        if(isset($method) && isset($order_id))
        {
            \Veritrans_Config::$serverKey = $this->server_key;
            \Veritrans_Config::$isProduction = $this->is_production;

            $result = \Veritrans_Transaction::status($order_id);

            $this->setOrderIdType($result->order_id);

            if($result->status_code == "404")
            {
                return view('errors.404');
            }

            else if($this->data_type == "TRAVEL") {
                if ($method == 'va' && $result->payment_type == "bank_transfer") {
                    if ($result->status_code == "200") {

                        $prep_data_type = strtolower($this->data_type);
                        $query = DB::table($prep_data_type . '_transaction')
                            ->join('costumer',
                                $prep_data_type . '_transaction.costumer_id',
                                '=',
                                'costumer.costumer_id')
                            ->join($prep_data_type . '_transaction_status',
                                $prep_data_type . '_transaction.' . $prep_data_type . '_transaction_status_id',
                                '=',
                                $prep_data_type . '_transaction_status.' . $prep_data_type . '_transaction_status_id')
                            ->join($prep_data_type . '_schedule',
                                $prep_data_type . '_transaction.' . $prep_data_type . '_schedule_id',
                                '=',
                                $prep_data_type . '_schedule.' . $prep_data_type . '_schedule_id')
                            ->join('route',
                                $prep_data_type . '_schedule.route_id',
                                '=',
                                'route.route_id'
                            )
                            ->join('vehicle',
                                'vehicle.vehicle_id',
                                '=',
                                $prep_data_type.'_schedule.vehicle_id'
                                )
                            ->join('partner',
                                'partner.partner_id',
                                '=',
                                'vehicle.partner_id')
                            ->where($prep_data_type . '_transaction.' . $prep_data_type . '_transaction_code',
                                '=',
                                $order_id)
                            ->first();

                        $route_dest = $query->ROUTE_DEST;
                        $route_departure = $query->ROUTE_DEPARTURE;
                        $depart = DB::table('city')->where('city_id', '=', $route_departure)->first();
                        $arrive = DB::table('city')->where('city_id', '=', $route_dest)->first();
//                        dd($depart);
                        $prep_transaction_status_id = strtoupper($prep_data_type . '_transaction_status_id');
                        DB::table($prep_data_type . '_transaction_status')
                            ->where($prep_data_type . '_transaction_status_id',
                                '=',
                                $query->$prep_transaction_status_id)
                            ->update([$prep_data_type . '_transaction_status_name' => 'success']);

                        $data_type = $this->data_type;
                        Mail::send('payment::mail-templates.invoice', compact('result', 'query', 'depart', 'arrive', 'data_type'), function ($message) use ($query, $prep_data_type) {
                            $prep_transaction_code = strtoupper($prep_data_type . '_transaction_code');
                            $message->to($query->COSTUMER_EMAIL,
                                $query->COSTUMER_NAME)->subject('Invoice Travel ' . $query->$prep_transaction_code);
                        });

                        return view('payment::response.success', compact('result'));
                    } else {
                        return view('payment::response.pending', compact('order_id'));
                    }
                }
                else
                {
                    // Travel non-VA method
                }
            }

            else if($this->data_type == "RENT")
            {
                if ($method == 'va' && $result->payment_type == "bank_transfer")
                {
                    if ($result->status_code == "200") {

                        $prep_data_type = strtolower($this->data_type);
                        $query = DB::table($prep_data_type . '_transaction')
                            ->join('costumer',
                                $prep_data_type . '_transaction.costumer_id',
                                '=',
                                'costumer.costumer_id')
                            ->join($prep_data_type . '_transaction_status',
                                $prep_data_type . '_transaction.' . $prep_data_type . '_transaction_status_id',
                                '=',
                                $prep_data_type . '_transaction_status.' . $prep_data_type . '_transaction_status_id')
                            ->join($prep_data_type . '_schedule',
                                $prep_data_type . '_transaction.' . $prep_data_type . '_schedule_id',
                                '=',
                                $prep_data_type . '_schedule.' . $prep_data_type . '_schedule_id')
                            ->join('vehicle',
                                'vehicle.vehicle_id',
                                '=',
                                $prep_data_type.'_schedule.vehicle_id'
                            )
                            ->join('partner',
                                'partner.partner_id',
                                '=',
                                'vehicle.partner_id')
                            ->join('city',
                                'city.city_id',
                                '=',
                                'vehicle.city_id')
                            ->where($prep_data_type . '_transaction.' . $prep_data_type . '_transaction_code',
                                '=',
                                $order_id)
                            ->first();

//                        dd($query);
                        $prep_transaction_status_id = strtoupper($prep_data_type . '_transaction_status_id');
                        DB::table($prep_data_type . '_transaction_status')
                            ->where($prep_data_type . '_transaction_status_id',
                                '=',
                                $query->$prep_transaction_status_id)
                            ->update([$prep_data_type . '_transaction_status_name' => 'success']);

                        $data_type = $this->data_type;

                        Mail::send('payment::mail-templates.invoice', compact('result', 'query', 'data_type'), function ($message) use ($query, $prep_data_type) {
                            $prep_transaction_code = strtoupper($prep_data_type . '_transaction_code');
                            $message->to($query->COSTUMER_EMAIL,
                                $query->COSTUMER_NAME)->subject('Invoice Rental ' . $query->$prep_transaction_code);
                        });

                        return view('payment::response.success', compact('result'));
                    } else {
                        return view('payment::response.pending', compact('order_id'));
                    }
                }
            }
        }
    }
}