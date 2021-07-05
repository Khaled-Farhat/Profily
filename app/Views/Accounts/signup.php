<div class="container-fluid bg-light py-5">
	<div class="container">
		<form action="<?= URL . '/Signup' ?>" method="POST">
		 	<div class="mb-3">
			    <label for="usernameInput" class="form-label">Username</label>
			    <input type="text" name="username" class="form-control" id="usernameInput" required maxlength="32">
		  	</div>
		  	<div class="mb-3">
			    <label for="passwordInput" class="form-label">Password</label>
			    <input type="password" name="password" class="form-control" id="passwordInput" required maxlength="32">
		 	 </div>
		 	<button type="submit" class="btn btn-primary bg-gradient">Signup</button>
		</form>
	</div>
</div>