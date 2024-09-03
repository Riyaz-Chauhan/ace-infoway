<?php
include "layouts/header.php";
?>
<form method="POST" id="product_form" action="/ace_practical/public/update-product">
	<input type="hidden" name="id" value="<?= $productData['id']; ?>">
	<div class="form-group"></div>
		<label for="name">Product Name:</label>
		<input type="text" id="name" name="name" class="form-control" value="<?= htmlspecialchars($productData['name']); ?>" required>
	<div class="form-group">
		<label for="price">Price:</label>
		<input type="number" id="price" name="price" class="form-control"  value="<?= htmlspecialchars($productData['price']); ?>" required>
	</div>

	<div class="form-group">
		<label for="category_id">Category:</label>
		<select id="category_id" name="category_id" class="form-control" >
			<?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
				<option value="<?= $row['id'] ?>" <?= $productData['category_id'] == $row['id'] ? 'selected' : ''; ?>><?= $row['name'] ?></option>
			<?php endwhile; ?>
			
		</select>
	</div>
	<button type="submit" class="btn btn-primary">Update</button>
	<a href="/ace_practical/public/list-products" class="btn btn-danger">Back</a>
</form>
<?php
include "layouts/footer.php";
?>
<script>
	$("#product_form").validate();
</script>