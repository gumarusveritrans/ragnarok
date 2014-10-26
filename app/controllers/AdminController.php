<?php

class AdminController extends BaseController {

	public function login(){
		return View::make('/admin/admin-login');
	}

}