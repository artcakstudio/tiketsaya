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
                'travel_transaction_status_id' => $travel_transaction_status_id
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

            // Where is rent schedule ID?
            DB::table('rent_transaction')->insert([
                'costumer_id' => $costumer_id,
                'rent_transaction_code' => Session::get('NO_PEMESANAN'),
                'rent_transaction_price' => Session::get('DATA_COSTUMER')['RENT_TRANSACTION_PRICE'],
                'rent_transaction_status_id' => $rent_transaction_status_id
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
        /* Result dump example
            {#409 ?
            +"status_code": "200"
            +"status_message": "Success, Credit Card 3D Secure transaction is successful"
            +"transaction_id": "984c64b9-0fd3-469c-a52f-1ca22be8ee25"
            +"masked_card": "481111-1114"
            +"order_id": "TRAVEL_4"
            +"payment_type": "credit_card"
            +"transaction_time": "2015-09-18 15:18:12"
            +"transaction_status": "capture"
            +"fraud_status": "accept"
            +"approval_code": "1442564295658"
            +"bank": "bni"
            +"eci": "05"
            +"gross_amount": "100000.00"}
            */
        if($result->status_code == "200")
        {
            // success
            // kirim invoice
            Mail::send('payment::mail-templates.invoice', compact('result'), function($message) {
                $message->to(Session::get('DATA_COSTUMER')['COSTUMER_EMAIL'],
                    Session::get('DATA_COSTUMER')['COSTUMER_NAME'])->subject('Invoice');
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
        /*
        {#409 ?
            +"status_code": "201"
            +"status_message": "Success, PERMATA VA transaction is successful"
            +"transaction_id": "acf90966-49e0-47f6-9510-34c6eeadd732"
            +"order_id": "T9716C7"
            +"gross_amount": "100000.00"
            +"payment_type": "bank_transfer"
            +"transaction_time": "2015-09-20 01:53:53"
            +"transaction_status": "pending"
            +"permata_va_number": "8778001224668170"
        }
        */
        if($result->status_code == "201")
        {
          //success
            Mail::send('payment::mail-templates.va-instruction', compact('result'), function($message) {
                $message->to(Session::get('DATA_COSTUMER')['COSTUMER_EMAIL'],
                    Session::get('DATA_COSTUMER')['COSTUMER_NAME'])->subject('Instruksi Pembayaran');
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
            /*
                $result = array(
                    "status_code" => "201",
                    "status_message" => "Success, PERMATA VA transaction is successful",
                    "transaction_id" => "ff05337c-6c94-4f70-8e81-35acd89b688e",
                    "order_id" => "201404141421",
                    "payment_type" => "bank_transfer",
                    "transaction_time" => "2014-04-14 16:03:51",
                    "transaction_status" => "pending",
                    "permata_va_number => 8778999933221111
                );
                */
            if($result->status_code == "404")
            {
                return view('errors.404');
            }

            else if($method == 'va' && $result->payment_type == "bank_transfer")
            {
                if($result->status_code == "200")
                {

                    $prep_data_type = strtolower($this->data_type);
                    $query = DB::table($prep_data_type.'_transaction')
                        ->join('costumer',
                            $prep_data_type.'_transaction.costumer_id',
                            '=',
                            'costumer.costumer_id')
                        ->join($prep_data_type.'_transaction_status',
                            $prep_data_type.'_transaction.'.$prep_data_type.'_transaction_status_id',
                            '=',
                            $prep_data_type.'_transaction_status.'.$prep_data_type.'_transaction_status_id')
                        ->join($prep_data_type.'_schedule',
                            $prep_data_type.'_transaction.'.$prep_data_type.'_schedule_id',
                            '=',
                            $prep_data_type.'_schedule.'.$prep_data_type.'_schedule_id')
                        ->where($prep_data_type.'_transaction.'.$prep_data_type.'_transaction_code',
                                '=',
                                $order_id)
                        ->first();
                    dd($query);
                    $prep_transaction_status_id = strtoupper($prep_data_type.'_transaction_status_id');
                    DB::table($prep_data_type.'_transaction_status')
                        ->where($prep_data_type.'_transaction_status_id',
                                '=',
                                $query->$prep_transaction_status_id)
                        ->update([$prep_data_type.'_transaction_status_name' => 'success']);

                    Mail::send('payment::mail-templates.invoice', compact('result', 'query'), function($message) use ($query) {
                        $message->to($query->COSTUMER_EMAIL,
                            $query->COSTUMER_NAME)->subject('Invoice');
                    });

                    return view('payment::response.success', compact('result'));
                }
                else
                {
                    return view('payment::response.pending', compact('order_id'));
                }
            }

            else
            {
                // Show confirmation form for non-VA
            }
        }
    }
}