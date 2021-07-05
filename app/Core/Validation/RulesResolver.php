<?php

namespace App\Core\Validation;

// class RulesResolver responsible for converting the rule name into a rule object
class RulesResolver {
	public static function getRule($rule) {
		$rule = explode(':', $rule);
		$ruleName = $rule[0];
		$ruleClassName = 'App\Core\Validation\Rules\\' . $ruleName;

		// check if the rule has arguments
		if (array_key_exists(1, $rule) === true) {
			$param = $rule[1];
			return new $ruleClassName($param);
		}
		else {
			return new $ruleClassName;
		}
	}
}

?>