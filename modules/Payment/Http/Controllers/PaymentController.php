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
	protected $data_type;

	public function index()
	{
        if(Session::has('DATA_RENT'))
        {
            $this->data_type = 'DATA_RENT';
        }
        else if(Session::has('DATA_TRAVEL'))
        {
            $this->data_type = 'DATA_TRAVEL';
        }

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
            $status_code = $this->payWithCreditCard();
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
}