<?php

namespace App\Controllers;
use App\Core\Controller;
use App\Core\Utility\Session;
use App\Core\Utility\Hash;
use App\Services\AccountService;

class Signup extends Controller {
	public function index() {
		$this->signup();
	}

	private function signup() {
		$data = [
			'pageTitle' => 'Signup'
		];

		if (array_key_exists('username', $_POST) && array_key_exists('password', $_POST)) {
			$username = $_POST['username'];
			$password = $_POST['password'];

			$inputs = [
				'Username' => $username,
				'Password' => $password
			];

			$rules = [
				'Username' => 'AlphaNumericRule|NoUppercaseRule|NoSpacesRule|RequiredRule|MaxLengthRule:32',
				'Password' => 'PasswordRule'
			];

			$errors = $this->validate($inputs, $rules);

			// check that $username is valid ($username is not already used)
			if (AccountService::isUserExists($username) === true) {
				$errors->addError('Username is not available');
			}

			if ($errors->hasErrors() === false) {
				AccountService::createUser($username, $password);
				header('Location: ' . URL . '/Login'); // redirect to login page
				return;
			}
			else {
				$data['errors'] = $errors->getErrors();
			}
		}

		$this->view('Accounts/signup', $data);
	}
}

?>