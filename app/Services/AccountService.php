<?php

namespace App\Services;
use App\Models\Post;
use App\Models\User;

class AccountService {
	public static function isUserExists($username) {
		return (is_null(User::firstWhere('username', $username)) === false);
	}

	public static function createUser($username, $password) {
		$user = new User();
		$user->username = $username;
		$user->password = password_hash($password, PASSWORD_BCRYPT);
		
		if (self::isAdminExists() === false) {
			$user->user_type = 'admin';
		}
		else {
			$user->user_type = 'none';
		}

		$user->save();
	}

	public static function updatePassword($username, $password) {
		$user = User::firstWhere('username', $username);
		$user->password = password_hash($password, PASSWORD_BCRYPT);
		$user->save();
	}

	public static function isCorrectPassword($username, $password) {
		$user = User::firstWhere('username', $username);

		return (password_verify($password, $user->password) === true);
	}

	public static function setModerator($username) {
		$user = User::firstWhere('username', $username);
		$user->user_type = 'moderator';
		$user->save();
	}

	public static function removeModerator($username) {
		$user = User::firstWhere('username', $username);
		$user->user_type = 'none';
		$user->save();
	}

	public static function isAdminExists() {
		$admin = User::firstWhere('user_type', 'admin');

		return (is_null($admin) === false);
	}

	public static function canPromote($actorUsername, $promoteeUsername) {
		$actorUser = User::firstWhere('username', $actorUsername);
		$promoteeUser = User::firstWhere('username', $promoteeUsername);

		return ($actorUser->user_type === 'admin' && $promoteeUser->user_type !== 'admin');
	}
}

?>