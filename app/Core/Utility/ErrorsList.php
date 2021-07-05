<?php

namespace App\Core\Utility;

class ErrorsList {
	private $errors = [];

	public function addError($error) {
		$this->errors[] = $error;
	}

	public function getErrors() {
		return $this->errors;
	}

	public function hasErrors() {
		return (count($this->errors) > 0);
	}

	public function appendErrors($otherErrorsList) {
		$this->errors = array_merge($this->errors, $otherErrorsList->errors);
	}
}