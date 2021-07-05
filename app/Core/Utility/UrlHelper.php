<?php

namespace App\Core\Utility;

// class UrlHelper responsible to provide functionality to 
// make it easier to process the $_GET[url] arguments,
// used to find the controller, the method and the parameters
class UrlHelper {
	// fetch the agruments from the url,
	// $_GET[url] = controller/method/param1/param2/...
	public function fetchUrlArguments() {
		$parsedUrl = $this->parseUrl();
		$urlArguments = [
			'controller' => '', 
			'method' => '',
			'params' => []
		];

		if (array_key_exists(0, $parsedUrl)) {
			$urlArguments['controller'] = $parsedUrl[0];
			unset($parsedUrl[0]);
		}

		if (array_key_exists(1, $parsedUrl)) {
			$urlArguments['method'] = $parsedUrl[1];
			unset($parsedUrl[1]);
		}

		foreach ($parsedUrl as $param) {
			$urlArguments['params'][] = $param;
		}

		return $urlArguments;
	}

	protected function parseUrl() {
		$url = [];

		if (array_key_exists('url', $_GET)) {
			$url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}

		return $url;
	}
}

?>