<?php

class ConnectPagesController extends BaseController {

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

	public function reset_password(){
		if(Request::getMethod()=='GET'){
			return View::make('/connect_pages/reset_password');	
		}else if(Request::getMethod()=='POST'){
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