<?php namespace Cyclos;

/**
 * Holds the configuration for accessing Cyclos services.
 * Basically, needs a root url to be used (up to the network path) and an username / password to access services
 */
class Configuration {

	/**
	 * Returns the full url to access the service with the given url part 
	 */
	public static function url($serviceUrlPart) {
		return $_ENV['CYCLOS_ROOT_URL'] . "/web-rpc/" . $serviceUrlPart;
	}
	
	/**
	 * Returns the curl options to execute a call of the given operation, with the given parameters
	 */

	public static function curlOptions($operation, $params,$session_token = null,$remote_address = null) {
		$request = new \stdclass();
		$request->operation = $operation;
		$request->params = $params;

		//REQUEST AFTER LOGIN
		if($session_token == null && $remote_address == null){//CHECK IF REQUEST WITH ADMIN WEBSERVICE
			return array(
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_USERPWD => $_ENV['CYCLOS_WEBSERVICE_USERNAME'] . ":" . $_ENV['CYCLOS_WEBSERVICE_PASSWORD'],
					CURLOPT_HTTPHEADER => array('Content-type: application/json'),
					CURLOPT_POSTFIELDS => \json_encode($request)
			);
		}else{
			return array(
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_HTTPHEADER => array(
						'Session-Token: ' . $session_token,
						'Remote-Address: '. $remote_address,
						'Content-type: application/json'),
					CURLOPT_POSTFIELDS => \json_encode($request)
			);
		}
	}

	public static function getRootUrl() {
		return self::$rootUrl;
	}
}