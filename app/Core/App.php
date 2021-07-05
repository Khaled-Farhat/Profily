<?php

namespace App\Core;
use App\Core\Utility\UrlHelper;

class App {
	protected $controller = "App\Controllers\Home";
	protected $method = "index";
	protected $params = [];

	public function __construct() {
		$this->initializeDestination();
		$this->runController();
	}

	private function initializeDestination() {
		$urlHelper = new UrlHelper();
		$destinationData = $urlHelper->fetchUrlArguments();

		$this->setController('App\\Controllers\\' . $destinationData['controller']);
		$this->setControllerMethod($destinationData['method']);
		$this->params = $destinationData['params'];
	}

	private function runController() {
		$controllerObject = new $this->controller;
		call_user_func_array([$controllerObject, $this->method], $this->params);
	}

	private function setController($controller) {
		if (class_exists($controller) === true) {
			$this->controller = $controller;
			return true;
		}
		else {
			return false; // failed to set the controller
		}
	}

	private function setControllerMethod($method) {
		$controllerObject = new $this->controller;

		if (method_exists($controllerObject, $method)) {
			$this->method = $method;
			return true;
		}
		else {
			return false; // failed to set the method
		}
	}
}

?>