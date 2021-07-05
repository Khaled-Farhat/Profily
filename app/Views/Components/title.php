<div class="container-fluid bg-primary py-5 bg-gradient">
	<div class="container">
	<h1 class="display-6 text-white"><?= $data['pageTitle'] ?></h1>
	<?php
	if (array_key_exists('pageAllowedActions', $data) === true) {
		if (empty($data['pageAllowedActions']) === false) {
			foreach ($data['pageAllowedActions'] as $action => $url) {
				echo '<a href="' . $url . '" class="btn btn-outline-light mt-3">' . $action . '</a> ';
			}
		}
	}
	?>
	</div>
</div>