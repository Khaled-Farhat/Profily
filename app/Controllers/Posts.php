<?php

namespace App\Controllers;
use App\Core\Controller;
use App\Core\Utility\Session;
use App\Services\PostService;
use App\Services\CommentService;

class Posts extends Controller {
	public function index() {
		header('Location: ' . URL);
	}

	public function createPost() {
		if (is_null(Session::get('USERNAME')) === true) {
			// user is not logged-in, redirect to home page
			header('Location: ' . URL . '/Login');
		}
		else {
			$data = [
				'pageTitle' => 'Create a post'
			];

			if (array_key_exists('title', $_POST) && array_key_exists('content', $_POST)) {
				$title = trim($_POST['title']);
				$content = rtrim($_POST['content']);
				$errors = $this->validatePost($title, $content);

				if ($errors->hasErrors() === false) {
					$actorUsername = Session::get('USERNAME') ?? null;
					$postId = PostService::createPost($actorUsername, $title, $content);

					$this->viewPost($postId);
					return;
				}
				else {
					$data['errors'] = $errors->getErrors();
				}
			}

			$this->view('Posts/createPost', $data);
		}
	}

	public function viewPost($postId) {
		if (PostService::isPostExists($postId) === false) {
			$this->view('Errors/error404');
		}
		else {
			$actorUsername = Session::get('USERNAME') ?? null;
			$post = PostService::getPost($postId);
			$data = [
				'post' => $post,
			];

			// the actions that the logged-in user can do (continue reading / edit / delete post)
			if (is_null($actorUsername) === false) {
				$data['postAllowedActions'] = PostService::getPostAllowedActions($actorUsername, $postId);
				
				foreach ($post->comments as $comment) {
					$data[$comment->id]['commentAllowedActions'] = CommentService::getCommentAllowedActions($actorUsername, $comment->id);
				}
			}

			$this->view('Posts/viewPost', $data);
		}
	}

	public function updatePost($postId) {
		$actorUsername = Session::get('USERNAME') ?? null;

		if (PostService::isPostExists($postId) === false) {
			$this->view('Errors/error404');
		}
		else if ($actorUsername === false ||
				 PostService::canUpdatePost($actorUsername, $postId) === false) {
			// the user is not logged-in or not allowed to perform the operation
			$this->view('Errors/notAllowed');
		}
		else {
			$data = [
				'post' => PostService::getPost($postId),
				'pageTitle' => 'Edit post'
			];

			if(array_key_exists('title', $_POST) && array_key_exists('content', $_POST)) {
				$title = trim($_POST['title']);
				$content = rtrim($_POST['content']);

				$errors = $this->validatePost($title, $content);

				if ($errors->hasErrors() === false) {
					PostService::updatePost($postId, $title, $content);
					$this->viewPost($postId);
					return;
				}
				else {
					$data['errors'] = $errors->getErrors();
				}
			}
				
			$this->view('Posts/updatePost', $data);
		}
	}

	public function deletePost($postId) {
		$actorUsername = Session::get('USERNAME') ?? null;

		if (PostService::isPostExists($postId) === false) {
			$this->view('Errors/error404');
		}
		else if ($actorUsername === false ||
				 PostService::canDeletePost($actorUsername, $postId) === false) {
			// the user is not logged-in or not allowed to perform the operation
			$this->view('Errors/notAllowed');
		}
		else {
			$postAuthor = PostService::getPost($postId)->user->username;
			PostService::deletePost($postId);
			// redirect to the profile of the post owner
			header('Location: ' . URL . '/Profile/viewProfile/' . $postAuthor);
		}
	}

	// prepare the inputs and the rules, call the validate method, and return the errors
	private function validatePost($title, $content) {
		$inputs = [
			'Title' => $title,
			'Content' => $content
		];

		$rules = [
			'Title' => 'RequiredRule|MaxLengthRule:256',
			'Content' => 'RequiredRule'
		];

		return $this->validate($inputs, $rules);
	}
}

?>