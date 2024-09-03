<?php
include "layouts/header.php";
?>
<form method="POST" id="product_form" action="/ace_practical/public/create-product">
	<div class="form-group">
		<label>Product Name:</label>
		<input type="text" name="name" class="form-control" required>
	</div>
	<div class="form-group">
		<label>Category:</label>
		<select name="category_id" class="form-control" required>
			<option value="">Select category</option>
			<?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
				<option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
			<?php endwhile; ?>
		</select>
	</div>
	<div class="form-group">
		<label>Price:</label>
		<input type="number" name="price" class="form-control" required>
	</div>
	<button type="submit" class="btn btn-primary">Create Product</button>
</form>
<?php
include "layouts/footer.php";
?>
<script>
	$("#product_form").validate();
</script>