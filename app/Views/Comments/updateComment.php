<div class="container-fluid bg-light py-5">
	<div class="container">
		<form action="<?= URL . '/Comments/updateComment/' . $data['comment']->id ?>" method="POST">
		  	<div class="mb-3">
			    <label for="commentInput" class="form-label">New Comment</label>
			    <textarea name="content" class="form-control" id="commentInput" required rows="4" maxlength="512"><?= $data['comment']->content ?></textarea>
		 	 </div>
		 	<button type="submit" class="btn btn-primary bg-gradient">Update comment</button>
		</form>
	</div>
</div>