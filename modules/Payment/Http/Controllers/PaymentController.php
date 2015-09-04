<?php namespace Modules\Payment\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
require_once base_path().'/vendor/veritrans/veritrans-php/Veritrans.php'; 
use Input;
use Redirect;


class PaymentController extends Controller {
	
	public function index()
	{
		return view('payment::index');
	}
	
}