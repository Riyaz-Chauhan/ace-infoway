<?php
include "layouts/header.php";
?>
<form method="POST" id="category_form" action="/ace_practical/public/update-category">
	<input type="hidden" name="id" value="<?= $categoryData['id']; ?>">
	<div class="form-group">
		<label for="name">Category Name:</label>
		<input type="text" id="name" name="name" class="form-control" value="<?= htmlspecialchars($categoryData['name']); ?>" required>
	</div>
	<button type="submit" class="btn btn-primary">Update</button>
	<a href="/ace_practical/public/list-category" class="btn btn-danger">Back</a>
</form>
<?php
include "layouts/footer.php";
?>
<script>
	$("#category_form").validate();
</script>