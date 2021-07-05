<footer class="container-flud bg-white py-4 border-top">
	<span class="border-top"></span>
	<div class="container text-center">
		All rights reserved.
	</div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
	let toastElements = document.querySelectorAll('.toast');

	Array.from(toastElements).forEach(function(toastElement) {
		let toast = new bootstrap.Toast(toastElement, {autohide: false});
		toast.show();
	});

</script>
</body>
</html>