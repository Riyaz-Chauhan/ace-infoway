<?php
include "layouts/header.php";
?>
<h2>Register</h2>
<form method="POST" action="/ace_practical/public/register">
	<div class="form-group">
		<label>Username:</label>
		<input type="text" name="username" class="form-control" required>
	</div>
	<div class="form-group">
		<label>Email:</label>
		<input type="email" name="email" class="form-control" required>
	</div>
	<div class="form-group">
		<label>Password:</label>
		<input type="password" name="password" class="form-control" required>
	</div>
	<button type="submit" class="btn btn-primary">Register</button>
	<a href="/ace_practical/public/login" class="btn btn-dark">Login</a>
</form>
<?php
include "layouts/footer.php";
?>