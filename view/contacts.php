<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link href="http://localhost/projects/dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="http://localhost/projects/dist/js/bootstrap.min.js"></script>
		<title>CRUD App </title>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<h1><strong>CRUD app - Contact List</strong></h1>
			</div>

			<div class="row">
				<p>
					<a href="index.php?op=new" class="btn btn-success">Create</a>
				</p>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th><a href="?orderby=name">Name</a></th>
							<th><a href="?orderby=email">Email Address</a></th>
							<th><a href="?orderby=phone">Mobile Number</a></th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>
						<?php foreach ($products as $product) : ?>
							<tr>
								<td><?php echo htmlentities($product->name);  ?></td>
								<td><?php echo htmlentities($product->email); ?></td>
								<td><?php echo htmlentities($product->phone); ?></td>
								<td>
									<a class="btn btn-info" href="index.php?op=show&id=<?php echo $product->id; ?>">View</a>
									<a class="btn btn-success" href="index.php?op=edit&id=<?php echo $product->id; ?>">Update</a>
									<a class="btn btn-danger" href="index.php?op=delete&id=<?php echo $product->id; ?>">Delete Contact</a>
								</td>

							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>
