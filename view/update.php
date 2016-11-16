<?php
// set page headers
$page_title = "New Products Header title2";
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

				<form class="form-horizontal" action="" method="post">
					<div class="control-group">
						<label class="control-label">ID</label>
							<div class="controls">
								<input type="text" name="id" placeholder="ID" value="<?php echo htmlentities($product->id); ?>">
								<span class="help-inline"></span>
							</div>
					</div>

					<div class="control-group">
						<label class="control-label">Part Number</label>
							<div class="controls">
								<input type="text" name="part_number" placeholder="Part Number" value="<?php echo htmlentities($product->part_number); ?>">
								<span class="help-inline"></span>
							</div>
					</div>

					<div class="control-group">
						<label class="control-label">Description</label>
							<div class="controls">
								<input type="text" name="description" placeholder="Description" value="<?php echo htmlentities($product->description); ?>">
								<span class="help-inline"></span>
							</div>
					</div>
					<br>
					<div class="form-actions">
						<input type="hidden" name="form-submitted" value="1">
						<button type="submit" class="btn btn-success">Update</button>
						<a class="btn btn-default" href="index.php">Back</a>
					</div>
				</form>
			</div>
			<?php
			include_once "footer.php";
			?>
