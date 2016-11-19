<?php
// set page headers
$page_title = "New Products Header title2";
include_once "header.php"; ?>

			<div class="row">
				<h1><strong>Products app - Product List</strong></h1>
			</div>

			<div class="row">
				<p>
					<a href="index.php?op=new" class="btn btn-success">Add New Product</a>
				</p>
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
						<?php foreach ($products as $product) : ?>
							<tr>
								<td><?php echo htmlentities($product->id);  ?></td>
								<td><?php echo htmlentities($product->part_number); ?></td>
								<td><?php echo htmlentities($product->description); ?></td>

								<td> <a href="index.php?op=show&id=<?php echo $product->id; ?>">
									<img class="img-responsive" src="product_images/<?php echo $product->image; ?>"> </td>
									</a>
								<td><?php echo htmlentities($product->stock_quantity); ?></td>
								<td><?php echo htmlentities($product->cost_price); ?></td>
								<td><?php echo htmlentities($product->selling_price); ?></td>

								<td><?php echo htmlentities($product->vat_rate); ?></td>
								<td>
									<a class="btn btn-info" href="index.php?op=show&id=<?php echo $product->id; ?>">View</a>

									<a class="btn btn-success" href="index.php?op=edit&id=<?php echo $product->id; ?>">Update</a>
									<a class="btn btn-danger" href="index.php?op=delete&id=<?php echo $product->id; ?>">Delete</a>
								</td>

							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<?php
			include_once "footer.php";
			?>
