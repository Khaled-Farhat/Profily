<?php

namespace App\Services;
use App\Models\Comment;
use App\Models\User;

class CommentService {
	public static function isCommentExists($commentId) {
		$comment = Comment::find($commentId);

		return (is_null($comment) === false);
	}

	public static function createComment($username, $postId, $content) {
		$user = User::firstWhere('username', $username);
		$comment = new Comment();
		$comment->user_id = $user->id;
		$comment->post_id = $postId;
		$comment->content = $content;
		$comment->save();

		return $comment->id;
	}

	public static function updateComment($commentId, $content) {
		$comment = Comment::find($commentId);
		$comment->content = $content;
		$comment->save();
	}

	public static function deleteComment($commentId) {
		$comment = Comment::find($commentId);
		$comment->delete();
		return $comment->post->id;
	}

	public static function canUpdateComment($username, $commentId) {
		$comment = Comment::find($commentId);

		return ($comment->user->username == $username);
	}

	public static function canDeleteComment($username, $commentId) {
		$user = User::firstWhere('username', $username);
		$comment = Comment::find($commentId);

		return ($user->user_type == 'admin' || $comment->user->username == $username);
	}

	public static function getComment($commentId) {
		return Comment::find($commentId);
	}

	public static function getCommentAllowedActions($username, $commentId) {
		$allowedActions = [];

		if (self::canUpdateComment($username, $commentId) === true) {
			$allowedActions['updateComment'] = true;
		}

		if (self::canDeleteComment($username, $commentId) === true) {
			$allowedActions['deleteComment'] = true;
		}

		return $allowedActions;
	}
}

?>