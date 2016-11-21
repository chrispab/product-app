<?php
    //require 'database.php';
    $id = 0;

    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

    if ( !empty($_POST)) {//here if delete butt on delete page pressed
        // keep track post values
        $id = $_POST['id'];

        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM products  WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: index.php?op=list");

    }
?>

<?php
include_once "header.php";
include_once "navbar.php"
?>
<div id="products" class="container">
    <div class="well">
                    <div class="row">
                        <h3>Delete a Product</h3>
                    </div>

                    <form  action="" method="post">
                      <input type="hidden" name="id" value="<?php echo $id;?>"/>
                      <p class="alert alert-error">Are you sure you wish to delete this product?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="index.php?op=list">No</a>
                        </div>
                    </form>
    </div>
</div>

                <?php
    			include_once "footer.php";
    			?>
