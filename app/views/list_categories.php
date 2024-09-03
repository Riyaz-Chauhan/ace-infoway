<?php
include "layouts/header.php";
?>
<section>
	<div class="add_category text-right mb-3">
		<a href="/ace_practical/public/create-category" class="btn btn-primary">Add Category</a>
	</div>
	<table id="category_list" class="table table-striped table-bordered" style="width:100%">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Created At</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
				<tr>
					<td><?= $row['id']; ?></td>
					<td><?= $row['name']; ?></td>
					<td><?= date("d-m-Y", strtotime($row['created_at'])); ?></td>
					<td><a href="/ace_practical/public/edit-category?id=<?= $row['id']; ?>" class="btn btn-primary mr-2">Edit</a></td>
				</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
</section>
<?php
include "layouts/footer.php";
?>
<script>
	new DataTable('#category_list')
</script>