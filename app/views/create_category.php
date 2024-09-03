<?php
include "layouts/header.php";
?>
<form method="POST" id="category_form" action="/ace_practical/public/create-category">
	<div class="form-group">
		<label for="category_name">Category Name</label>
		<input type="text" name="name" class="form-control" id="category_name" placeholder="Enter category name" required>
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
	<a href="/ace_practical/public/list-categories" class="btn btn-dark">Back</a>
</form>
<?php
include "layouts/footer.php";
?>
<script>
	$("#category_form").validate();
</script>