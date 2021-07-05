<div class="container-fluid bg-light py-5">
	<div class="container">
		<form action="<?= URL . '/Comments/createComment/' . $data['postId'] ?>" method="POST">
		  	<div class="mb-3">
			    <label for="commentInput" class="form-label">Comment</label>
			    <textarea name="content" class="form-control" id="commentInput" rows=4 required maxlength="512"></textarea>
		 	 </div>
		 	<button type="submit" class="btn btn-primary bg-gradient">Create comment</button>
		</form>
	</div>
</div>