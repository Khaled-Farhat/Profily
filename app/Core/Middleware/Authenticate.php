<?php

namespace App\Core\Middleware;
use App\Core\Utility\Session;

class Authenticate {
	public static function isAuthenticated() {
		return (is_null(Session::get('USERNAME')) === false);
	}

	public static function getUsername() {
		return Session::get('USERNAME');
	}

	public static function ensureLoggedin() {
		if (self::isAuthenticated() === false) {
			header('Location: ' . URL . '/Login');
		}
	}

	public static function ensureNotLoggedin() {
		if (self::isAuthenticated() === true) {
			header('Location: ' . URL);
		}
	}
}

?>