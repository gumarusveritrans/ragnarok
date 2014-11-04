<?php

class AdminController extends BaseController {

	public function login(){
		return View::make('/admin/login');
	}

	public function dashboard(){
		return View::make('/admin/dashboard');
	}

	public function notification(){
		return View::make('/admin/notification');
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

}