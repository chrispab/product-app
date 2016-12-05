<?php
include "includes/header.php";
include "includes/navbar.php";
?>
<div id="products" class="container">
    <div class="well">
            <div class="row">
                <h3>Delete a Product</h3>
            </div>

        <form  action="index.php?op=delete&id=<?php echo $product->id;?>" " method="post">
          <input type="hidden" name="id" value="<?php echo $product->id;?>"/>
          <p class="alert alert-error">Are you sure you want to delete this product?</p>
          <img class="img-responsive" src="product_images/<?php echo $product->image; ?>" width="150">
          <p class="alert alert-error">Part Number: <?php echo "<i class='text-danger'> {$product->part_number}</i>";?> </p>
          <p class="alert alert-error">Description: <?php echo "<i class='text-danger'> {$product->description}</i>";?> </p>
          <div class="form-actions">
              <input type="hidden" name="delete-product" value="1">
              <button type="submit" class="btn btn-danger">Yes</button>
              <a class="btn btn-success" href="index.php?op=list">Cancel</a>
          </div>
        </form>
    </div>
</div>

<?php
include "includes/footer.php";
?>
