<?php

class ConnectPagesController extends BaseController {

	public function __construct(){
		$this->beforeFilter(function(){
			$role = ConnectHelper::getCurrentUserRole();
			if ($role == Config::get('connect_variable.merchant')){
				return Redirect::to('merchants/transaction');
			}
			elseif ($role == Config::get('connect_variable.unverified_user') || $role == Config::get('connect_variable.verified_user')){
				return Redirect::to('customers/dashboard');
			}
			elseif ($role == Config::get('connect_variable.admin')){
				return Redirect::to('admin/dashboard');
			}
		});	
	}

	public function home(){
		return View::make('/connect_pages/home');
	}

	public function about(){
		return View::make('/connect_pages/about');
	}

	public function contact(){
		return View::make('/connect_pages/contact');
	}

	public function pricing(){
		return View::make('/connect_pages/pricing');
	}

	public function product(){
		return View::make('/connect_pages/product');
	}

	public function login(){
		if(Session::get('cyclos_group') == Config::get("connect_variable.unverified_user") || Session::get('cyclos_group') == Config::get("connect_variable.verified_user")){
			return Redirect::to('/');
		}
		if(Request::getMethod()=='GET'){
			return View::make('/connect_pages/login');	
		}elseif(Request::getMethod()=='POST'){
			$loginService = new Cyclos\Service('loginService');

			// Set the parameters
			$params = new stdclass();
			$params->user = array('username' => $_POST['username']);
			$params->password = $_POST['password'];
			$params->remoteAddress = $_SERVER['REMOTE_ADDR'];

			// Perform the login
			try {
				$result = $loginService->run('loginUser',$params,false);
				Session::put('cyclos_session_token',$result->sessionToken);
				Session::put('cyclos_username',$params->user['username']);
				Session::put('cyclos_remote_address',$params->remoteAddress);
				Session::put('cyclos_id',$result->user->id);



				// Getting the group name
				$params = new stdclass();
				$params->id = $result->user->id;

				$userService = new Cyclos\Service('userService');
				$result = $userService->run('getViewProfileData',$params,false);

				if($result->group->name != Config::get('connect_variable.unverified_user') && $result->group->name != Config::get('connect_variable.verified_user')){
					Session::flush();
					Session::flash('errors', 'Invalid username/password');
					return View::make('connect_pages/login');
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
						return View::make('connect_pages/login');
						break;
					case 'LOGIN':
						//return View::make('customers/login')->with('errors', 'Invalid Username/Password');
						Session::flash('errors', 'Invalid username/password');
						return View::make('connect_pages/login');
						break;
					case 'REMOTE_ADDRESS_BLOCKED':
						//return View::make('customers/login')->with('errors', 'Your access is blocked by exceeding invalid login attempts');
						Session::flash('errors', 'Your access is blocked by exceeding invalid login attempts');
						return View::make('connect_pages/login');
						break;
					default:
						//return View::make('customers/login')->with('errors', 'Error while performing login: {$e->errorCode}');
						Session::flash('errors', 'Error while performing login: {$e->errorCode}');
						return View::make('connect_pages/login');
						break;
				}
				Session::flush();
				die();
			}
		}
	}

	public function register(){	
		// Kick logined user
		if(Session::get('cyclos_session_token') != null){
			return Redirect::to('/');
		}
		
		if(Request::getMethod()=='GET'){
			return View::make('/connect_pages/register');	
		}elseif(Request::getMethod()=='POST'){
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
				return View::make('connect_pages/register-success');
			}catch (Cyclos\ServiceException $e){
				if($e->errorCode == "VALIDATION"){
					$errors = "";
					foreach($e->error->validation->propertyErrors as $error){
						$errors = $errors . $error[0] . "\n";
					}
					Session::flash('errors',$errors);
					return View::make('/connect_pages/register');	
					
				}else{
					Session::flash('errors',$e->errorCode);
					return View::make('/connect_pages/register');
				}
			}
		}
	}

	public function reset_password(){
		if(Request::getMethod()=='GET'){
			return View::make('/connect_pages/reset-password');	
		}elseif(Request::getMethod()=='POST'){
			//GETTING USER EMAIL
			$userService = new Cyclos\Service('userService');
			$params = new stdclass();
			$params->email = Input::get('email');
			try{
				$result = $userService->run('getViewProfileData',$params,false);

				
				//RANDOMIZE PASSWORD
				$alpha = "abcdefghijklmnopqrstuvwxyz";
				$alpha_upper = strtoupper($alpha);
				$numeric = "0123456789";
				$special = ".-+=_,!@$#*%<>[]{}";
				$chars = "";
				 
			    // default [a-zA-Z0-9]{9}
			    $chars = $alpha . $alpha_upper . $numeric;
			    $length = 9;
				 
				$len = strlen($chars);
				$pw = '';

				//ensuring password policy
				$pw .= substr($alpha, rand(0, strlen($alpha)-1), 1);
			 	$pw .= substr($alpha_upper, rand(0, strlen($alpha_upper)-1), 1);
			 	$pw .= substr($numeric, rand(0, strlen($numeric)-1), 1);

				for ($i=0;$i<$length;$i++)
				        $pw .= substr($chars, rand(0, $len-1), 1);
				 
				// the finished password
				$pw = str_shuffle($pw);

				//RESET THE PASSWORD
				//getting user id
				$user_id = $result->user->id;
				$username = $result->user->username;
				Session::put('temp_username',$username);

				//getting login password data
				$passwordTypeService = new Cyclos\Service('passwordTypeService');
				$result = $passwordTypeService->run('list',array(),false);				

				foreach($result as $type){
					if($type->name == Config::get('connect_variable.cyclos_login_password')){
						$login_password_type = $type;
					}
				}

				//changin the password in cyclos
				$passwordService = new Cyclos\Service('passwordService');
				
				$changePasswordDTO = new stdclass();
				$changePasswordDTO->type = $login_password_type;
				$changePasswordDTO->user = new stdclass();
				$changePasswordDTO->user->id = $user_id;
				$changePasswordDTO->newPassword = $pw;
				$changePasswordDTO->confirmNewPassword = $pw;

				$passwordService->run('change',$changePasswordDTO,false);
				Mail::send('emails.change_password', array('password' => $pw,
														   'username' => $username), function($message)
				{
					$message->from('connect_cs@connect.co.id', 'Connect');
				    $message->to(Input::get('email'), Session::pull('temp_username'))->subject('Reset Password');
				});

			}catch(Cyclos\ServiceException $e){
				//NO EXCEPTION HANDLING NEEDED
				if($e->error->errorCode != 'VALIDATION' && $e->error->errorCode != 'ENTITY_NOT_FOUND')
					return Response::view('errors.500', array(), 500);
			}
			echo 'Your new password will be sent to your mail if it exists in our system.';
		}
	}
}