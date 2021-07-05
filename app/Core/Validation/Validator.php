<?php

namespace App\Core\Validation;
use App\Core\Utility\ErrorsList;
use App\Core\Validation\RulesResolver;

class Validator {
	// $rules[$key] is a string contains the rules that must be applied on $inputs[$key], separated by |
	// example: FirstRule|SecondRule|ThirdRule
	// You can also pass agruments to the rule, example: FirstRule:params|SecondRule:params
	private $inputs;
	private $rules;
	private $errors;
	private $aliases = [
		'PasswordRule' => 'RequiredRule|MaxLengthRule:32'
	];

	public function __construct($inputs, $rules) {
		$this->inputs = $inputs;
		
		foreach ($rules as $key => $rulesSet) {
			if (array_key_exists($rulesSet, $this->aliases) === true) {
				$rulesSet = $this->aliases[$rulesSet];
			}

			$this->rules[$key] = explode('|', $rulesSet);
		}

		$this->errors = new ErrorsList();
	}

	public function runValidation() {
		foreach ($this->inputs as $key => $input) {
			if (array_key_exists($key, $this->rules)) {
				foreach ($this->rules[$key] as $ruleName) {
					$this->validateRule($key, $input, $ruleName);
				}
			}
		}
	}

	public function getErrors() {
		return $this->errors;
	}

	private function validateRule($key, $input, $ruleName) {
		$ruleObject = RulesResolver::getRule($ruleName);

		if ($ruleObject->apply($input) === false) {
			$errorMessage = $ruleObject->getErrorMessage($key);
			$this->errors->addError($errorMessage);
		}
	}
}

?>