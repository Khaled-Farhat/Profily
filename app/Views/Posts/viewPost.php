<div class="container-fluid bg-light py-4">
	<div class="container">
		<div class="shadow-sm card col-12 my-3">
			<div class="card-body">
			 	<h5 class="card-title"><?= $data['post']->title ?></h5>

			 	<span class="card-subtitle text-muted">Author: </span>
			    <a href="<?= URL . '/Profile/viewProfile/' . $data['post']->user->username ?>" class="card-subtitle mb-2 text-muted"><?= $data['post']->user->username ?></a>
			    <span>|  </span>

			    <span class="card-subtitle mb-2 text-muted">Last update: <?= date('Y-M-d h:i', strtotime($data['post']->updated_at)) ?></span>

			    <p class="card-text my-4 px-3"><?= nl2br($data['post']->content) ?></p>

			    <a href="<?= URL . '/Comments/createComment/' . $data['post']->id  ?>" class="btn btn-primary bg-gradient">Create a comment</a>

			    <?php
			    if (isset($data['postAllowedActions']['updatePost']) === true) {
			    	echo '<a href="' . URL . '/Posts/updatePost/'. $data['post']->id .'" class="btn btn-outline-dark">Edit post</a> ';
			    }

			    if (isset($data['postAllowedActions']['deletePost']) === true) {
			    	echo '<a href="' . URL . '/Posts/deletePost/'. $data['post']->id .'" class="btn btn-outline-dark">Delete post</a>';
			    }

			    if (count($data['post']->comments) > 0) {
			    	echo '<h5 class="card-title my-4">Comments:</h5>';
				}

			    foreach($data['post']->comments as $comment) {
			    ?>
					<div class="mx-3 mb-3 card">
						<div class="card-body">
							<span class="card-subtitle text-muted">Comment by: </span>
								<a href="<?= URL . '/Profile/viewProfile/' . $comment->user->username ?>" class="card-subtitle mb-2 text-muted"><?= $comment->user->username ?></a>
							    <span>|  </span>

							    <span class="card-subtitle mb-2 text-muted">Last update: <?= date('Y-M-d h:i', strtotime($comment->updated_at)) ?></span>

							    <p class="card-text mt-3"><?= $comment->content ?></p>

							    <?php
							    	if (isset($data[$comment->id]['commentAllowedActions']['updateComment']) === true) {
									   	echo '<a href="' . URL . '/Comments/updateComment/'. $comment->id .'" class="btn btn-outline-dark">Edit comment</a> ';
									    }

									if (isset($data[$comment->id]['commentAllowedActions']['deleteComment']) === true) {
								    	echo '<a href="' . URL . '/Comments/deleteComment/'. $comment->id .'" class="btn btn-outline-dark">Delete comment</a>';
								    }
							    ?>
						</div>
					</div>
				<?php
			    }
			    ?>
			</div>
		</div>
	</div>
</div>