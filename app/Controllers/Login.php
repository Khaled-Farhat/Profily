<?php

namespace App\Controllers;
use App\Core\Controller;
use App\Core\Utility\Session;
use App\Core\Utility\Hash;
use App\Services\AccountService;

class Login extends Controller {
	public function index() {
		// check if the user is already logged in
		if (Session::get('USERNAME') !== null) {
			header('Location: ' . URL);
		}
		else {
			$this->login();
		}
	}

	private function login() {
		$data = [
			'pageTitle' => 'Login'
		];

		if (array_key_exists('username', $_POST) && array_key_exists('password', $_POST)) {
			$username = $_POST['username'];
			$password = $_POST['password'];

			$inputs = [
				'Username' => $username,
				'Password' => $password
			];

			$rules = [
				'Username' => 'RequiredRule',
				'Password' => 'RequiredRule'
			];

			$errors = $this->validate($inputs, $rules);

			if ($errors->hasErrors() === false) {
				if (AccountService::isUserExists($username) === false) {
					$errors->addError('Invalid username');
				}
			}

			if ($errors->hasErrors() === false) {
				if (AccountService::isCorrectPassword($username, $password) === false) {
					$errors->addError('Incorrect password');
				}
			}

			if ($errors->hasErrors() === false) {
				$this->authorizeUser($username);
				header('Location: ' . URL);
				return;
			}
			else {
				$data['errors'] = $errors->getErrors();
			}
		}

		$this->view('Accounts/login', $data);
	}

	private function authorizeUser($username) {
		Session::set('USERNAME', $username);
	}
}

?>