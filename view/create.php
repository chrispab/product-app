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

				<form action="" method="post">
					<div class="form-group">
						<label class="form-label">Part Number</label>
							<div class="form-control">
								<input type="text" name="part_number" placeholder="Part Number" value="<?php echo htmlentities($name); ?>">
							</div>
					</div>
					<div class="form-group">
						<label class="form-label">Description</label>
							<div class="form-control">
								<input type="text" name="name" placeholder="Description" value="<?php echo htmlentities($name); ?>">
							</div>
					</div>
					<div class="form-group">
						<label class="form-label">Name</label>
							<div class="form-control">
								<input type="text" name="name" placeholder="Name" value="<?php echo htmlentities($name); ?>">
							</div>
					</div>
					<div class="form-group">
						<label class="form-label">Name</label>
							<div class="form-control">
								<input type="text" name="name" placeholder="Name" value="<?php echo htmlentities($name); ?>">
							</div>
					</div>
					<br>
					<div class="form-actions">
						<input type="hidden" name="form-submitted" value="1">
						<button type="submit" class="btn btn-success">Create</button>
						<a class="btn btn-default" href="index.php">Back</a>
					</div>
				</form>
			</div>
			<?php
			include_once "footer.php";
			?>
