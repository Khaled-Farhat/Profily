<?php

namespace App\Core;
use App\Core\Utility\UrlHelper;

class App {
	protected $controller = "Home";
	protected $method = "index";
	protected $params = [];
	protected $middlewares = [
		'Accounts/setModerator' => ['ensureLoggedin@Authenticate'],
		'Accounts/removeModerator' => ['ensureLoggedin@Authenticate'],
		'Accounts/updatePassword' => ['ensureLoggedin@Authenticate'],
		'Comments/createComment' => ['ensureLoggedin@Authenticate'],
		'Comments/updateComment' => ['ensureLoggedin@Authenticate'],
		'Comments/deleteComment' => ['ensureLoggedin@Authenticate'],
		'Login/index' => ['ensureNotLoggedin@Authenticate'],
		'Posts/createPost' => ['ensureLoggedin@Authenticate'],
		'Posts/updatePost' => ['ensureLoggedin@Authenticate'],
		'Posts/deletePost' => ['ensureLoggedin@Authenticate'],
		'Signup/index' => ['ensureNotLoggedin@Authenticate']
	];

	public function __construct() {
		$this->initializeDestination();
		$this->checkMiddleware();
		$this->runController();
	}

	private function initializeDestination() {
		$urlHelper = new UrlHelper();
		$destinationData = $urlHelper->fetchUrlArguments();

		$this->setController($destinationData['controller']);
		$this->setControllerMethod($destinationData['method']);
		$this->params = $destinationData['params'];
	}

	private function runController() {
		$controllerClassName = 'App\Controllers\\' . $this->controller;
		
		call_user_func_array([new $controllerClassName, $this->method], $this->params);
	}

	public function checkMiddleware() {
		$destination = $this->controller . '/' . $this->method;

		if (array_key_exists($destination, $this->middlewares) === true) {
			foreach ($this->middlewares[$destination] as $middleware) {
				$middlewareDestination = explode('@', $this->middlewares[$destination][0]);
				$middlewareClassName = 'App\Core\Middleware\\' . $middlewareDestination[1];
				$middlewareMethod = $middlewareDestination[0];

				call_user_func([$middlewareClassName, $middlewareMethod]);
			}
		}
	}

	private function setController($controller) {
		if (class_exists('App\Controllers\\' . $controller) === true) {
			$this->controller = $controller;
			return true;
		}
		else {
			return false; // failed to set the controller
		}
	}

	private function setControllerMethod($method) {
		$controllerClassName = 'App\Controllers\\' . $this->controller;

		if (method_exists(new $controllerClassName, $method)) {
			$this->method = $method;
			return true;
		}
		else {
			return false; // failed to set the method
		}
	}
}

?>