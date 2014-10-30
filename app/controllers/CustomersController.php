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

	public function topup_success(){	
		return View::make('/customers/topup-success');
	}

	public function transfer_success(){	
		return View::make('/customers/transfer-success');
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

}