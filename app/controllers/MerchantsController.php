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

		if(Request::getMethod()=='GET'){
			return View::make('/merchants/login');	
		}
		else if(Request::getMethod()=='POST'){
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
						//return View::make('customers/login')->with('errors', 'Invalid Username/Password');
						Session::flash('errors', 'Invalid username/password');
						return View::make('merchants/login');
						break;
					case 'REMOTE_ADDRESS_BLOCKED':
						//return View::make('customers/login')->with('errors', 'Your access is blocked by exceeding invalid login attempts');
						Session::flash('errors', 'Your access is blocked by exceeding invalid login attempts');
						return View::make('merchants/login');
						break;
					default:
						//return View::make('customers/login')->with('errors', 'Error while performing login: {$e->errorCode}');
						Session::flash('errors', 'Error while performing login: {$e->errorCode}');
						return View::make('merchants/login');
						break;
				}
				Session::flush();
				die();
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
		$merchant_name = ConnectHelper::getCurrentUserUsername();
		$products = Product::where('merchant_name', '=', $merchant_name)->get();
		$purchases = array();
		$total = array();
		if ($products->count() != 0){
			foreach ($products as $product){
				if ($product->transaction != null){
					array_push($purchases, $product->transaction);
				}
			}		
		}
		if ($purchases != null){
			foreach($purchases as $purchase){
				foreach($purchase->product as $product){
					$total = $total + ($product->pivot->quantity * $product->price);
				}
			}		
		}

		return View::make('/merchants/transaction')
			->with('purchases', $purchases)
			->with('total', $total);
	}

	public function list_products(){
		$data = array();
		$data['username'] = ConnectHelper::getCurrentUserUsername();
		$data['balance'] = ConnectHelper::getCurrentUserBalance();

		$products = Product::where('merchant_name', '=', $data['username'])->get();
		return View::make('/merchants/list-products')->with('products', $products);
	}

	public function download_csv() {

		$purchases_data = Purchase::all();
		$filename = 'Purchase_Data.csv';
		$fp = fopen($filename, 'w');	
		$purchase_header= array("purchase_id", "date_time", "status", "amount", "permata_va_number", "username_customer");
		fputcsv($fp, $purchase_header);
        foreach( $purchases_data as $purchase ) {
        	$purchase_array = $purchase->toArray();
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