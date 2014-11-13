<?php

class CustomersController extends BaseController {

	public function __construct(){
		$this->beforeFilter(function(){
			$role = ConnectHelper::getCurrentUserRole();
			if ($role == Config::get('connect_variable.merchant')){
				return Redirect::to('merchants/transaction');
			}
			elseif ($role == Config::get('connect_variable.admin')) {
				return Redirect::to('admin/dashboard');
			}
			elseif ($role != Config::get('connect_variable.unverified_user') && $role != Config::get('connect_variable.verified_user')){
				Session::flash('errors', 'Please login first with your account');
				return Redirect::to('/login');
			}
		});
	}

	public function dashboard(){
		$data = array();
		$data['username'] = ConnectHelper::getCurrentUserUsername();
		$data['balance'] = ConnectHelper::getCurrentUserBalance();
		$data['limitBalance'] = ConnectHelper::getCurrentUserLimitBalance();
		$topups = Topup::where('username_customer', $data['username'])->get();
		$transfers = Transfer::where('from_username', $data['username'])->get();
		$purchases = Purchase::where('username_customer', $data['username'])->get();
		return View::make('/customers/dashboard')->with('data',$data)
												 ->with('topups', $topups)
												 ->with('transfers', $transfers)
												 ->with('purchases', $purchases);
	}

	public function reset_password() {
		return View::make('connect_pages/reset-password');
	}

	public function profile(){	
		$data = array();
		$data['username'] = ConnectHelper::getCurrentUserUsername();
		$data['balance'] = ConnectHelper::getCurrentUserBalance();
		$data['limitBalance'] = ConnectHelper::getCurrentUserLimitBalance();
		$data['email'] = ConnectHelper::getCurrentUserEmail();

		return View::make('/customers/profile')->with('data',$data);
	}

	public function logout(){
		Session::flush();
		$params = new stdclass();
		$loginService = new Cyclos\Service('loginService');

		try {
			$loginService->run('logout',array(),true);
			return Redirect::to("/");
		}catch (Cyclos\ConnectionException $e) {
			echo("Cyclos server couldn't be contacted");
			die();
		} catch (Cyclos\ServiceException $e) {
			echo("Error while performing logout: {$e->errorCode}");
		}
		die();
	}

	public function topup(){
		$data = array();
		$data['username'] = ConnectHelper::getCurrentUserUsername();
		$data['balance'] = ConnectHelper::getCurrentUserBalance();
		$data['limitBalance'] = ConnectHelper::getCurrentUserLimitBalance();
		return View::make('/customers/topup')->with('data',$data);
	}

	public function transfer(){	
		$data = array();
		$data['username'] = ConnectHelper::getCurrentUserUsername();
		$data['balance'] = ConnectHelper::getCurrentUserBalance();
		$data['limitBalance'] = ConnectHelper::getCurrentUserLimitBalance();
		if(Request::getMethod()=='GET'){
			return View::make('/customers/transfer')->with('data',$data);
		}else{
			$transactionService = new Cyclos\Service('transactionService');
			$paymentService = new Cyclos\Service('paymentService');

			if (Session::get('cyclos_username') == $_POST['transfer_recipient']){
				Session::flash('errors', 'Couldn\'t transfer to your own account');
				return View::make('customers/transfer')->with('data',$data);			
			}
			try{
				$data = $transactionService->run('getPaymentData',array(array("username"=>Session::get('cyclos_username')),array("username"=> $_POST['transfer_recipient'])),true);
				
				$params = new stdclass();
				$params->from = $data->from;
				$params->to = $data->to;
				$params->type = $data->paymentTypes[0];
				$params->amount = $_POST['transfer_amount'];
				$params->desc = "Transfer from ". $data->from->name. " to ". $data->to->name;

				$paymentResult = $paymentService->run('perform',$params,true);

				$transfer = Transfer::create(array(
					'date_transfer'=>new DateTime, 
					'from_username'=>ConnectHelper::getCurrentUserUsername(),
					'to_username'=>$_POST['transfer_recipient'],
					'amount'=>$_POST['transfer_amount']
				));

				// Mail::send('emails.transfer', array('transfer_recipient' => $_POST['transfer_recipient'],
				// 									'transfer_amount' => $_POST['transfer_amount']), function($message)
				// {
				//     $message->to(ConnectHelper::getCurrentUserEmail(), ConnectHelper::getCurrentUserUsername())->subject('Transfer Success');
				// });

				Session::put('_token', sha1(microtime()));

				return View::make('customers/transfer-success')
					->with('transfer_amount', $_POST['transfer_amount'])
					->with('transfer_recipient', $_POST['transfer_recipient']);
			}catch (Cyclos\ServiceException $e){
				$data = array();
				$data['username'] = ConnectHelper::getCurrentUserUsername();
				$data['balance'] = ConnectHelper::getCurrentUserBalance();
				$data['limitBalance'] = ConnectHelper::getCurrentUserLimitBalance();
				switch ($e->errorCode) {
					case 'VALIDATION':
						Session::flash('errors', 'Please input the correct recipient and amount');
						return View::make('customers/transfer')->with('data',$data);
						break;
					case 'ENTITY_NOT_FOUND':
						Session::flash('errors', 'Invalid User Recipient');
						return View::make('customers/transfer')->with('data',$data);
						break;
					case 'INSUFFICIENT_BALANCE':
						Session::flash('errors', 'Insufficient Balance');
						return View::make('customers/transfer')->with('data',$data);
						break;
					case 'DATA_ACCESS':
						Session::flash('errors', 'Transfer Overload');
						return View::make('customers/transfer')->with('data',$data);
						break;
					case 'INVALID_PARAMETER':
						Session::flash('errors', 'Invalid Transfer Amount');
						return View::make('customers/transfer')->with('data',$data);
						break;
					default:
						var_dump($e->errorCode);
						break;
				}
			}
		}
	}

	public function purchase(){	

		$data = array();
		$data['username'] = ConnectHelper::getCurrentUserUsername();
		$data['balance'] = ConnectHelper::getCurrentUserBalance();
		$data['limitBalance'] = ConnectHelper::getCurrentUserLimitBalance();
		
		$userService = new Cyclos\Service('userService');

		// Getting account role
		$usersResult = $userService->run('getUserRegistrationGroups',array(),false);
		$roleId = array();
		foreach($usersResult as $group){
			$roleId[$group->name] = $group->id;
		}

		// Getting merchant
		$params = new stdclass();
		$params->groups = new stdclass();
		$params->groups->id = $roleId[Config::get('connect_variable.merchant')];
		$params->pageSize = PHP_INT_MAX;
		$merchantsResult = $userService->run('search',$params,false);

		$merchants = $merchantsResult->pageItems;
		$product_merchant = '';
		// Getting merchant attributes
		foreach($merchants as $merchant){
			// Getting merchant email
			$params = new stdclass();
			$params->id = $merchant->id;
			$result = $userService->run('getViewProfileData',$params,false);
			$merchant->email = $result->email;

			if($merchant->username == Input::get('merchant')){
				$product_merchant = $merchant->username;
			}

			if(!Input::get('merchant')){
				break;
			}
		}
		//$products = DB::table('product')->where('merchant_name',$product_merchant)->get();
		$products = Product::where('merchant_name', '=', $product_merchant)->get();

		return View::make('/customers/purchase')->with('data',$data)
												->with('merchants', $merchants)
												->with('products', $products);

	}

	public function increase_limit(){
		if (Request::isMethod('GET')){
			$data = array();
			$data['username'] = ConnectHelper::getCurrentUserUsername();
			$data['balance'] = ConnectHelper::getCurrentUserBalance();
			$data['limitBalance'] = ConnectHelper::getCurrentUserLimitBalance();
			$increase_limit = IncreaseLimit::where('username_customer', '=', $data['username'])->first();
			if ($increase_limit == null || $increase_limit->status == "denied"){
				return View::make('/customers/increase-limit')->with('data',$data);	
			}
			else{
				return View::make('/customers/increase-limit-done');
			}
		}
		elseif (Request::isMethod('POST')){
			if (Input::get('current_address') == ""){
				$current_address = Input::get('id_address');
			}else{
				$current_address = Input::get('current_address');
			}

			$increaseLimit = IncreaseLimit::where('username_customer','=',ConnectHelper::getCurrentUserUsername())->first();
			//If exist validate accepted and update if not accepted. If not exist, create
			if($increaseLimit != null){
				if($increaseLimit->status == 'denied'){
					$increaseLimit->date_increase_limit = new DateTime;
					$increaseLimit->full_name = Input::get('full_name');
					$increaseLimit->id_type = Input::get('id_type');
					$increaseLimit->id_number = Input::get('id_number');
					$increaseLimit->gender  = Input::get('gender');
					$increaseLimit->birth_place = Input::get('birth_place');
					$increaseLimit->birth_date = Input::get('birth_date');
					$increaseLimit->id_address = Input::get('id_address');
					$increaseLimit->current_address = $current_address;
					$increaseLimit->username_customer = ConnectHelper::getCurrentUserUsername();
					$increaseLimit->status = 'in process';
				}else{
					return Redirect::to('/customers/dashboard');
				}
			}else{
				IncreaseLimit::create(array(
					'date_increase_limit' => new DateTime,
					'full_name' => Input::get('full_name'),
					'id_type' => Input::get('id_type'),
					'id_number' => Input::get('id_number'),
					'gender' => Input::get('gender'),
					'birth_place' => Input::get('birth_place'),
					'birth_date' => Input::get('birth_date'),
					'id_address'=> Input::get('id_address'),
					'current_address' => $current_address,
					'username_customer' => ConnectHelper::getCurrentUserUsername(),
					'status' => 'in process'
				));
				Session::put('_token', sha1(microtime()));
			}
		}
	}

	public function getUploadForm() {
        return View::make('image/upload-form');
    }

	public function upload() {
		$rules = array('image' => 'image|required|max:1600');
		
		$messages = array(
			'image' 	=> 'The image must in jpeg, png, bmp, gif, or jpg format.',
			'required' => 'Please upload file with maximum size 1500kb'
		);

		// doing the validation, passing post data, rules and the messages
		$validator = Validator::make(Input::all(), $rules, $messages);

		if ($validator->fails()) {
			// send back to the page with the input data and errors
			return Response::json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);
		}
		else {
			$filename = ConnectHelper::getCurrentUserUsername();
			// checking file is valid.
			if (Input::file('image')->isValid()) {
				Image::make(Input::file('image'))->resize(400, 250)->save('app/storage/uploads/'.$filename.'.jpg');
				$data = (string) Image::make('app/storage/uploads/'.$filename.'.jpg')->encode('data-url');
				Session::flash('success', 'Upload successfully');

				return Response::json(['success' => true, 'file' => $data]);
				//return View::make('customers/increase-limit-success');
			}
			else {
				// sending back with error message.
				Session::flash('error', 'uploaded file is not valid');
				return Redirect::to('customers/increase-limit#upload-id-card');
			}
		}
	}

	public function download_csv() {
		$data['username'] = ConnectHelper::getCurrentUserUsername();
		$transaction_type = Input::get('transaction_type');

		if ($transaction_type == 'topup'){
			$topups_data = Topup::where('username_customer', '=', ConnectHelper::getCurrentUserUsername())->get();
			$filename = 'Topup_Data_'.$data['username'].'.csv';
			$fp = fopen($filename, 'w');
			$topup_header= array("topup_id", "date_time", "status", "amount", "permata_va_number", "username_customer");
			fputcsv($fp, $topup_header);
	        foreach( $topups_data as $topup ) {
	        	$topup_array = $topup->toArray();
	            fputcsv($fp, $topup_array);
        	}
		} elseif ($transaction_type == 'transfer'){
			$transfers_data = Transfer::where('from_username', '=', ConnectHelper::getCurrentUserUsername())->get();
			$filename = 'Transfer_Data_'.$data['username'].'.csv';
			$fp = fopen($filename, 'w');
			$transfer_header= array("transfer_id", "date_time", "from_username", "to_username", "amount");
			fputcsv($fp, $transfer_header);
	        foreach( $transfers_data as $transfer ) {
	        	$transfer_array = $transfer->toArray();
	            fputcsv($fp, $transfer_array);
	        }
		} elseif ($transaction_type == 'purchase'){
			$purchases_data = Purchase::where('username_customer', '=', ConnectHelper::getCurrentUserUsername())->get();
			$filename = 'Purchase_Data_'.$data['username'].'.csv';
			$fp = fopen($filename, 'w');	
			$purchase_header= array("purchase_id", "date_purchase", "username_customer", "status", "total");
			fputcsv($fp, $purchase_header);
	        foreach( $purchases_data as $purchase ) {
	        	$purchase_array = $purchase->toArray();
	        	array_push($purchase_array, $purchase->total());
	            fputcsv($fp, $purchase_array);
	        }
		}
		fclose($fp);

		App::finish(function($request, $response) use ($filename)
	    {
	        unlink($filename);
	    });

        return Response::download($filename);
	}

	public function validate_registration_form(){
		$rules = array(
			'username'             	=> 'required',
			'email'            		=> 'required|email',
			'password'         		=> 'required',
			'password_confirmation' => 'required|same:password'
		);

		$messages = array(
			'same' 	=> 'The :others must matched.'
		);

		$validator = Validator::make(Input::all(), $rules, $messages);

		if ($validator->fails()) {
			return View::make('customers/register')
				->withErrors($validator)
				->withInput(Input::except('password', 'password_confirmation'));
		} else {
			return $this->register();
		}

	}

	public function validate_login_form(){
		$rules = array(
			'email'            		=> 'required|email',
			'password'         		=> 'required'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('/login')
				->withErrors($validator);
		} else {
			return Redirect::to('customers/dashboard');
		}
	}

	public function validate_topup_form(){
		$data['username'] = ConnectHelper::getCurrentUserUsername();
		$data['balance'] = ConnectHelper::getCurrentUserBalance();
		$data['limitBalance'] = ConnectHelper::getCurrentUserLimitBalance();
		$pending_topups = Topup::where('status', '=', 'pending')->where('username_customer', '=', $data['username'])->get()->toArray();

		if ($pending_topups != null){
			return Redirect::to('/customers/topup')
				->withErrors(array('topup_amount' => 'You have pending Top Up status, please confirm the payment first.'));
		}else{
			$max = $data['limitBalance'] - $data['balance'];

			$rules = array(
				'topup_amount'     	=> 'required|numeric|max:'.$max
			);

			$messages = array(
				'max' => 'The :attribute must not be greater than your limit balance (Maximum Top-Up allowed : Rp '.number_format($max, 2, ',', '.').')'
			);

			$validator = Validator::make(Input::all(), $rules, $messages);

			if ($validator->fails()) {
				return Redirect::to('/customers/topup')
					->withErrors($validator);
			} else {
				$topup = Topup::create(array(
					'date_topup'=>new DateTime, 
					'status'=>'',
					'amount'=>Input::get('topup_amount'),
					'permata_va_number'=>'',
					'username_customer'=>ConnectHelper::getCurrentUserUsername()
				));
				$response = PaymentAPI::charge_topup($topup->id, Input::get('topup_amount'));
				$topup->date_topup = new DateTime;
				$topup->status = $response->transaction_status;
				$topup->permata_va_number = $response->permata_va_number;
				$topup->save();

				// $email_customer = ConnectHelper::getUserEmail(ConnectHelper::getCurrentUserUsername());
				// Mail::send('emails.topup_request', array('permata_va_number' => $response->permata_va_number), function($message)
				// {
				// 	$message->from('connect_cs@connect.co.id', 'Connect');
				//     $message->to(ConnectHelper::getCurrentUserEmail(), ConnectHelper::getCurrentUserUsername())->subject('Top Up Request');
				// });

				return View::make('customers/topup-success')->with('va_number',$response->permata_va_number);
			}	
		}
	}

	public function validate_close_account_form(){
		$rules = array(
			'account_bank'		 => 'required',
			'account_number'     => 'required|numeric',
			'account_name'     	 => 'required'	
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('/customers/profile#close-account')
				->withErrors($validator);
		} else {
			//Getting request close account groups
			$userService = new Cyclos\Service('userService');
			$userGroupService = new Cyclos\Service('userGroupService');
			try{
				$result = $userService->run("getUserRegistrationGroups",array(),false);
				$id;
				foreach($result as $res){
					if($res->name == Config::get('connect_variable.request_close_account_user')){
						$id = $res->id;
					}
				}
				// Change the group
				$params = new stdclass();
				$params->group = new stdclass();
				$params->group->id = $id;

				$params->user = new stdclass();
				$params->user->id = Session::get('cyclos_id');

				$redeem = Redeem::create(array(
					'date_redeem'=>new DateTime,
					'amount'=> ConnectHelper::getCurrentUserBalance(),
					'bank_account_name_receiver'=>Input::get('account_name'),
					'bank_account_number_receiver'=>Input::get('account_number'),
					'bank_name'=> Input::get('account_bank'),
					'username_customer'=>ConnectHelper::getCurrentUserUsername(),
					'redeemed' => 'false'
				));

				$result = $userGroupService->run('changeGroup',$params,false);
				Session::flush();

				Session::put('_token', sha1(microtime()));
				
				return View::make('customers/close-account-success');

			}catch(Exception $e){
				Session::flash('errors_cyclos','There are some trouble, please try again later');
				return Redirect::to('/customers/profile#close-account');
			}
		}
	}

	public function validate_change_password_form(){

		$passwordService = new Cyclos\Service('passwordService');
		$result = $passwordService->run('getChangePasswordData',array(),true);

		$changePasswordDTO = $result->changePassword;
		$changePasswordDTO->oldPassword = Input::get('current_password');
		$changePasswordDTO->newPassword = Input::get('password');
		$changePasswordDTO->confirmNewPassword = Input::get('password_confirmation');

		try{
			$passwordService->run('change',$changePasswordDTO,true);
			Session::put('_token', sha1(microtime()));
			return View::make('customers/change-password-success');
		}catch(Cyclos\ServiceException $e){
			if($e->error->errorCode == 'VALIDATION'){
				if(isset($e->error->validation->propertyErrors->confirmNewPassword)){
					Session::flash('error_password_confirmation','invalid password confirmation');
				}
				if(isset($e->error->validation->propertyErrors->newPassword)){
					Session::flash('error_password_new',$e->error->validation->propertyErrors->newPassword[0]);
				}
				if(isset($e->error->validation->propertyErrors->oldPassword)){
					Session::flash('error_password_current','current password is empty');
				}
			}elseif($e->error->errorCode == 'INVALID_PASSWORD'){
				Session::flash('error_current_password','Invalid Password');
			}
			return Redirect::to('/customers/profile#change-password');
		}
	}

	public function validate_user_information_form(){
		$rules = array(
			'full_name'	 		=> 'required',
			'id_type'     		=> 'required',
			'id_number'	 		=> 'required',
			'gender'     		=> 'required',
			'birth_place'		=> 'required',
			'birth_date'		=> 'required',
			'id_address'		=> 'required'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('/customers/increase-limit#user-information')
				->withErrors($validator);
		} else {
			$form_input = Input::all();
			return Redirect::to('customers/increase-limit#upload-id-card')
					->with('form_input',$form_input);
		}
	}

	public function purchase_products(){

		DB::beginTransaction();

		$products_purchased = Input::json()->get('shoppingCart');
		
		//Validate shopping cart
		if(count($products_purchased) == 0 || count($products_purchased) > 5){
			return Response::json(array('status' => 'failed' ,'message' => 'Invalid quantity'));
		}

		//Quantity validator
		foreach($products_purchased as $product){
			if($product['quantity'] <= 0){
				return Response::json(array('status' => 'failed' ,'message' => 'invalid amount'));
			}
		}


		//Make a purchase
		$purchase = Purchase::create(array(
			'date_purchase' => new DateTime,
			'username_customer' => ConnectHelper::getCurrentUserUsername(),
			'status' => 'success'
		));

		$sum = 0;
		$message = '';
		$status = '';
		//$transaction = new Transaction;
		foreach($products_purchased as $product){

			//Check if exist in db and merchant's
			$db_product = Product::where('id',$product['id'])->where('merchant_name',Input::json()->get('merchant_username'))->first();
			$sum += $db_product->price * $product['quantity'];
			$purchase->product()->attach($product['id'],array('quantity'=>$product['quantity']));
		}

		//Transferring balance from cyclos
		try{
			$transactionService = new Cyclos\Service('transactionService');
			$paymentService = new Cyclos\Service('paymentService');

			$data = $transactionService->run('getPaymentData',array(array("username"=>ConnectHelper::getCurrentUserUsername()),array("username"=> Input::json()->get('merchant_username'))),true);
			
			$params = new stdclass();
			$params->from = $data->from;
			$params->to = $data->to;
			$params->type = $data->paymentTypes[0];
			$params->amount = $sum;
			$params->desc = "Transaction for buying product, purchase id : " + $purchase->id;

			$paymentResult = $paymentService->run('perform',$params,true);

			DB::commit();
			$status = 'success';
			Session::put('_token', sha1(microtime()));

			//Sending notification


		 	$message = View::make('/customers/purchase-success')->render();
		}catch (Cyclos\ServiceException $e){
			$status = 'failed';
			if($e->errorCode =="INSUFFICIENT_BALANCE"){
				$message = 'Insufficient Balance';
			}else{
				$message = 'Sorry, there are some errors with the system';
			}
		}finally{
			return Response::json(array('status' => $status ,'message' => $message));
		}
		

	}
}
