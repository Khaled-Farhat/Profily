<div class="container-fluid bg-primary bg-gradient">
	<div class="container py-5">
		<div class="row justify-content-center mt-5 mb-5">
			<div class="col-xxl-6 col-xl-6 col-lg-8 col-md-9 col-sm-8 col-6">
				<h1 class="display-6 text-white">Writing made easy!</h1>
				<p class="mt-3 mb-4 text-white">
					Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups. Lorem ipsum is placeholder text commonly used in the graphic.
				</p>
				<div class="d-flex">
					<a class="btn btn-outline-light mx-1" href="<?= URL . '/Profile/viewProfile/' . $data['loggedinUsername'] ?>">My Profile</a>
	       	 		<a class="btn btn-warning mx-1" href="<?= URL . '/Posts/createPost' ?>">Create a post</a>
				</div>
			</div>
			<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6">
				<div class="row justify-content-center">
					<svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="currentColor" class="bi bi-pencil-square text-light" viewBox="0 0 16 16">
					 	<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
					 	<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
					</svg>
				</div>
			</div>
		</div>
	</div>
</div>