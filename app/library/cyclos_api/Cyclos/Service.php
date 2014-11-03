<?php namespace Cyclos;

	use Session;
/**
 * Base class for Cyclos service proxies
 */
class Service {
	private $urlSuffix;

	public function __construct($urlSuffix) {
		$this->urlSuffix = $urlSuffix;
	}
	
	public function run($operation, $params,$fromUser){

		// Setup curl
		$url = Configuration::url($this->urlSuffix);
		$ch = \curl_init($url);


		if($fromUser){
			$options = Configuration::curlOptions($operation, $params,Session::get('cyclos_session_token'),Session::get('cyclos_remote_address'));
		}else{
			$options = Configuration::curlOptions($operation, $params);
		}
		\curl_setopt_array ($ch, $options);
		
		// Execute the request
		$json = \curl_exec($ch);
		$result = \json_decode($json);
		$code = \curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if ($code == 200) {
			if ($operation != 'logout')
				return $result->result;
			else
				return;
		} else {
			$error = $result;
			if ($error == NULL) {
				$error = new \stdclass();
				$error->errorCode = 'UNKNOWN';
			}
			throw new ServiceException($this->urlSuffix, $operation, $error->errorCode, $error);
		}
	}
}