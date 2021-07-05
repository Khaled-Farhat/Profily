<?php

namespace App\Core\Validation\Rules;
use App\Core\Validation\Rule;

class AlphaNumericRule implements Rule {
	public function apply($input) {
		return (preg_match('/^[\w-]+$/', $input) === 1);
	}

	public function getErrorMessage($fieldName) {
		return $fieldName . ' must be alpha numeric';
	}
}

?>