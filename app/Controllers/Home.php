<?php

namespace App\Controllers;
use App\Core\Controller;
use App\Core\Utility\Session;
use App\Services\PostService;

class Home extends Controller {
	public function index() {
		// check if the user is logged in or not, to show the proper home page
		if (Session::get('USERNAME') !== null) {
			$this->multiView(['Hero/userHero', 'Home/home']);
		}
		else {
			$this->multiView(['Hero/visitorHero', 'Home/home']);
		}
	}

	public function viewRecentPosts() {
		$actorUsername = Session::get('USERNAME');
		$data = [
			'posts' => PostService::getRecentPosts(),
			'pageTitle' => 'Recent posts'
		];

		if (is_null($actorUsername) === false) {
			// the actions that the logged-in user can do (continue reading / edit / delete post)
			if (empty($data['posts']) === false) {
				foreach ($data['posts'] as $post) {
					$data[$post->id]['postAllowedActions'] = PostService::getPostAllowedActions($actorUsername, $post->id);
				}
			}
		}
		
		$this->view('Posts/viewPostsList', $data);
	}
}

?>