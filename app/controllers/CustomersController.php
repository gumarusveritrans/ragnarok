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

	public function transfer(){	
		return View::make('/customers/transfer');
	}


}