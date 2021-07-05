<div class="container-fluid bg-light py-4">
	<div class="container">
		<?php
		if (array_key_exists('posts', $data) === true && empty($data['posts']) === false) {
			foreach ($data['posts'] as $post) {
			?>
				<div class="shadow-sm card col-12 my-3">
				  <div class="card-body">
				    <h5 class="card-title"><?= $post->title ?></h5>

				 	<span class="card-subtitle text-muted">Author: </span>
				    <a href="<?= URL . '/Profile/viewProfile/' . $post->user->username ?>" class="card-subtitle mb-2 text-muted"><?= $post->user->username ?></a>
				    <span>|  </span>

				    <span class="card-subtitle mb-2 text-muted">Last update: <?= date('Y-M-d h:i', strtotime($post->updated_at)) ?></span>

				    <p class="card-text mt-3"><?= nl2br(substr($post->content, 0, 300) . '..') ?></p>

				    <a href="<?= URL . '/Posts/viewPost/' . $post->id  ?>" class="btn btn-primary bg-gradient">Continue reading</a>

				    <?php
				    if (isset($data[$post->id]['postAllowedActions']['updatePost']) === true) {
				    	echo '<a href="' . URL . '/Posts/updatePost/'. $post->id .'" class="btn btn-outline-dark">Edit post</a> ';
				    }

				    if (isset($data[$post->id]['postAllowedActions']['deletePost']) === true) {
				    	echo '<a href="' . URL . '/Posts/deletePost/'. $post->id .'" class="btn btn-outline-dark">Delete post</a>';
				    }
				    ?>
				  </div>
				</div>	
			<?php
				}
			}
		?>
	</div>
</div>