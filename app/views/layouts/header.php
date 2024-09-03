<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Practical</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css" crossorigin="anonymous">
	<style>
		.error {
			color: red;
		}
	</style>
</head>

<body>
	<?php if (isset($_SESSION["user"])) { ?>
		<nav class="navbar navbar-light bg-light justify-content-between">
			<a class="navbar-brand">Welcome, <?= (isset($_SESSION["username"]) ? $_SESSION["username"] : "") ?></a>
			<div class="form-inline">
				<a href="/ace_practical/public/dashboard" class="btn btn-info mr-2">Home</a>
				<a href="/ace_practical/public/list-categories" class="btn btn-primary mr-2">Category List</a>
				<a href="/ace_practical/public/list-products" class="btn btn-warning">Product List</a>
			</div>
			<form class="form-inline" method="POST" action="/ace_practical/public/logout">
				<button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Logout</button>
			</form>
		</nav>
	<?php } ?>
	<div class="container mt-5">
		<?php
		if (isset($_SESSION['flash_message'])) {
			$flash = $_SESSION['flash_message'];

			echo '<div class="alert alert-' . htmlspecialchars($flash['type']) . ' mb-3">';
			echo htmlspecialchars($flash['message']);
			echo '</div>';

			unset($_SESSION['flash_message']);
		}
		?>