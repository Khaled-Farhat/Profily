<?php

namespace App\Controllers;
use App\Core\Controller;
use App\Core\Utility\Session;
use App\Core\Utility\Hash;
use App\Services\AccountService;

class Accounts extends Controller {
	public function index() {
		$this->view('Errors/error404');
	}

	public function setModerator($promoteeUsername) {
		$actorUsername = Session::get('USERNAME');

		if (AccountService::isUserExists($promoteeUsername) === false) {
			$this->view('Errors/error404');
		}
		else if (AccountService::canPromote($actorUsername, $promoteeUsername) === false) {
			// the user is not allowed to perform the operation
			$this->view('Errors/notAllowed');
		}
		else {
			AccountService::setModerator($promoteeUsername);
			header('Location: ' . URL . '/Profile/viewProfile/' . $promoteeUsername);
		}
	}

	public function removeModerator($promoteeUsername) {
		$actorUsername = Session::get('USERNAME');

		if (AccountService::isUserExists($promoteeUsername) === false) {
			$this->view('Errors/error404');
		}
		else if (AccountService::canPromote($actorUsername, $promoteeUsername) === false) {
			// the user is not allowed to perform the operation
			$this->view('Errors/notAllowed');
		}
		else {
			AccountService::removeModerator($promoteeUsername);
			header('Location: ' . URL . '/Profile/viewProfile/' . $promoteeUsername);
		}
	}

	public function updatePassword() {
		$actorUsername = Session::get('USERNAME');
		$data = [
			'pageTitle' => 'change password'
		];

		if (array_key_exists('password', $_POST)) {
			$password = $_POST['password'];

			$inputs = [
				'Password' => $password
			];

			$rules = [
				'Password' => 'PasswordRule'
			];
				
			$errors = $this->validate($inputs, $rules);

			if ($errors->hasErrors() === false) {
				AccountService::updatePassword($actorUsername, $password);
				$data['success'] = 'Password was updated successfully.';
			}
			else {
				$data['errors'] = $errors->getErrors();
			}
		}

		$this->view('Accounts/updatePassword', $data);
	}
}

?>