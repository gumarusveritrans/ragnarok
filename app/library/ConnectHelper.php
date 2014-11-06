<?php


class ConnectHelper{
	
	public static function getCurrentUserBalance(){

		$accountService = new Cyclos\Service('accountService');
		$result = $accountService->run('getAccountsSummary',array(array("username"=>Session::get('cyclos_username')),array("date"=>"null")),true);

		return intval($result[0]->balance->amount);
	}

	public static function getCurrentUserLimitBalance(){

		$accountService = new Cyclos\Service('accountService');
		$result = $accountService->run('getAccountsSummary',array(array("username"=>Session::get('cyclos_username')),array("date"=>"null")),true);
		return intval($result[0]->status->upperCreditLimit);
	}

	public static function getCurrentUserUsername(){
		return Session::get('cyclos_username');
	}

	public static function getCurrentUserEmail(){
		return Session::get('cyclos_email');
	}
}