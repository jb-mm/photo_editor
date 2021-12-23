<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<base href="<?= base_url(); ?>">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title><?= title(); ?></title>
		
		<link rel="icon" href="assets/favicon/favicon.ico">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/mycss.css">
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container-fluid">
				<?php if ($this->session->has_userdata('name')): ?>
				<a class="navbar-brand" href="home"><?= title(); ?></a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						
					</ul>
					<div class="d-flex">
						<ul class="navbar-nav mb-2 mb-lg-0">
							<a class="nav-link" href="logout" title="Click to logout"><?= $this->session->userdata('name'); ?></a>
						</ul>
					</div>
				</div>
				<?php else: ?>
				<a class="navbar-brand" href="" onClick="return false"><?= title(); ?></a>
				<?php endif; ?>
			</div>
		</nav>
		
		<?php $this->load->view($content); ?>
		
		<script src="assets/js/jquery-3.5.1.slim.min.js"></script>
		<script src="assets/js/bootstrap.bundle.min.js"></script>
		<script>
			(function() {
				'use strict';
				// pagination css
				if (!$(".page-item").hasClass("page-link")) {
					$(".page-item a").addClass("page-link")
				}
			})()

			function copyTo(name) {
				var copyText = document.getElementById(name)
				// console.log(copyText.value)
				copyText.select()
				copyText.setSelectionRange(0, 99999) /* For mobile devices */
				navigator.clipboard.writeText(copyText.value)
				// alert(copyText.value)
			}
		</script>
	</body>
</html>