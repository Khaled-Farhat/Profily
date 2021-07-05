<?php

namespace App\Core;
use App\Core\View;
use App\Core\Utility\Session;
use App\Core\Validation\Validator;

abstract class Controller {
	abstract public function index();

	protected function validate($inputs, $rules) {
		$validator = new Validator($inputs, $rules);
		$validator->runValidation();
		return $validator->getErrors();
	}

	protected function multiView($viewsPaths, $data = []) {
		if (Session::get('USERNAME') !== null) {
			$data['loggedinUsername'] = Session::get('USERNAME');
		}

		$this->viewComponents($data);

		foreach ($viewsPaths as $viewPath) {
			View::render($viewPath, $data);
		}

		View::render('Components/footer');
	}

	protected function view($viewPath, $data = []) {
		$this->multiView([$viewPath], $data);
	}

	// a utility function to view the components that exists in all pages
	// (header - nav - toasts)
	private function viewComponents($data) {
		View::render('Components/head');

		if (Session::get('USERNAME') !== null) {
			View::render('Components/Nav/userNav', $data);
		}
		else {
			View::render('Components/Nav/visitorNav', $data);
		}

		if (array_key_exists('pageTitle', $data) === true) {
			View::render('Components/title', $data);
		}

		if (array_key_exists('success', $data) === true) {
			$this->viewToasts($data['success'], 'success');
		}

		if (array_key_exists('errors', $data) === true) {
			$this->viewToasts($data['errors'], 'errors');
		}
	}

	private function viewToasts($messages, $toastsType) {
		$toastsData = [
			'toastsType' => $toastsType,
			'messages' => $messages
		];

		View::render('Components/toasts', $toastsData);
	}
}

?>