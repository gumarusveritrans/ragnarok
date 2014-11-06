<?php

class AdminController extends BaseController {

	public function login(){
		if(Session::get('cyclos_group') == Config::get("connect_variable.admin")){
			return Redirect::to('/admin/dashboard');
		}
		if(Request::getMethod()=='GET'){
			return View::make('/admin/login');	
		}else if(Request::getMethod()=='POST'){
			$loginService = new Cyclos\Service('loginService');

			// Set the parameters
			$params = new stdclass();
			$params->user = array('username' => $_POST['email']);
			$params->password = $_POST['password'];
			$params->remoteAddress = $_SERVER['REMOTE_ADDR'];

			// Perform the login
			try {
				$result = $loginService->run('loginUser',$params,false);

				//print_r($result);
				Session::put('cyclos_session_token',$result->sessionToken);
				Session::put('cyclos_username',$params->user['username']);
				Session::put('cyclos_remote_address',$params->remoteAddress);
					
				//GETTING THE GROUP NAME
				$params = new stdclass();
				$params->id = $result->user->id;

				$userService = new Cyclos\Service('userService');
				$result = $userService->run('getViewProfileData',$params,false);

				if($result->group->name != Config::get('connect_variable.admin')){
					Session::flush();
					Session::flash('errors', 'Invalid username/password');
					return View::make('/admin/login');
				}

				Session::put('cyclos_group',$result->group->name);
				Session::put('cyclos_email',$result->email);
				return Redirect::to('/admin/dashboard');
			} catch (Cyclos\ConnectionException $e) {
				echo("Cyclos server couldn't be contacted");
				die();
			} catch (Cyclos\ServiceException $e) {
				switch ($e->errorCode) {
					case 'VALIDATION':
						Session::flash('errors', 'Missing username/password');
						return View::make('/admin/login');
						break;
					case 'LOGIN':
						//return View::make('customers/login')->with('errors', 'Invalid Username/Password');
						Session::flash('errors', 'Invalid username/password');
						return View::make('/admin/login');
						break;
					case 'REMOTE_ADDRESS_BLOCKED':
						//return View::make('customers/login')->with('errors', 'Your access is blocked by exceeding invalid login attempts');
						Session::flash('errors', 'Your access is blocked by exceeding invalid login attempts');
						return View::make('/admin/login');
						break;
					default:
						//return View::make('customers/login')->with('errors', 'Error while performing login: {$e->errorCode}');
						Session::flash('errors', 'Error while performing login: {$e->errorCode}');
						return View::make('/admin/login');
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
			return Redirect::to("/admin/login");
		}catch (Cyclos\ConnectionException $e) {
			echo("Cyclos server couldn't be contacted");
			die();
		} catch (Cyclos\ServiceException $e) {
			echo("Error while performing logout: {$e->errorCode}");
		}
		die();
	}

	public function dashboard(){
		return View::make('/admin/dashboard');
	}

	public function notification(){
		$redeems = Redeem::all();
		return View::make('/admin/notification')->with('redeems',$redeems);
	}

	public function manage_user(){
		//GETTING ALL USERS
		$userService = new Cyclos\Service('userService');

		//GETTING ACCOUNT ROLE
		$usersResult = $userService->run('getUserRegistrationGroups',array(),false);
		$roleId = array();
		foreach($usersResult as $group){
			$roleId[$group->name] = $group->id;
		}

		//GETTING ACCOUNTS
		//GETTING VERIFIED USER
		$params = new stdclass();
		$params->groups = new stdclass();
		$params->groups->id = $roleId[Config::get('connect_variable.verified_user')];
		$params->pageSize = PHP_INT_MAX;
		$verifiedUsersResult = $userService->run('search',$params,false);

		//GETTING UNVERIFIED USER
		$params = new stdclass();
		$params->groups = new stdclass();
		$params->groups->id = $roleId[Config::get('connect_variable.unverified_user')];
		$params->pageSize = PHP_INT_MAX;
		$unverifiedUsersResult = $userService->run('search',$params,false);

		//GETTING MERCHANT
		$params = new stdclass();
		$params->groups = new stdclass();
		$params->groups->id = $roleId[Config::get('connect_variable.merchant')];
		$params->pageSize = PHP_INT_MAX;
		$merchantsResult = $userService->run('search',$params,false);

		
		return View::make('/admin/manage-user');
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

			return Redirect::to('/admin/login')
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
			return Redirect::to('/admin/dashboard');
		}

	}

	public function redeem_user(){
		$userService = new Cyclos\Service('userService');
		$userGroupService = new Cyclos\Service('userGroupService');
		try{
			//VALIDATE REDEEMATION
			$redeem = Redeem::find(Input::get('redeem_id'));
			if($redeem->redeemed == true){
				throw new Exception();
			}

			//GETTING USER ID
			$params = new stdclass();
			$params->keywords = Input::get('redeem_username');
			$result = $userService->run('search',$params,false);

			$user_id = $result->pageItems[0]->id;
			
			//GET GROUP
			$result = $userService->run("getUserRegistrationGroups",array(),false);
				
			$group_id;

			foreach($result as $res){
				if($res->name == Config::get('connect_variable.closed_user_account')){
					$group_id = $res->id;
				}
			}

			//CHANGE THE GROUP
			$params = new stdclass();
			$params->group = new stdclass();
			$params->group->id = $group_id;

			$params->user = new stdclass();
			$params->user->id = $user_id;
			$result = $userGroupService->run('changeGroup',$params,false);

			$redeem->redeemed = true;
			$redeem->save();
			echo 'success!';
		}catch(Exception $e){
			echo 'There are some trouble, please try again later.';
		}
	}

}