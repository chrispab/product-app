<?php
$page_title = "Update Product";
include_once "header.php"; ?>

<div class="row">
	<h3><strong>Update product</strong></h3>
	<?php
		if ($errors) {
			echo '<ul class="errors">';
			foreach ($errors as $field => $error) {
				echo '<li>' . htmlentities($error) . '</li>';
			}
			echo '</ul>';
		}
	?>
</div>

	<form action="index.php?op=edit" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="part_number">ID Hidden here: </label>
	        <input type="text" class="form-control" name="id" id="id" value=<?php echo $product->id; ?> required autofocus>
		</div>
		<div class="form-group">
			<label for="part_number">Part Number: </label>
	        <input type="text" class="form-control" name="part_number" id="part_number" value=<?php echo $product->part_number; ?> required autofocus>
		</div>
		<div class="form-group">
			<label for="description">Description: </label>
	        <textarea class="form-control" name="description" rows="10" cols="30" id="description"><?php echo $product->description; ?></textarea>
		</div>
		<div class="form-group">
			<label for="image">Image: </label>
			<img class="img-responsive" src="product_images/<?php echo $product->image; ?>">
			<input type="file" name="imagefile"  id="image" value="<?php echo $product->image; ?>" >
		</div>
		<div class="form-group">
			<label for="stock_quantity">Stock Quantity: </label>
			<input type="text" name="stock_quantity" id="stock_quantity"  class="form-control" placeholder="Stock Quantity" value=<?php echo $product->stock_quantity; ?> required>
		</div>
		<div class="form-group">
			<label for="cost_price">Cost Price: </label>
			<input type="text"  name="cost_price" class="form-control" id="cost_price" value=<?php echo $product->cost_price; ?> required>
		</div>
		<div class="form-group">
			<label for="selling_price">Selling Price: </label>
			<input type="text"  name="selling_price" class="form-control" id="selling_price" value=<?php echo $product->selling_price; ?> required>
		</div>
		<div class="form-group">
			<label for="vat_rate">Vat Rate: </label>
			<input type="text"  name="vat_rate" class="form-control" id="vat_rate" value=<?php echo $product->vat_rate; ?> required>
		</div>

		<input type="hidden" name="btn-save-updates" value="1">
		<button type="submit" class="btn btn-success">Update</button>
		<a class="btn btn-default" href="index.php">Back</a>
	</form>
</div>
<?php include_once "footer.php";?>
