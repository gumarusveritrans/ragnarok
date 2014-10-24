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
}