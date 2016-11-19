<!DOCTYPE HTML>
<html lang="en">
	<head>

		<meta charset="utf-8">
 		<meta http-equiv="X-UA-Compatible" content="IE=edge">
 		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Bootstrap -->
	    <link href="css/bootstrap.min.css" rel="stylesheet">

		<title>View Product Details</title>
	</head>

	<body>
		<div class="container">
			<!-- <div class="span10 offset 1"> -->
			<h3><strong>View Product Details</strong></h3>
			<table class="table table-bordered">
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
        				<td><img class="img-responsive" src="product_images/<?php echo $product->image; ?>"></td>
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
			<!-- <ul class="list-group">
				<li class="list-group-item">id <?php echo $product->id; ?><span class="badge">12</span></li>
				<li class="list-group-item">Product Number <?php echo $product->part_number; ?> <span class="badge">5</span></li>
				<li class="list-group-item">Warnings <span class="badge">3</span></li>
			</ul> -->


		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
