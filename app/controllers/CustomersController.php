<?php

class CustomersController extends BaseController {

	public function __construct(Illuminate\Session\SessionManager $session){
		$this->session = $session;
	}

	public function dashboard(){
		return View::make('/customers/dashboard');
	}

	public function profile(){	
		return View::make('/customers/profile');
	}

	public function login(){
		if(Session::get('cyclos_session_token') != null){
			return Redirect::to('/');
		}
		if(Request::getMethod()=='GET'){
			return View::make('/customers/login');	
		}else if(Request::getMethod()=='POST'){
			$loginService = new Cyclos\Service('loginService',$this->session);

			// Set the parameters
			$params = new stdclass();
			$params->user = array('username' => $_POST['email']);
			$params->password = $_POST['password'];
			$params->remoteAddress = $_SERVER['REMOTE_ADDR'];

			// Perform the login
			try {
				$result = $loginService->run('loginUser',$params);
				print_r($result);
				//Session::put('cyclos_session_token',$result->sessionToken);
				//Session::put('cyclos_username',$params->user);
				//Session::put('cyclos_remote_address',$params->remoteAddress);
				//return Redirect::to('/customers/dashboard');
			} catch (Cyclos\ConnectionException $e) {
				echo("Cyclos server couldn't be contacted");
				die();
			} catch (Cyclos\ServiceException $e) {
				switch ($e->errorCode) {
					case 'VALIDATION':
						echo("Missing username / password");
						break;
					case 'LOGIN':
						echo("Invalid username / password");
						break;
					case 'REMOTE_ADDRESS_BLOCKED':
						echo("Your access is blocked by exceeding invalid login attempts");
						break;
					default:
						echo("Error while performing login: {$e->errorCode}");
						break;
				}
				die();
			}
		}
		
	}

	public function logout(){
		$loginService = new Cyclos\LoginService();
		$result = $loginService->logout();
		Session::flush();
		print_r($result);
		//return Redirect::to("/");
	}

	public function register(){	
		return View::make('/customers/register');
	}

	public function topup(){	
		return View::make('/customers/topup');
	}

	public function charge_topup(){
		$server_key = '6d7ccd71-ea52-43cc-ac42-5402077bd6c6';
		$papi_url = 'https://api.sandbox.veritrans.co.id/v2';

		$transaction_details = array(
			'order_id' => rand(),
			'gross_amount' => 10
		);

		$customer_details = array(
		    'first_name'    => "Danny",
    		'last_name'     => "Pranoto",
    		'email'         => "danny.pranoto@veritrans.co.id",
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

	}

	public function transfer(){	
		return View::make('/customers/transfer');
	}

	public function purchase(){	
		return View::make('/customers/purchase');
	}

	public function increase_limit(){	
		return View::make('/customers/increase-limit');
	}

	public function increase_limit_success(){	
		return View::make('/customers/increase-limit-success');
	}

	public function change_password_success(){	
		return View::make('/customers/change-password-success');
	}

	public function close_account_success(){	
		return View::make('/customers/close-account-success');
	}

	public function topup_success(){	
		return View::make('/customers/topup-success');
	}

	public function transfer_success(){	
		return View::make('/customers/transfer-success');
	}

	public function register_success(){	
		return View::make('/customers/register-success');
	}
	
	public function purchase_success(){	
		return View::make('/customers/purchase-success');
	}

	public function getUploadForm() {
        return View::make('image/upload-form');
    }

	public function upload() {
	  // getting all of the post data
	  $file = array('image' => Input::file('image'));
	  // setting up rules
	  $rules = array('image' => 'required'); //mimes:jpeg,bmp,png and for max size max:10000
	  // doing the validation, passing post data, rules and the messages
	  $validator = Validator::make($file, $rules);
	  if ($validator->fails()) {
	    // send back to the page with the input data and errors
	    return Response::json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);
	  }
	  else {
	    // checking file is valid.
	    if (Input::file('image')->isValid()) {
	      $destinationPath = 'uploads/'; // upload path
	      $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
	      $fileName = rand(11111,99999).'.'.$extension; // renameing image
	      Input::file('image')->move('public/uploads/', $fileName); // uploading file to given path
	      // sending back with message
	      Session::flash('success', 'Upload successfully'); 
	      return Response::json(['success' => true, 'file' => asset($destinationPath.$fileName)]);
	      // return Redirect::to('customers/increase-limit-success');
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
			$messages = $validator->messages();

			// also redirect them back with old inputs so they dont have to fill out the form again
			// but we wont redirect them with the password they entered

			return Redirect::to('/register')
				->withErrors($validator)
				->withInput(Input::except('password', 'password_confirmation'));

		} else {
			// validation successful ---------------------------

			// our duck has passed all tests!
			// let him enter the database

			// create the data for our duck
			// $duck = new Duck;
			// $duck->name     = Input::get('name');
			// $duck->email    = Input::get('email');
			// $duck->password = Hash::make(Input::get('password'));

			// save our duck
			// $duck->save();

			// redirect ----------------------------------------
			// redirect our user back to the form so they can do it all over again
			return Redirect::to('customers/register-success');
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
			$messages = $validator->messages();

			// also redirect them back with old inputs so they dont have to fill out the form again
			// but we wont redirect them with the password they entered

			return Redirect::to('/login')
				->withErrors($validator);

		} else {
			// validation successful ---------------------------

			// our duck has passed all tests!
			// let him enter the database

			// create the data for our duck
			// $duck = new Duck;
			// $duck->name     = Input::get('name');
			// $duck->email    = Input::get('email');
			// $duck->password = Hash::make(Input::get('password'));

			// save our duck
			// $duck->save();

			// redirect ----------------------------------------
			// redirect our user back to the form so they can do it all over again
			return Redirect::to('customers/dashboard');
		}

	}

	public function validate_topup_form(){
		// process the form here

		// create the validation rules ------------------------
		$rules = array(
			'topup_amount'     		=> 'required|numeric'
		);

		// do the validation ----------------------------------
		// validate against the inputs from our form
		$validator = Validator::make(Input::all(), $rules);

		// check if the validator failed -----------------------
		if ($validator->fails()) {

			// redirect our user back with error messages		
			$messages = $validator->messages();

			// also redirect them back with old inputs so they dont have to fill out the form again
			// but we wont redirect them with the password they entered

			return Redirect::to('/customers/topup')
				->withErrors($validator);

		} else {
			// validation successful ---------------------------

			// our duck has passed all tests!
			// let him enter the database

			// create the data for our duck
			// $duck = new Duck;
			// $duck->name     = Input::get('name');
			// $duck->email    = Input::get('email');
			// $duck->password = Hash::make(Input::get('password'));

			// save our duck
			// $duck->save();

			// redirect ----------------------------------------
			// redirect our user back to the form so they can do it all over again
			return Redirect::to('customers/topup-success');
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
			$messages = $validator->messages();

			// also redirect them back with old inputs so they dont have to fill out the form again
			// but we wont redirect them with the password they entered

			return Redirect::to('/customers/transfer')
				->withErrors($validator)
				->withInput(Input::except('transfer_amount'));

		} else {
			// validation successful ---------------------------

			// our duck has passed all tests!
			// let him enter the database

			// create the data for our duck
			// $duck = new Duck;
			// $duck->name     = Input::get('name');
			// $duck->email    = Input::get('email');
			// $duck->password = Hash::make(Input::get('password'));

			// save our duck
			// $duck->save();

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
			$messages = $validator->messages();

			// also redirect them back with old inputs so they dont have to fill out the form again
			// but we wont redirect them with the password they entered

			return Redirect::to('/customers/profile#close-account')
				->withErrors($validator);

		} else {
			// validation successful ---------------------------

			// our duck has passed all tests!
			// let him enter the database

			// create the data for our duck
			// $duck = new Duck;
			// $duck->name     = Input::get('name');
			// $duck->email    = Input::get('email');
			// $duck->password = Hash::make(Input::get('password'));

			// save our duck
			// $duck->save();

			// redirect ----------------------------------------
			// redirect our user back to the form so they can do it all over again
			return Redirect::to('customers/close-account-success');
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
			$messages = $validator->messages();

			// also redirect them back with old inputs so they dont have to fill out the form again
			// but we wont redirect them with the password they entered

			return Redirect::to('/customers/profile#change-password')
				->withErrors($validator);

		} else {
			// validation successful ---------------------------

			// our duck has passed all tests!
			// let him enter the database

			// create the data for our duck
			// $duck = new Duck;
			// $duck->name     = Input::get('name');
			// $duck->email    = Input::get('email');
			// $duck->password = Hash::make(Input::get('password'));

			// save our duck
			// $duck->save();

			// redirect ----------------------------------------
			// redirect our user back to the form so they can do it all over again
			return Redirect::to('customers/change-password-success');
		}

	}

	public function validate_user_information_form(){
		// process the form here

		// create the validation rules ------------------------
		$rules = array(
			'id_number'	 		=> 'required',
			'gender'     		=> 'required',
			'birth_place'		=> 'required',
			'address'			=> 'required',
			'province'			=> 'required',
			'city'				=> 'required',
			'postal_code'		=> 'required|numeric'
		);


		// do the validation ----------------------------------
		// validate against the inputs from our form
		$validator = Validator::make(Input::all(), $rules);

		// check if the validator failed -----------------------
		if ($validator->fails()) {

			// redirect our user back with error messages		
			$messages = $validator->messages();

			// also redirect them back with old inputs so they dont have to fill out the form again
			// but we wont redirect them with the password they entered

			return Redirect::to('/customers/increase-limit#user-information')
				->withErrors($validator);

		} else {
			// validation successful ---------------------------

			// our duck has passed all tests!
			// let him enter the database

			// create the data for our duck
			// $duck = new Duck;
			// $duck->name     = Input::get('name');
			// $duck->email    = Input::get('email');
			// $duck->password = Hash::make(Input::get('password'));

			// save our duck
			// $duck->save();

			// redirect ----------------------------------------
			// redirect our user back to the form so they can do it all over again
			return Redirect::to('customers/increase-limit#upload-id-card');
		}

	}

}
