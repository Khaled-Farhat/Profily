<?php

namespace App\Core\Validation;

interface Rule {
	// return true if $input satisfies the rule, false otherwise
	public function apply($input);
	
	public function getErrorMessage($fieldName);
}

?>