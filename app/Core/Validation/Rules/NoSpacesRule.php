<?php

namespace App\Core\Validation\Rules;
use App\Core\Validation\Rule;

class NoSpacesRule implements Rule {
	public function apply($input) {
		return (strpos($input, ' ') === false);
	}

	public function getErrorMessage($fieldName) {
		return $fieldName . ' should not contain any spaces';
	}
}

?>