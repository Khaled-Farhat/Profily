<?php

namespace App\Core;
use App\Core\Utility\Session;

class View {
	public static function render($viewPath, $data = []) {
		require_once(APP_ROOT . '/app/Views/' . $viewPath . '.php');
	}
}

?>