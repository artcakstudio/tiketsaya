<?php namespace Modules\Payment\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
require_once base_path().'/vendor/veritrans/veritrans-php/Veritrans.php'; 
use Input;
use Redirect;
use Session;
use Mail;

class PaymentController extends Controller {
	
	protected $transaction_details;
	protected $token_id;
	
	public function index()
	{
		$gross_amount = Session::get('DATA_COSTUMER')['TRAVEL_TRANSACTION_PRICE'];
		return view('payment::index', compact('gross_amount'));
	}
	
	public function checkout()
	{
		\Veritrans_Config::$serverKey = "VT-server-vcxip7_cFu7fcbymYowGQa9Y";
        \Veritrans_Config::$isProduction = false;
        
        $transaction_details = array(
            'order_id' => Session::get('NO_PEMESANAN'),
            'gross_amount' => Session::get('DATA_COSTUMER')['TRAVEL_TRANSACTION_PRICE']
            );
            
        $input = Input::except('_token');
        $payment_method = $input['payment_method'];
        
        $this->transaction_details = $transaction_details;
        
        if($payment_method == "credit_card")
        {
            $this->token_id = $input['token-id'];
            $this->payWithCreditCard();
        }
        
        else if($payment_method == "bank_transfer")
        {
            $this->payWithBankTransfer();
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
            Mail::send('payment::mail-templates.invoice', array(), function($message) {
                $message->to(Session::get('DATA_COSTUMER')['COSTUMER_EMAIL'],
                    Session::get('DATA_COSTUMER')['COSTUMER_NAME'])->subject('Invoice');
            });

            // kirim e-tiket
            Mail::send('payment::mail-templates.tiket', array(), function($message) {
                $message->to(Session::get('DATA_COSTUMER')['COSTUMER_EMAIL'],
                    Session::get('DATA_COSTUMER')['COSTUMER_NAME'])->subject('E-Tiket');
            });

            return view('payment::response.success', compact('result'));

        }
        else if($result->status_code == "202")
        {
            //deny
            return view('payment::response.fail', compact('result'));
        }
        else if($result->status_code == "201")
        {
            //challenge
            return view('payment::response.success', compact('result'));
        }
        else
        {
            //error
            echo "Error occurred on the sent transaction data.<br />";
            echo "<h3>Result:</h3>";
            var_dump($result);
        }
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
          echo "<b>Bank Transfer</b> <br /><br />";
          echo "<b>Please complete payment with transfer method to this Permata bank virtual account number:</b> ".$result->permata_va_number;
          echo "<br /><br />";
          echo "<Transfer amounts:".$this->transaction_details['gross_amount'];
          echo "<br>";
          echo "1. You have 24 hours to complete payment before this transaction expired <br />";
          echo "2. If you need help, please contact 021-22334456";
        
        } 
        else 
        {
          //error
          echo "Have error on transaction.<br />";
          echo "<h3>Result:</h3>";
          var_dump($result);
        }
    }
}