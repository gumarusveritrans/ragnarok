<?php

class CustomersController extends BaseController {

	public function dashboard(){
		return View::make('/customers/dashboard');
	}

	public function profile(){	
		return View::make('/customers/profile');
	}

	public function login(){	
		return View::make('/customers/login');
	}

	public function register(){	
		return View::make('/customers/register');
	}

	public function topup(){	
		return View::make('/customers/topup');
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

	public function upload() {
	  // getting all of the post data
	  $file = array('image' => Input::file('image'));
	  // setting up rules
	  $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
	  // doing the validation, passing post data, rules and the messages
	  $validator = Validator::make($file, $rules);
	  if ($validator->fails()) {
	    // send back to the page with the input data and errors
	    return Redirect::to('upload')->withInput()->withErrors($validator);
	  }
	  else {
	    // checking file is valid.
	    if (Input::file('image')->isValid()) {
	      $destinationPath = 'uploads'; // upload path
	      $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
	      $fileName = rand(11111,99999).'.'.$extension; // renameing image
	      Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
	      // sending back with message
	      Session::flash('success', 'Upload successfully'); 
	      return Redirect::to('upload');
	    }
	    else {
	      // sending back with error message.
	      Session::flash('error', 'uploaded file is not valid');
	      return Redirect::to('upload');
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

	public function validate_increase_limit_form(){
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

			return Redirect::to('/customers/profile#user-information')
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

}
