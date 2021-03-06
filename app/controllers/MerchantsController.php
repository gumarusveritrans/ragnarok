<?php

class MerchantsController extends BaseController {

	public function __construct(){
		$this->beforeFilter(function(){
			$role = ConnectHelper::getCurrentUserRole();
			if ($role == Config::get('connect_variable.unverified_user') || $role == Config::get('connect_variable.verified_user')){
				return Redirect::to('customers/dashboard');
			}
			elseif ($role == Config::get('connect_variable.admin')){
				return Redirect::to('admin/dashboard');
			}
			elseif ($role != Config::get('connect_variable.merchant')){
				if (Request::path() != 'merchants/login'){
					Session::flash('errors', 'Please login first with your account');
					return Redirect::to('merchants/login');
				}
			}
		});	
	}

	public function login(){
		
		if(Session::get('cyclos_group') == Config::get('connect_variable.merchant')){
			return Redirect::to('/merchants/transaction');
		}
		else{
			if(Request::getMethod()=='GET'){
				return View::make('/merchants/login');	
			}
			elseif(Request::getMethod()=='POST'){
				$loginService = new Cyclos\Service('loginService');

				// Set the parameters
				$params = new stdclass();
				$params->user = array('username' => $_POST['username']);
				$params->password = $_POST['password'];
				$params->remoteAddress = $_SERVER['REMOTE_ADDR'];

				// Perform the login
				try {
					$result = $loginService->run('loginUser',$params,false);

					//print_r($result);
					Session::put('cyclos_session_token',$result->sessionToken);
					Session::put('cyclos_username',$params->user['username']);
					Session::put('cyclos_remote_address',$params->remoteAddress);
						
					//Getting the group name
					$params = new stdclass();
					$params->id = $result->user->id;

					$userService = new Cyclos\Service('userService');
					$result = $userService->run('getViewProfileData',$params,false);

					if($result->group->name != Config::get('connect_variable.merchant')){
						Session::flush();
						Session::flash('errors', 'Invalid username/password');
						return View::make('merchants/login');
					}

					Session::put('cyclos_group',$result->group->name);
					Session::put('cyclos_email',$result->email);
					return Redirect::to('/merchants/transaction');
				} catch (Cyclos\ConnectionException $e) {
					echo("Cyclos server couldn't be contacted");
					die();
				} catch (Cyclos\ServiceException $e) {
					switch ($e->errorCode) {
						case 'VALIDATION':
							Session::flash('errors', 'Missing username/password');
							return View::make('merchants/login');
							break;
						case 'LOGIN':
							Session::flash('errors', 'Invalid username/password');
							return View::make('merchants/login');
							break;
						case 'REMOTE_ADDRESS_BLOCKED':
							Session::flash('errors', 'Your access is blocked by exceeding invalid login attempts');
							return View::make('merchants/login');
							break;
						default:
							Session::flash('errors', 'Error while performing login: {$e->errorCode}');
							return View::make('merchants/login');
							break;
					}
					Session::flush();
					die();
				}
			}
		}
	}

	public function logout(){
		Session::flush();
		$params = new stdclass();
		$loginService = new Cyclos\Service('loginService');
		try {
			$loginService->run('logout',array(),true);
			return Redirect::to("/merchants/login");
		}catch (Cyclos\ConnectionException $e) {
			echo("Cyclos server couldn't be contacted");
			die();
		} catch (Cyclos\ServiceException $e) {
			echo("Error while performing logout: {$e->errorCode}");
		}
		die();
	}

	public function transaction(){
		$data['balance'] = ConnectHelper::getCurrentUserBalance();
		$purchases = Purchase::whereHas('product', function($p)
		{
			$merchant_name = ConnectHelper::getCurrentUserUsername();
		    $p->where('merchant_name', '=', $merchant_name);
		})->get();

		//Checking if customers already closed
		foreach($purchases as $purchase){
			if(ConnectHelper::getUserRole($purchase->username_customer) == Config::get('connect_variable.request_close_account_user') || ConnectHelper::getUserRole($purchase->username_customer) == Config::get('connect_variable.closed_user_account')){
				$purchase->closed = true;
			}
		}

		return View::make('/merchants/transaction')
			 ->with('purchases', $purchases)
			 ->with('data', $data);
	}

	public function reject_purchase(){
		$transaction_id = Input::get('purchaseId');
		$purchase = Purchase::where('id','=',$transaction_id)->first();

		$purchase_merchant_username = $purchase->product()->first()->merchant_name;

		//Validate merchant username
		if($purchase_merchant_username!=ConnectHelper::getCurrentUserUsername()){
			return Redirect::to('/merchants/transaction');
		}

		//Validate status
		if($purchase->status == 'rejected'){
			return Redirect::to('/merchants/transaction')->with('errors','Transaction already rejected');
		}		

		//Refunding account
		DB::beginTransaction();

		$purchase->status = 'rejected';
		$purchase->save();

		//Refunding cyclos
		$transactionService = new Cyclos\Service('transactionService');
		$paymentService = new Cyclos\Service('paymentService');

		$data = $transactionService->run('getPaymentData',array(array("username"=>ConnectHelper::getCurrentUserUsername()),array("username"=> $purchase->username_customer)),true);
		
		$params = new stdclass();
		$params->from = $data->from;
		$params->to = $data->to;
		$params->type = $data->paymentTypes[0];
		$params->amount = $purchase->total();
		$params->desc = "Cancelling purchase id : " + $purchase->id;

		$paymentResult = $paymentService->run('perform',$params,true);

		DB::commit();

		$messageData = array (
			'to' => ConnectHelper::getUserEmail($purchase->username_customer)
		);

		Mail::send('emails.reject_purchase', array('purchase_id' => $purchase->id,
													), function($message) use ($messageData)
		{
			$message->from('connect_cs@connect.co.id', 'Connect');
		    $message->to($messageData['to'], ConnectHelper::getCurrentUserUsername())->subject('Transfer Success');
		});

		return Redirect::to('/merchants/transaction');

	}

	public function list_products(){
		$data = array();
		$data['username'] = ConnectHelper::getCurrentUserUsername();
		$data['balance'] = ConnectHelper::getCurrentUserBalance();

		$products = Product::where('merchant_name', '=', $data['username'])->get();
		return View::make('/merchants/list-products')
			->with('products', $products)
			->with('data', $data);
	}

	public function download_csv() {

		$purchases_data = Purchase::all();
		$filename = 'Purchase_Data.csv';
		$fp = fopen($filename, 'w');	
		$purchase_header= array("purchase_id", "date_purchase", "username_customer", "status", "total");
		fputcsv($fp, $purchase_header);
        foreach( $purchases_data as $purchase ) {
        	$purchase_array = $purchase->toArray();
        	array_push($purchase_array, $purchase->total());
            fputcsv($fp, $purchase_array);
        }

		fclose($fp);

		App::finish(function($request, $response) use ($filename)
	    {
	        unlink($filename);
	    });

        return Response::download($filename);
	}

}