<?php

namespace App\Core\Validation\Rules;
use App\Core\Validation\Rule;

class NoUppercaseRule implements Rule {
	public function apply($input) {
		return (strtolower($input) === $input);
	}

	public function getErrorMessage($fieldName) {
		return $fieldName . ' must not has uppercase characters';
	}
}

?>