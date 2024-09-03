<?php
include "layouts/header.php";
?>
<section>
	<div class="add_product text-right mb-3">
		<a href="/ace_practical/public/create-product" class="btn btn-primary">Add Product</a>
	</div>
	<table id="product_list" class="table table-striped table-bordered" style="width:100%">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Category</th>
				<th>Price</th>
				<th>Created At</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
				<tr>
					<td><?= $row['id']; ?></td>
					<td><?= $row['name']; ?></td>
					<td><?= $row['c_name']; ?></td>
					<td><?= $row['price']; ?></td>
					<td><?= date("d-m-Y", strtotime($row['created_at'])); ?></td>
					<td><a href="/ace_practical/public/edit-product?id=<?= $row['id']; ?>" class="btn btn-primary">Eidt</a>
						<a href="/ace_practical/public/delete-product?id=<?= $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?');" class="btn btn-danger">Delete</a></td>
				</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
</section>
<?php
include "layouts/footer.php";
?>
<script>
	new DataTable('#product_list')
</script>