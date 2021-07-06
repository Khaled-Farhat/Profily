<?php

namespace App\Controllers;
use App\Core\Controller;
use App\Core\Utility\Session;
use App\Services\AccountService;
use App\Services\ProfileService;
use App\Services\PostService;

class Profile extends Controller {
	public function index() {
		header('Location: ' . URL);
	}

	public function viewProfile($profileUsername) {
		if (AccountService::isUserExists($profileUsername) === false) {
			$this->view('Errors/error404');
		}
		else {
			$actorUsername = Session::get('USERNAME');
			$data = [
				'posts' => ProfileService::getProfilePosts($profileUsername),
				'pageTitle' => 'Profile of ' . $profileUsername
			];

			if (is_null($actorUsername) === false) {
				// the actions that $actorUsername can do (create post / set as moderator / remove as moderator)
				$profileAllowedActions = ProfileService::getProfileAllowedActions($actorUsername, $profileUsername);

				if (array_key_exists('createPost', $profileAllowedActions) === true) {
					$data['pageAllowedActions']['Create a post'] = URL . '/Posts/createPost';
				}

				if (array_key_exists('setModerator', $profileAllowedActions) === true) {
					$data['pageAllowedActions']['Set as moderator'] = URL . '/Accounts/setModerator/' . $profileUsername;
				}

				if (array_key_exists('removeModerator', $profileAllowedActions) === true) {
					$data['pageAllowedActions']['Remove as moderator'] = URL . '/Accounts/removeModerator/' . $profileUsername;
				}

				foreach ($data['posts'] as $post) {
					$data[$post->id]['postAllowedActions'] = PostService::getPostAllowedActions($actorUsername, $post->id);
				}
			}

			$this->view('Posts/viewPostsList', $data);
		}
	}
}

?>