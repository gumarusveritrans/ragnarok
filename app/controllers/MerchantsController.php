<?php

class MerchantsController extends BaseController {

	public function login(){
		return View::make('/merchants/login');
	}

	public function transaction(){
		return View::make('/merchants/transaction');
	}

	public function list_products(){
		return View::make('/merchants/list-products');
	}

}