<?php
include_once "header.php";
include_once "navbar.php"
?>
<div class="container">

	<div class="row">
		<h1><strong>List Products</strong></h1>
	</div>

		<p><a href="index.php?op=new" class="btn btn-success">Add New Product</a></p>


			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th><a href="?orderby=id">id</a></th>
							<th><a href="?orderby=part_number">Part Number</a></th>

							<th><a href="?orderby=description">Description</a></th>
							<th><a href="?orderby=image">Image</a></th>
							<th><a href="?orderby=stock_quantity">Stock Quantity</a></th>
							<th><a href="?orderby=cost_price">Cost Price</a></th>
							<th><a href="?orderby=selling_price">Selling Price</a></th>
							<th><a href="?orderby=phone">Vat rate</a></th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>
						<?php foreach ($product as $prod) : ?>
							<tr>
								<td><?php echo htmlentities($prod->id);  ?></td>
								<td><?php echo htmlentities($prod->part_number); ?></td>
								<td ><?php echo htmlentities($prod->description); ?></td>

								<td> <a href="index.php?op=show&id=<?php echo $prod->id; ?>">
									<img class="img-responsive" src="product_images/<?php echo $prod->image; ?>">
									</a></td>
								<td><?php echo htmlentities($prod->stock_quantity); ?></td>
								<td><?php echo htmlentities($prod->cost_price); ?></td>
								<td><?php echo htmlentities($prod->selling_price); ?></td>

								<td><?php echo htmlentities($prod->vat_rate); ?></td>
								<td>
									<a class="btn btn-info" href="index.php?op=show&id=<?php echo $prod->id; ?>">View</a>

									<a class="btn btn-success" href="index.php?op=edit&id=<?php echo $prod->id; ?>">Update</a>
									<a class="btn btn-danger" href="index.php?op=delete&id=<?php echo $prod->id; ?>">Delete</a>
								</td>

							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>



</div>
			<?php
			include_once "footer.php";
			?>
