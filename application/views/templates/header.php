<html>

<head>
	<title>CI Blog</title>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
	<script src="http://cdn.ckeditor.com/4.7.1/full/ckeditor.js"></script>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="href=" <?php echo base_url(); ?>"">Navbar</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Link</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Dropdown
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="#">Action</a>
						<a class="dropdown-item" href="#">Another action</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Something else here</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php if (!$this->session->userdata('login')) : ?>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>register">Register</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>login">Login</a></li>
				<?php endif; ?>
				<?php if ($this->session->userdata('login')) : ?>
					<!-- <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>users/dashboard"><?php echo $this->session->userdata('username'); ?></a></li> -->
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>users/logout">Logout</a></li>
				<?php endif; ?>
			</ul>

		</div>
	</nav>

	

	<div class="container">

		<!-- Flash Messages -->
		<?php if ($this->session->flashdata('user_registered')) : ?>
			<?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_registered') . '</p>'; ?>
		<?php endif; ?>

		<?php if ($this->session->flashdata('post_created')) : ?>
			<?php echo '<p class="alert alert-success">' . $this->session->flashdata('post_created') . '</p>'; ?>
		<?php endif; ?>

		<?php if ($this->session->flashdata('post_updated')) : ?>
			<?php echo '<p class="alert alert-success">' . $this->session->flashdata('post_updated') . '</p>'; ?>
		<?php endif; ?>

		<?php if ($this->session->flashdata('category_created')) : ?>
			<?php echo '<p class="alert alert-success">' . $this->session->flashdata('category_created') . '</p>'; ?>
		<?php endif; ?>

		<?php if ($this->session->flashdata('post_deleted')) : ?>
			<?php echo '<p class="alert alert-success">' . $this->session->flashdata('post_deleted') . '</p>'; ?>
		<?php endif; ?>

		<?php if ($this->session->flashdata('login_failed')) : ?>
			<?php echo '<p class="alert alert-danger">' . $this->session->flashdata('login_failed') . '</p>'; ?>
		<?php endif; ?>

		<?php if ($this->session->flashdata('user_loggedin')) : ?>
			<?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_loggedin') . '</p>'; ?>
		<?php endif; ?>

		<?php if ($this->session->flashdata('user_loggedout')) : ?>
			<?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_loggedout') . '</p>'; ?>
		<?php endif; ?>

		<?php if ($this->session->flashdata('category_deleted')) : ?>
			<?php echo '<p class="alert alert-success">' . $this->session->flashdata('category_deleted') . '</p>'; ?>
		<?php endif; ?>