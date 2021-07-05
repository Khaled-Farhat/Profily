<div class="container-fluid bg-light py-4">
	<div class="container">
		<form action="<?= URL . '/Posts/createPost' ?>" method="POST">
		 	<div class="mb-3">
			    <label for="titleInput" class="form-label">Title</label>
			    <input type="text" name="title" class="form-control" id="titleInput" required maxlength="256">
		  	</div>
		 	<div class="mb-3">
		    	<label for="contentInput" class="form-label">Content</label>
		    	<textarea name="content" class="form-control" id="contentInput" rows=16 required></textarea>
			</div>
			<button type="submit" class="btn btn-primary bg-gradient">Create Post</button>
		</form>
	</div>
</div>