<?php

namespace App\Core\Validation\Rules;
use App\Core\Validation\Rule;

class MaxLengthRule implements Rule {
	private $maxLength;

	public function __construct($maxLength) {
		$this->maxLength = $maxLength;
	}

	public function apply($input) {
		return strlen($input) <= $this->maxLength;
	}

	public function getErrorMessage($fieldName) {
		return $fieldName . ' must be at most ' . $this->maxLength . ' characters';
	}
}

?>