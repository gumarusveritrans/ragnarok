<?php

class CustomersController extends BaseController {

	public function dashboard(){
		$data = array();
		$data['username'] = ConnectHelper::getCurrentUserUsername();
		$data['balance'] = ConnectHelper::getCurrentUserBalance();
		$data['limitBalance'] = ConnectHelper::getCurrentUserLimitBalance();
		$topups = DB::table('topup')->where('username_customer', $data['username'])->get();
		$transfers = DB::table('transfer')->where('from_username', $data['username'])->get();
		return View::make('/customers/dashboard')->with('data',$data)
												 ->with('topups', $topups)
												 ->with('transfers', $transfers);
	}

	public function profile(){	
		$data = array();
		$data['username'] = ConnectHelper::getCurrentUserUsername();
		$data['balance'] = ConnectHelper::getCurrentUserBalance();
		$data['limitBalance'] = ConnectHelper::getCurrentUserLimitBalance();
		$data['email'] = ConnectHelper::getCurrentUserEmail();

		return View::make('/customers/profile')->with('data',$data);
	}

	public function login(){
		if(Session::get('cyclos_group') == Config::get("connect_variable.unverified_user") || Session::get('cyclos_group') == Config::get("connect_variable.verified_user")){
			return Redirect::to('/');
		}
		if(Request::getMethod()=='GET'){
			return View::make('/customers/login');	
		}else if(Request::getMethod()=='POST'){
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
				Session::put('cyclos_id',$result->user->id);

				//GETTING THE GROUP NAME
				$params = new stdclass();
				$params->id = $result->user->id;

				$userService = new Cyclos\Service('userService');
				$result = $userService->run('getViewProfileData',$params,false);

				if($result->group->name != Config::get('connect_variable.unverified_user') && $result->group->name != Config::get('connect_variable.verified_user')){
					Session::flush();
					Session::flash('errors', 'Invalid username/password');
					return View::make('customers/login');
				}

				Session::put('cyclos_group',$result->group->name);
				Session::put('cyclos_email',$result->email);

				return Redirect::to('/customers/dashboard');
			} catch (Cyclos\ConnectionException $e) {
				echo("Cyclos server couldn't be contacted");
				die();
			} catch (Cyclos\ServiceException $e) {
				switch ($e->errorCode) {
					case 'VALIDATION':
						Session::flash('errors', 'Missing username/password');
						return View::make('customers/login');
						break;
					case 'LOGIN':
						//return View::make('customers/login')->with('errors', 'Invalid Username/Password');
						Session::flash('errors', 'Invalid username/password');
						return View::make('customers/login');
						break;
					case 'REMOTE_ADDRESS_BLOCKED':
						//return View::make('customers/login')->with('errors', 'Your access is blocked by exceeding invalid login attempts');
						Session::flash('errors', 'Your access is blocked by exceeding invalid login attempts');
						return View::make('customers/login');
						break;
					default:
						//return View::make('customers/login')->with('errors', 'Error while performing login: {$e->errorCode}');
						Session::flash('errors', 'Error while performing login: {$e->errorCode}');
						return View::make('customers/login');
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
			return Redirect::to("/");
		}catch (Cyclos\ConnectionException $e) {
			echo("Cyclos server couldn't be contacted");
			die();
		} catch (Cyclos\ServiceException $e) {
			echo("Error while performing logout: {$e->errorCode}");
		}
		die();
	}

	public function register(){	
		//KICK LOGINED USER
		if(Session::get('cyclos_session_token') != null){
			return Redirect::to('/');
		}
		
		if(Request::getMethod()=='GET'){
			return View::make('/customers/register');	
		}else if(Request::getMethod()=='POST'){
			$userService = new Cyclos\Service('userService');

			try{
				$result = $userService->run("getUserRegistrationGroups",array(),false);
				
				$id;

				foreach($result as $res){
					if($res->name == Config::get('connect_variable.unverified_user')){
						$id = $res->id;
					}
				}

				$params = new stdclass();
				$params->group = new stdclass();
				$params->group->id = $id;

				$params->username = $_POST['username'];
				$params->email = $_POST['email'];
				$params->name = $_POST['username'];


				$userService->run('register',$params,false);
				return View::make('customers/register-success');
			}catch (Cyclos\ServiceException $e){
				if($e->errorCode == "VALIDATION"){
					$errors = "";
					foreach($e->error->validation->propertyErrors as $error){
						$errors = $errors . $error[0] . "\n";
					}
					Session::flash('errors',$errors);
					return View::make('/customers/register');	
					
				}else{
					Session::flash('errors',$e->errorCode);
					return View::make('/customers/register');
				}
			}
		}
	}

	public function topup(){
		$data = array();
		$data['username'] = ConnectHelper::getCurrentUserUsername();
		$data['balance'] = ConnectHelper::getCurrentUserBalance();
		$data['limitBalance'] = ConnectHelper::getCurrentUserLimitBalance();
		return View::make('/customers/topup')->with('data',$data);
	}

	public function transfer(){	
		if(Request::getMethod()=='GET'){
			$data = array();
			$data['username'] = ConnectHelper::getCurrentUserUsername();
			$data['balance'] = ConnectHelper::getCurrentUserBalance();
			$data['limitBalance'] = ConnectHelper::getCurrentUserLimitBalance();
			return View::make('/customers/transfer')->with('data',$data);;
		}else{
			$transactionService = new Cyclos\Service('transactionService');
			$paymentService = new Cyclos\Service('paymentService');

			if (Session::get('cyclos_username') == $_POST['transfer_recipient']){
				Session::flash('errors', 'Couldn\'t transfer to your own account');
				return View::make('customers/transfer');			
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

				Mail::send('emails.transfer', array('transfer_recipient' => $_POST['transfer_recipient'],
													'transfer_amount' => $_POST['transfer_amount']), function($message)
				{
					$message->from('connect_cs@connect.co.id', 'Connect');
				    $message->to('danny.pranoto@veritrans.co.id', 'Danny Pranoto')->subject('Transfer Success');
				});

				return View::make('customers/transfer-success')
					->with('transfer_amount', $_POST['transfer_amount'])
					->with('transfer_recipient', $_POST['transfer_recipient']);
			}catch (Cyclos\ServiceException $e){
				switch ($e->errorCode) {
					case 'VALIDATION':
						Session::flash('errors', 'Please input the correct recipient and amount');
						return View::make('customers/transfer');
						break;
					case 'ENTITY_NOT_FOUND':
						Session::flash('errors', 'Invalid User Recipient');
						return View::make('customers/transfer');
						break;
					case 'INSUFFICIENT_BALANCE':
						Session::flash('errors', 'Insufficient Balance');
						return View::make('customers/transfer');
						break;
					case 'DATA_ACCESS':
						Session::flash('errors', 'Transfer Overload');
						return View::make('customers/transfer');
						break;
					case 'INVALID_PARAMETER':
						Session::flash('errors', 'Invalid Transfer Amount');
						return View::make('customers/transfer');
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
		return View::make('/customers/purchase')->with('data',$data);
	}

	public function increase_limit(){
		$data = array();
		$data['username'] = ConnectHelper::getCurrentUserUsername();
		$data['balance'] = ConnectHelper::getCurrentUserBalance();
		$data['limitBalance'] = ConnectHelper::getCurrentUserLimitBalance();
		return View::make('/customers/increase-limit')->with('data',$data);
	}

	public function getUploadForm() {
        return View::make('image/upload-form');
    }

	public function upload() {
		// getting all of the post database
		// setting up rules
		// if(Input::get('finish-form') == 'finish') {
		// 	return Response::json(['finish' => 'finish']);
		// }

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

	public function validate_registration_form(){
		// process the form here

		// create the validation rules ------------------------
		$rules = array(
			'username'             	=> 'required', 						// just a normal required validation
			'email'            		=> 'required|email', 	// required and must be unique in the ducks table
			'password'         		=> 'required',
			'password_confirmation' => 'required|same:password' 			// required and has to match the password field
		);

		// create custom validation messages ------------------
		$messages = array(
			'same' 	=> 'The :others must matched.'
		);

		// do the validation ----------------------------------
		// validate against the inputs from our form
		$validator = Validator::make(Input::all(), $rules, $messages);

		// check if the validator failed -----------------------
		if ($validator->fails()) {

			// redirect our user back with error messages		
			//$messages = $validator->messages();

			// also redirect them back with old inputs so they dont have to fill out the form again
			// but we wont redirect them with the password they entered

			return View::make('customers/register')
				->withErrors($validator)
				->withInput(Input::except('password', 'password_confirmation'));

		} else {
			// validation successful ---------------------------

			// redirect ----------------------------------------
			// redirect our user back to the form so they can do it all over again

			return $this->register();
		}

	}

	public function validate_login_form(){
		// process the form here

		// create the validation rules ------------------------
		$rules = array(
			'email'            		=> 'required|email', 	// required and must be unique in the ducks table
			'password'         		=> 'required'
		);

		// do the validation ----------------------------------
		// validate against the inputs from our form
		$validator = Validator::make(Input::all(), $rules);

		// check if the validator failed -----------------------
		if ($validator->fails()) {

			// redirect our user back with error messages		
			//$messages = $validator->messages();

			// also redirect them back with old inputs so they dont have to fill out the form again
			// but we wont redirect them with the password they entered

			return Redirect::to('/login')
				->withErrors($validator);

		} else {
			// validation successful ---------------------------

			// redirect ----------------------------------------
			// redirect our user back to the form so they can do it all over again
			return Redirect::to('customers/dashboard');
		}

	}

	public function validate_topup_form(){
		$data['username'] = ConnectHelper::getCurrentUserUsername();
		$data['balance'] = ConnectHelper::getCurrentUserBalance();
		$data['limitBalance'] = ConnectHelper::getCurrentUserLimitBalance();
		$pending_topups = DB::table('topup')->where('status', 'pending')->where('username_customer', $data['username'])->get();
		
		if ($pending_topups != null){
			return Redirect::to('/customers/topup')
				->withErrors(array(
					'topup_amount' => 'You have pending Top Up status, please confirm the payment first.'
				));
		}else{
			// process the form here
			$max = $data['limitBalance'] - $data['balance'];
			// create the validation rules ------------------------
			$rules = array(
				'topup_amount'     		=> 'required|numeric|max:'.$max
			);

			$messages = array(
				'max' => 'The :attribute must not be greater than your limit balance (Maximum Top-Up allowed : :max)' 
			);

			// do the validation ----------------------------------
			// validate against the inputs from our form
			$validator = Validator::make(Input::all(), $rules, $messages);

			// check if the validator failed -----------------------
			if ($validator->fails()) {

				// redirect our user back with error messages		
				//$messages = $validator->messages();

				// also redirect them back with old inputs so they dont have to fill out the form again
				// but we wont redirect them with the password they entered

				return Redirect::to('/customers/topup')
					->withErrors($validator);

			} else {
				$topup = Topup::create(array(
					'date_topup'=>new DateTime, 
					'status'=>'',
					'amount'=>Input::get('topup_amount'),
					'permata_va_account'=>'',
					'username_customer'=>ConnectHelper::getCurrentUserUsername()
				));
				
				$response = PaymentAPI::charge_topup($topup->id, Input::get('topup_amount'));
				
				//Saving to Top Up Table Database
				$topup->date_topup = new DateTime;
				$topup->status = $response->transaction_status;
				$topup->permata_va_account = $response->permata_va_number;
				$topup->save();

				return View::make('customers/topup-success')->with('va_number',$response->permata_va_number);
			}	
		}
		

	}

	public function validate_transfer_form(){
		// process the form here

		// create the validation rules ------------------------
		$rules = array(
			'transfer_recipient'		=> 'required|email',
			'transfer_amount'     		=> 'required|numeric'
		);

		// do the validation ----------------------------------
		// validate against the inputs from our form
		$validator = Validator::make(Input::all(), $rules);

		// check if the validator failed -----------------------
		if ($validator->fails()) {

			// redirect our user back with error messages		
			//$messages = $validator->messages();

			// also redirect them back with old inputs so they dont have to fill out the form again
			// but we wont redirect them with the password they entered

			return Redirect::to('/customers/transfer')
				->withErrors($validator)
				->withInput(Input::except('transfer_amount'));

		} else {
			// validation successful ---------------------------

			// redirect ----------------------------------------
			// redirect our user back to the form so they can do it all over again
			return Redirect::to('customers/transfer-success');
		}

	}

	public function validate_close_account_form(){
		// process the form here

		// create the validation rules ------------------------
		$rules = array(
			'account_bank'		 => 'required',
			'account_number'     => 'required|numeric',
			'account_name'     	 => 'required'	
		);

		// do the validation ----------------------------------
		// validate against the inputs from our form
		$validator = Validator::make(Input::all(), $rules);

		// check if the validator failed -----------------------
		if ($validator->fails()) {

			// redirect our user back with error messages		
			//$messages = $validator->messages();

			// also redirect them back with old inputs so they dont have to fill out the form again
			// but we wont redirect them with the password they entered

			return Redirect::to('/customers/profile#close-account')
				->withErrors($validator);

		} else {
			
			//GETTING REQUEST CLOSE ACCOUNT GROUPS
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

				//CHANGE THE GROUP
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
				return Redirect::to('customers/close-account-success');

			}catch(Exception $e){
				dd($e);
				Session::flash('errors_cyclos','There are some trouble, please try again later');
				return Redirect::to('/customers/profile#close-account');
			}
		}

	}

	public function validate_change_password_form(){
		// process the form here

		// create the validation rules ------------------------
		$rules = array(
			'current_password'	 		=> 'required',
			'password'     				=> 'required',
			'password_confirmation'   	=> 'required|same:password'	
		);

		// create custom validation messages ------------------
		$messages = array(
			'same' 	=> 'The :others must matched.'
		);

		// do the validation ----------------------------------
		// validate against the inputs from our form
		$validator = Validator::make(Input::all(), $rules, $messages);

		// check if the validator failed -----------------------
		if ($validator->fails()) {

			// redirect our user back with error messages		
			//$messages = $validator->messages();

			// also redirect them back with old inputs so they dont have to fill out the form again
			// but we wont redirect them with the password they entered

			return Redirect::to('/customers/profile#change-password')
				->withErrors($validator);

		} else {
			// validation successful ---------------------------

			// redirect ----------------------------------------
			// redirect our user back to the form so they can do it all over again
			return Redirect::to('customers/change-password-success');
		}

	}

	public function validate_user_information_form(){
		// process the form here

		// create the validation rules ------------------------
		$rules = array(
			'full_name'	 		=> 'required|alpha',
			'id_type'     		=> 'required',
			'id_number'	 		=> 'required',
			'gender'     		=> 'required',
			'birth_place'		=> 'required',
			'birth_date'		=> 'required',
			'id_address'		=> 'required'
		);


		// do the validation ----------------------------------
		// validate against the inputs from our form
		$validator = Validator::make(Input::all(), $rules);

		// check if the validator failed -----------------------
		if ($validator->fails()) {

			// redirect our user back with error messages		
			//$messages = $validator->messages();

			// also redirect them back with old inputs so they dont have to fill out the form again
			// but we wont redirect them with the password they entered

			return Redirect::to('/customers/increase-limit#user-information')
				->withErrors($validator);

		} else {
			// validation successful ---------------------------
			// input to database

			// redirect ----------------------------------------
			// redirect our user back to the form so they can do it all over again
			return Redirect::to('customers/increase-limit#upload-id-card');
		}

	}

}
