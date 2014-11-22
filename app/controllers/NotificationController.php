<?php

class NotificationController extends BaseController {

	public function getMessage(){
		// if (Request::getClientIp() == ''){
			$response = Input::all();
			if($response['transaction_status'] == 'settlement'){
				DB::beginTransaction();
				$pending_topup = DB::table('topup')->where('id', substr($response['order_id'],7))->get();
				$pending_topup = $pending_topup[0];
				// PAY TO USER
				//GETTING TRANSFER TYPE
				$transactionService = new Cyclos\Service('transactionService');
				$to = new stdclass();
				$to->username = $pending_topup->username_customer;
				$result = $transactionService->run('getPaymentData',array("SYSTEM",$to),false);

				//TRANSFERRING TO USER
			    DB::table('topup')	->where('id', $pending_topup->id)->update(array('status' => 'success'));
				$paymentService = new Cyclos\Service('paymentService');
				
				$parameters = new stdclass();
				$parameters->from = $result->from;
			    $parameters->to = $result->to;
			    $parameters->type = $result->paymentTypes[0];
			    $parameters->amount = $response['gross_amount'];
			    $parameters->description = "Topup for veritrans transaction id " . $response['transaction_id'];
			    
			    $paymentResult = $paymentService->run('perform',$parameters,false);
				DB::commit();
				

				Mail::send('emails.topup', array('topup_amount' => $response['gross_amount']), function($message) use($pending_topup)
				{
				    $message->to(ConnectHelper::getUserEmail($pending_topup->username_customer), $pending_topup->username_customer)->subject('Top-Up Success');
				});
			}
			return Response::make("Message Received", 200);
		// }
		// else{

		// }
	}

}