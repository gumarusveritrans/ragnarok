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
		return View::make('/admin/manage-user');
	}

}