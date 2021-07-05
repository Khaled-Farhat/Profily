<?php

namespace App\Controllers;
use App\Core\Controller;
use App\Core\Utility\Session;
use App\Services\CommentService;

class Comments extends Controller {
	public function index() {
		header('Location: ' . URL);
	}

	public function createComment($postId) {
		$username = Session::get('USERNAME');

		if (is_null($username) === true) {
			// not logged-in, redirect to login page
			header('Location: ' . URL . '/Login');
		}
		else {
			$data = [
				'pageTitle' => 'Create a comment',
				'postId' => $postId
			];

			if (array_key_exists('content', $_POST) === true) {
				$content = trim($_POST['content']);
				$errors = $this->validateComment($content);

				if ($errors->hasErrors() === false) {
					CommentService::createComment($username, $postId, $content);
					header('Location: ' . URL . '/Posts/viewPost/' . $postId);
				}
				else {
					$data['errors'] = $errors->getErrors();
				}
			}

			$this->view('Comments/createComment', $data);
		}
	}

	public function updateComment($commentId) {
		$username = Session::get('USERNAME');

		if (is_null($username) === true) {
			// not logged-in, redirect to login page
			header('Location: ' . URL . '/Login');
		}
		else if (CommentService::isCommentExists($commentId) === false) {
			$this->view('Errors/error404');
		}
		else if (CommentService::canUpdateComment($username, $commentId) === false) {
			// user does not have the rights to update the comment
			$this->view('Errors/notAllowed');
		}
		else {
			$data = [
				'pageTitle' => 'Update comment',
				'comment' => CommentService::getComment($commentId)
			];

			if (array_key_exists('content', $_POST) === true) {
				$content = trim($_POST['content']);
				$errors = $this->validateComment($content);

				if ($errors->hasErrors() === false) {
					$comment = CommentService::getComment($commentId);
					CommentService::updateComment($commentId, $content);
					header('Location: ' . URL . '/Posts/viewPost/' . $comment->post->id);
				}
				else {
					$data['errors'] = $errors->getErrors();
				}
			}

			$this->view('Comments/updateComment', $data);
		}
	}

	public function deleteComment($commentId) {
		$username = Session::get('USERNAME');

		if (is_null($username) === true) {
			// user is not logged-in, redirect to login page
			header('Location: ' . URL . '/Login');
		}
		else if (CommentService::isCommentExists($commentId) === false) {
			$this->view('Errors/error404');
		}
		else if (CommentService::canUpdateComment($username, $commentId) === false) {
			// user does not have the rights to update the comment
			$this->view('Errors/notAllowed');
		}
		else {
			$postId = CommentService::deleteComment($commentId);
			header('Location: ' . URL . '/Posts/viewPost/' . $postId);
		}
	}

	private function validateComment($content) {
		$inputs = [
			'Comment' => $content 
		];
		
		$rules = [
			'Comment' => 'RequiredRule|MaxLengthRule:512'
		];

		return $this->validate($inputs, $rules);
	}
}

?>