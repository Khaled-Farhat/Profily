<div class="container-fluid bg-light py-4">
	<div class="container">
		<form action="<?= URL . '/Posts/updatePost/' . $data['post']->id ?>" method="POST">
		 	<div class="mb-3">
			    <label for="titleInput" class="form-label">Title</label>
			    <input type="text" name="title" class="form-control" id="titleInput" value="<?= $data['post']->title?>" required>
		  	</div>
		 	<div class="mb-3">
		    	<label for="contentInput" class="form-label">Content</label>
		    	<textarea name="content" class="form-control" id="contentInput" rows=16 required><?= $data['post']->content?></textarea>
			</div>
			<button type="submit" class="btn btn-primary bg-gradient">Edit post</button>
		</form>
	</div>
</div>