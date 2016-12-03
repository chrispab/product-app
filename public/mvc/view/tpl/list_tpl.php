<?php
include "includes/header.php";
include "includes/navbar.php";
?>

<div class="container">
	<h1><strong>All Products</strong></h1>
	<br>
		<p><a href="index.php?op=new" class="btn btn-success">
			<span class="glyphicon glyphicon-plus-sign"></span>
			Add a New Product</a></p>
	<?php foreach ($product as $prod) : ?>
		<div class="row  border">
	    <div class="col-sm-4 border" >
			<p class="text-left"><strong>Part Number:</strong><br><?php echo htmlentities($prod->part_number); ?></p>
			<p class="text-left" ><strong>Description:</strong><br><?php echo htmlentities($prod->description); ?></p>
	    </div>
	    <div class="col-sm-2 ">
	      <p><a href="index.php?op=show&id=<?php echo $prod->id; ?>" >
			  <img class="img-responsive" src="product_images/<?php echo $prod->image; ?>" class="img-thumbnail" width="100">
			  </a>
		  </p>
	    </div>
		<div class="col-sm-1">
		  <p class="text-left"><strong>In Stock:</strong><br><?php echo htmlentities($prod->stock_quantity); ?></p>
		</div>
		<div class="col-sm-1">
		  <p class="text-left"><strong>Cost Price:</strong><br>£<?php echo htmlentities($prod->cost_price); ?></p>
	  	</div>
		<div class="col-sm-1">
		  <p class="text-left"><strong>Selling Price:</strong><br>£<?php echo htmlentities($prod->selling_price); ?></p>
		</div>
		<div class="col-sm-1">
		  <p class="text-left"><strong>VAT Rate:</strong><br><?php echo htmlentities($prod->vat_rate); ?>%</p>
	  	</div>
		<div class="col-sm-2">
			<br>
			<a class="btn btn-info" href="index.php?op=show&id=<?php echo $prod->id; ?>"><span class="glyphicon glyphicon-zoom-in"></span>View</a>
			<a class="btn btn-success" href="index.php?op=edit&id=<?php echo $prod->id; ?>"><span class="glyphicon glyphicon-pencil">Update</a>
			<a class="btn btn-danger" href="index.php?op=delete&id=<?php echo $prod->id; ?>"><span class="glyphicon glyphicon-trash"></span>Delete</a>
			<br><br><br><br>
		</div>
	</div>
<?php endforeach; ?>
</div>

<?php
include "includes/footer.php";
