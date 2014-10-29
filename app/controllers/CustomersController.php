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

	public function topup_success(){	
		return View::make('/customers/topup-success');
	}

	public function transfer_success(){	
		return View::make('/customers/transfer-success');
	}

}