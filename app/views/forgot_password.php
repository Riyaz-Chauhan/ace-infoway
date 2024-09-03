<?php
include "layouts/header.php";
?>
<h2>Reset Password</h2>
<form method="POST" action="/ace_practical/public/forgot-password">
    <div class="form-group">
        <label>Email:</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Reset Password</button>
	<a href="/ace_practical/public/login" class="btn btn-dark">Login</a>
</form>
<?php
include "layouts/footer.php";
?>