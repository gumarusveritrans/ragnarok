<?php
include_once('Veritrans.php');
use Vinelab\Http\Client as HttpClient;

class PaymentAPI {


	public static function charge_topup(){
		$server_key = '6d7ccd71-ea52-43cc-ac42-5402077bd6c6';
		$papi_url = 'https://api.sandbox.veritrans.co.id/v2/charge';

		$transaction_details = array(
			'order_id' => '123123123',
			'gross_amount' => 10
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



  		$client = new HttpClient;
  		$request = [
        	'url' => $papi_url,
        	'headers' => [
				'Authorization' =>  'Basic ' + base64_encode($server_key),
        		'Accept' => 'application/json',
        		'Content-Type' => 'application/json'
        	],
        	'json' => json_encode($transaction_data)
    	];
  		
  		$response = $client->get($request);
		var_dump($response->json());
  		return $response->json();	
	}

}	

?>