<!DOCTYPE html>
<html lang="en">
	<head>
		<base href="<?= base_url(); ?>">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title><?= title(); ?></title>

		<link rel="icon" href="assets/favicon/favicon.ico">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/form-signin.css">
	</head>
	<body class="text-center">
		<main class="form-signin">
			<h1 class="h3 mb-3 fw-normal">Log In</h1>

			<?php if ($this->session->flashdata('msg') > 0): ?>
				<?php if ($this->session->flashdata('msg') > 3): ?>
			<div class="alert alert-warning" role="alert">
				<?php else: ?>
			<div class="alert alert-danger" role="alert">
				<?php endif; ?>
				<?= error_msg($this->session->flashdata('msg')); ?>
			</div>
			<?php endif; ?>
			<?= form_open('login'); ?>
			    <div class="form-floating">
					<input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username ..">
					<label for="floatingInput">Username</label>
			    </div>
			    <div class="form-floating">
					<input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password ..">
					<label for="floatingPassword">Password</label>
			    </div>
			    <button class="w-100 btn btn-lg btn-outline-success btn-rounded" type="submit">Sign in</button>
			    <p class="mt-5 mb-3 text-muted">&copy; 2021<?= (date('Y') == '2021') ? '' : '-'.date('Y') ?></p>
			<?= form_close(); ?>
		</main>
		
		<script src="assets/js/jquery-3.5.1.slim.min.js"></script>
		<script src="assets/js/bootstrap.bundle.min.js"></script>
	</body>
</html>