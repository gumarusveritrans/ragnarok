<?php namespace Cyclos;

	use Illuminate\Session\SessionManager as Session;
/**
 * Base class for Cyclos service proxies
 */
class Service {
	private $urlSuffix;
	private $session;

	public function __construct($urlSuffix, Session $session) {
		$this->urlSuffix = $urlSuffix;
		$this->session = $session;
	}
	
	public function run($operation, $params){
		// Setup curl
		$url = Configuration::url($this->urlSuffix);
		$ch = \curl_init($url);
		if($this->session->get('cyclos_session_token'!=null)){
			$options = Configuration::curlOptions($operation, $params,$this->session->get('cyclos_remote_address'));
		}else{
			$options = Configuration::curlOptions($operation, $params);
		}
		\curl_setopt_array ($ch, $options);
		
		// Execute the request
		$json = \curl_exec($ch);
		$result = \json_decode($json);
		$code = \curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if ($code == 200) {
			return $result->result;
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