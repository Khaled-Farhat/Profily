<?php

namespace App\Core\Validation\Rules;
use App\Core\Validation\Rule;

class RequiredRule implements Rule {
	public function apply($input) {
		return (empty($input) === false);
	}

	public function getErrorMessage($fieldName) {
		return $fieldName . ' is required';
	}
}

?>