<?php

namespace App\Services;
use App\Models\Post;
use App\Models\User;

class PostService {
	public static function getRecentPosts() {
		$posts = Post::all();

		if ($posts->count() > 0) {
			return $posts->toQuery()->orderByDesc('updated_at')->get();
		}
		else {
			return null;
		}
	}

	// return the actions that the $actor can perform on post $postId (edit/delete)
	public static function getPostAllowedActions($username, $postId) {
		$allowedActions = [];

		if (self::canUpdatePost($username, $postId) === true) {
			$allowedActions['updatePost'] = true;
		}

		if (self::canDeletePost($username, $postId) === true) {
			$allowedActions['deletePost'] = true;
		}

		return $allowedActions;
	}

	public static function isPostExists($postId) {
		return (is_null(Post::find($postId)) === false);
	}

	public static function createPost($username, $title, $content) {
		$userId = User::firstWhere('username', $username)->id;
		$post = new Post();
		$post->user_id = $userId;
		$post->title = $title;
		$post->content = $content;
		$post->save();
		return $post->id;
	}

	public static function getPost($postId) {
		return Post::find($postId);
	}

	public static function updatePost($postId, $title, $content) {
		$post = Post::find($postId);
		$post->title = $title;
		$post->content = $content;
		$post->save();
	}

	public static function deletePost($postId) {
		Post::find($postId)->delete();
	}

	public static function canUpdatePost($username, $postId) {
		$actorUser = User::firstWhere('username', $username);
		$post = Post::find($postId);

		return ($actorUser == $post->user);
	}

	public static function canDeletePost($username, $postId) {
		$actorUser = User::firstWhere('username', $username);
		$post = Post::find($postId);
		$postAuthor = $post->user;

		// author can delete its own posts
		// admins can delete posts of users of types (moderator) and (none)
		// moderator can delete posts of user of type (none)
		return ($actorUser == $postAuthor ||
				($actorUser->user_type === 'admin' && $postAuthor->user_type !== 'admin') ||
				($actorUser->user_type === 'moderator' && $postAuthor->user_type === 'none'));
	}
}

?>