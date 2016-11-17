<?php
// set page headers
$page_title = "New Products Header title2";
include_once "header.php"; ?>
				<div class="row">
					<h3><strong>Add a new product</strong></h3>
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
<?php //echo($_FILES["imagefile"]["name"]); ?>
				<form action="index.php?op=new" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="part_number">Part Number: </label>
				        <input type="text" class="form-control" name="part_number" id="part_number" placeholder="Part Number" required autofocus>
					</div>
					<div class="form-group">
						<label for="description">Description: </label>
				        <textarea class="form-control" name="description" rows="10" cols="30" id="description">Please enter a description.</textarea>
					</div>
					<div class="form-group">
						<label for="image">Image: </label>
						<input type="file" name="imagefile"  id="image">
					</div>
					<div class="form-group">
						<label for="stock_quantity">Stock Quantity: </label>
						<input type="text" name="stock_quantity" id="stock_quantity"  class="form-control" placeholder="Stock Quantity" required>
					</div>
					<div class="form-group">
						<label for="cost_price">Cost Price: </label>
						<input type="text"  name="cost_price" class="form-control" id="cost_price" placeholder="Cost Price" required>
					</div>
					<div class="form-group">
						<label for="selling_price">Selling Price: </label>
						<input type="text"  name="selling_price" class="form-control" id="selling_price" placeholder="Selling Price" required>
					</div>
					<div class="form-group">
						<label for="vat_rate">Vat Rate: </label>
						<input type="text"  name="vat_rate" class="form-control" id="vat_rate" placeholder="VAT Rate" required>
					</div>

					<input type="hidden" name="add-new-product" value="1">
					<button type="submit" class="btn btn-success">Create</button>
					<a class="btn btn-default" href="index.php">Back</a>

				</form>
			</div>
			<?php
			include_once "footer.php";
			?>
