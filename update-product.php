<?php
include "config.php";
session_start();
if ($_SESSION['user_role'] == '0') {
    header("Location: {$hostname}/admin/dashboard.php");
}
if(isset($_POST['submit'])) {

    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $categories_id = mysqli_real_escape_string($conn, $_POST['categories_id']);
    $name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $rmp = mysqli_real_escape_string($conn, $_POST['rmp']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $qty = mysqli_real_escape_string($conn, $_POST['qty']);
    $image = mysqli_real_escape_string($conn, $_POST['image']);
    $short_description = mysqli_real_escape_string($conn, $_POST['short_description']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $meta_title = mysqli_real_escape_string($conn, $_POST['meta_title']);
    $meta_description = mysqli_real_escape_string($conn, $_POST['meta_description']);
    $meta_key = mysqli_real_escape_string($conn, $_POST['meta_key']);

    $sql = "SELECT product_name FROM product WHERE product_name= '{$name}'";
    $result =mysqli_query($conn,$sql) or die("failed query");
  
    if(mysqli_num_rows($result) > 0){
      echo "<p style='color:red;text-align:center;margin: 10px 0;'>category already Exists.</p>";
    }else{
     $sql = "UPDATE product SET categories_id = '{$categories_id}', product_name = '{$name}', rmp = '{$rmp}', price = '{$price}', qty = '{$qty}', image = '{$image}', short_description = '{$short_description}', description = '{$description}', meta_title = '{$meta_title}', meta_description = '{$meta_description}', meta_key = '{$meta_key}', status = '{1}' WHERE id = {$id}";

        if(mysqli_query($conn, $sql)){
            header("Location: {$hostname}/admin/product.php");
        }
    }

}


?>
<?php include "header.php" ?>
<?php include "sidebar.php" ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Update Product 1</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
            <?php
            
                $id = $_GET['id'];
                $sql = " SELECT * FROM product WHERE id = {$id}";
                $result = mysqli_query($conn, $sql) or die("Query Failed.");
                if(mysqli_num_rows($result) > 0){
                  $row = mysqli_fetch_assoc($result);
                  $id =$row['id'];
                  $categories_id =$row['categories_id'];
                  $product_name =$row['product_name'];
                  $rmp =$row['rmp'];
                  $price =$row['price'];
                  $qty =$row['qty'];
                  $short_description =$row['short_description'];
                  $description =$row['description'];
                  $meta_title =$row['meta_title'];
                  $meta_description =$row['meta_description'];
                  $meta_key =$row['meta_key'];
                
                }else{
                    header("Location: {$hostname}/admin/product.php");  die();
                }
                ?>

                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" >
                        <div class="form-group">
                            <input type="hidden" name="id" class="form-control" value="<?php echo $id  ?>">
                            <div class="form-group">

                                <label>Category Name </label>
                                <select class="form-control" name="categories_id">
                                    <?php $result = mysqli_query($conn, "SELECT id,categories from categories order by categories asc");
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        if($row['id']==$categories_id){
                                            echo "<option selected value=" . $row['id'] . ">" . $row['categories'] . "</option>";
                                        }else
                                        echo "<option value=" . $row['id'] . ">" . $row['categories'] . "</option>";
                                    }
                                    ?>

                                </select>

                            </div>
                            <div class="form-group">
                                <label>Product Name </label>
                                <input type="text" name="product_name" class="form-control" value="<?php echo $product_name ?>" required>
                            </div>
                            <div class="form-group">
                                <label>RMP </label>
                                <input type="text" name="rmp" class="form-control" value="<?php echo $rmp ?>" required>
                            </div>
                            <div class="form-group">
                                <label>price </label>
                                <input type="text" name="price" class="form-control"value="<?php echo $price  ?>"   required>
                            </div>
                            <div class="form-group">
                                <label>Quantity </label>
                                <input type="text" name="qty" class="form-control" value="<?php echo $qty ?>" placeholder="enter qty    " required>
                            </div>
                            <div class="form-group">
                                <label><small>Image upload</small></label>
                                <input type="file" name="image" class="form-control" value="<?php echo $image ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label><small>Short Description</small></label>
                                <textarea type="text" name="short_description" class="form-control" value="<?php echo $short_description ?>" placeholder=""></textarea>
                            </div>
                            <div class="form-group">

                                <label><small>Description</small></label>
                                <textarea type="text" name="description" class="form-control" value="<?php echo $description ?>" placeholder=""></textarea>

                            </div>
                            <div class="form-group">
                                <label><small>Meta Title</small> </label>
                                <textarea type="text" name="meta_title" class="form-control" value="<?php echo $meta_title?>" placeholder=""></textarea>

                            </div>
                            <div class="form-group">
                                <label><small>Meta Description</small> </label>
                                <textarea type="text" name="meta_description" class="form-control" value="<?php echo $meta_description ?>" placeholder=""></textarea>

                            </div>
                            <div class="form-group">
                                <label><small>Meta Key</small> </label>
                                <textarea type="text" name="meta_key" class="form-control" value="<?php echo $meta_key ?>" placeholder=""></textarea>

                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="update" required />

                    </form>
        </div>
    </div><!-- /.container-fluid -->
</div>

</div>

<?php include "footer.php" ?>