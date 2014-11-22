<?php
include_once('veritrans-php/Veritrans.php');

class PaymentAPI {

	public static function charge_topup($topup_id, $topup_amount){

		$transaction_details = array(
			'order_id' => 'TUID234'.$topup_id,
			'gross_amount' => $topup_amount
		);

		$customer_details = array(
		    'first_name'    => "Danny",
    		'last_name'     => "Pranoto",
    		'email'         => "noreply@veritrans.co.id",
    		'phone'         => "08123456789"	
		);

		$transaction_data = array(
  			'payment_type' => 'bank_transfer',
  			'bank_transfer' => array(
      			'bank' => "permata"
    		),
  			'transaction_details' => $transaction_details,
  			'customer_details' => $customer_details
  		);
		Veritrans_Config::$serverKey = '6d7ccd71-ea52-43cc-ac42-5402077bd6c6';
		Veritrans_Config::$isProduction = false;
		
  		$response = Veritrans_VtDirect::charge($transaction_data);
  		return $response;	
	}

	public static function update_status($topup_id){
		Veritrans_Config::$serverKey = '6d7ccd71-ea52-43cc-ac42-5402077bd6c6';
		Veritrans_Config::$isProduction = false;
		return Veritrans_Transaction::status($topup_id);
	}

}	

?>