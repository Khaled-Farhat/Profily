<?php

namespace App\Services;
use App\Models\Post;
use App\Models\User;

class ProfileService {
	public static function getProfilePosts($username) {
		$posts =  User::firstWhere('username', $username)->posts()->get();
		return $posts;
	}

	public static function getProfileAllowedActions($actorUsername, $profileUsername) {
		$actorUser = User::firstWhere('username', $actorUsername);
		$profileUser = User::firstWhere('username', $profileUsername);
		$allowedActions = [];

		if ($actorUsername === $profileUsername) {
			$allowedActions['createPost'] = true;
		}

		if (self::canPromote($actorUser, $profileUser) === true) {
			if ($profileUser->user_type === 'none') {
				$allowedActions['setModerator'] = true;
			}
			else {
				$allowedActions['removeModerator'] = true;
			}
		}

		return $allowedActions;
	}

	// utility functions:

	// return true of $actorUser has the rights to manage the promotions of $promoteeUser
	private static function canPromote($actorUser, $promoteeUser) {
		return ($actorUser->user_type === 'admin' && $promoteeUser->user_type !== 'admin');
	}
}

?>