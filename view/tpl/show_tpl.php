<?php
include "includes/header.php";
include "includes/navbar.php";
?>
<div class="container">
	<h3><strong>View Product Details</strong></h3>
	<table class="table table-bordered table-responsive">
		<thead>
			<tr>
			<th>Item</th>
			<th>Value</th>
		</tr>
		</thead>
		<tbody>
				<tr>
				<td>ID :</td>
				<td><?php echo $product->id; ?></td>
			</tr>
				<tr>
				<td>Part Number :</td>
				<td><?php echo $product->part_number; ?></>
				</tr>
			<tr>
				<td>Description :</td>
				<td><?php echo $product->description; ?></>
			</tr>
			<tr>
				<td>Image :</td>
				<td><img class="img-responsive" src="product_images/<?php echo $product->image; ?>" width="400"></td>
			</tr>
				<tr>
				<td>Stock Quantity :</td>
				<td><?php echo $product->stock_quantity; ?></>
				</tr>
			<tr>
				<td>Cost Price :</td>
				<td><?php echo $product->cost_price; ?></>
			</tr>
			<tr>
				<td>Selling Price :</td>
				<td><?php echo $product->selling_price; ?></td>
			</tr>
				<tr>
				<td>VAT rate :</td>
				<td><?php echo $product->vat_rate; ?></>
				</tr>
		</tbody>
		</table>
	<a class="btn btn-success" href="index.php?op=edit&id=<?php echo $product->id; ?>">
		<span class="glyphicon glyphicon-pencil"></span>
		Update</a>

	<a class="btn btn-danger" href="index.php?op=delete&id=<?php echo $product->id; ?>">
		<span class="glyphicon glyphicon-trash"></span>
		Delete</a>
	<a class="btn btn-success" href="index.php?op=list">
		<span class="glyphicon glyphicon-step-backward"></span>
		Back</a>
</div>
<?php
include "includes/footer.php";
?>
