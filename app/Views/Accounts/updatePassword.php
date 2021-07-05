<div class="container-fluid bg-light py-5">
	<div class="container">
		<form action="<?= URL . '/Accounts/updatePassword' ?>" method="POST">
		  	<div class="mb-3">
			    <label for="passwordInput" class="form-label">New password</label>
			    <input type="password" name="password" class="form-control" id="passwordInput" required maxlength="32">
		 	 </div>
		 	<button type="submit" class="btn btn-primary bg-gradient">Update password</button>
		</form>
	</div>
</div>