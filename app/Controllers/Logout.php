<?php

namespace App\Controllers;
use App\Core\Controller;
use App\Core\Utility\Session;

class Logout extends Controller {
	public function index() {
		Session::destroy();
		header('Location: ' . URL);
	}
}

?>