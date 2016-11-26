<?php
include_once "header.php";
include_once "navbar.php"
?>

<div class="container">
	 <p>Content here. <a class="alert" href=#>Alert!</a></p>
	<h3><strong>Add a new product</strong></h3>
	<h5 class='text-danger'><strong>* Required Information</strong></h5>

	<form method="post" enctype="multipart/form-data" action="index.php?op=new" >


		<div class="form-group">
			<label for="part_number">Part Number: <?php echo "<i class='text-danger'>* {$errors['part_number_err']}</i>";?> </label>
	        <input type="text" class="form-control" name="part_number" id="part_number" value="<?php echo $product->part_number; ?>"  placeholder="Part Number" required autofocus>
		</div>
		<div class="form-group">
			<label for="description">Description: <?php echo "<i class='text-danger'>* {$errors['description_err']}</i>";?> </label>
	        <textarea class="form-control" name="description" rows="10" cols="30" id="description"> <?php echo $product->description; ?> </textarea>
		</div>
		<div class="form-group">
			<label for="image">Image: <?php echo "<i class='text-danger'>* {$errors['image_err']}</i>";?> </label>
			<?php
			if (empty($product->image)) {
				$product->image = "placeholderimage.jpg";
			}
			?>
			<img class="img-responsive" src="product_images/<?php echo $product->image; ?>" >
			<input type="file" name="imagefile"  id="image"  >
		</div>
		<div class="form-group">
			<label for="stock_quantity">Stock Quantity: <?php echo "<i class='text-danger'>* {$errors['stock_quantity_err']}</i>";?> </label>
			<input type="text" name="stock_quantity" id="stock_quantity"  class="form-control" placeholder="Stock Quantity"  value="<?php echo $product->stock_quantity; ?>" required>
		</div>
		<div class="form-group">
			<label for="cost_price">Cost Price: <?php echo "<i class='text-danger'>* {$errors['cost_price_err']}</i>";?> </label>
			<input type="text"  name="cost_price" class="form-control" id="cost_price" placeholder="Cost Price"  value="<?php echo $product->cost_price; ?>" required>
		</div>
		<div class="form-group">
			<label for="selling_price">Selling Price: <?php echo "<i class='text-danger'>* {$errors['selling_price_err']}</i>";?> </label>
			<input type="text"  name="selling_price" class="form-control" id="selling_price" placeholder="Selling Price" value="<?php echo $product->selling_price; ?>"  required>
		</div>
		<div class="form-group">
			<label for="vat_rate">Vat Rate: <?php echo "<i class='text-danger'>* {$errors['vat_rate_err']}</i>";?> </label>
			<input type="text"  name="vat_rate" class="form-control" id="vat_rate" placeholder="VAT Rate"  value="<?php echo $product->vat_rate; ?>" required>
		</div>

		<input type="hidden" name="add-new-product" value="1">
		<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-save"></span>Save</button>
		<a class="btn btn-default" href="index.php?op=list">Back to list</a>
	</form>
</div>
</div>
<script>
	$(document).on("click", ".alert", function(e) {
		bootbox.alert("Product Created", function() {
			console.log("Alert Callback");
		});
	});
</script>

<?php
include_once "footer.php";
?>
