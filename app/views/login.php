<?php
include "layouts/header.php";
?>

<h2>Login</h2>
<form method="POST" action="/ace_practical/public/login">
	<div class="form-group">
		<label>Email:</label>
		<input type="email" name="email" class="form-control" required>
	</div>
	<div class="form-group">
		<label>Password:</label>
		<input type="password" name="password" class="form-control" required>
	</div>
	<button type="submit" class="btn btn-primary">Login</button>
	<a href="/ace_practical/public/register" class="btn btn-dark">Register</a>
	<a href="/ace_practical/public/forgot-password" class="text-dark">Forgot passowrd?</a>
</form>

<?php
include "layouts/footer.php";
?>