<?php
include "config.php";
session_start();
if ($_SESSION['user_role'] == '0') {
    header("Location: {$hostname}/user/dashboard.php");
}

?>
<?php
if (isset($_POST['save'])) {

    $categories_id = mysqli_real_escape_string($conn, $_POST['categories_id']);
    $name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $rmp = mysqli_real_escape_string($conn, $_POST['rmp']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $qty = mysqli_real_escape_string($conn, $_POST['qty']);
    // $image = mysqli_real_escape_string($conn, $_POST['image']);
    $image = $_FILES['image']['name'];  
    $short_description = mysqli_real_escape_string($conn, $_POST['short_description']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $meta_title = mysqli_real_escape_string($conn, $_POST['meta_title']);
    $meta_description = mysqli_real_escape_string($conn, $_POST['meta_description']);
    $meta_key = mysqli_real_escape_string($conn, $_POST['meta_key']);

    
   


    // $sql = "SELECT username FROM user WHERE username = '{$user}'";
    $sql = "SELECT product_name FROM product WHERE product_name='{$name}'";
    // $result = mysqli_query($conn, $sql) or die("Query Failed 1 change add-user.");

    $result = mysqli_query($conn, $sql) or die("query failad ");
    // check the user already exit

    
    if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
        echo "only file upload the jpg , png jpeg formate";
    }
    if (mysqli_num_rows($result) > 0) {
        echo "<p style='color:red;text-align:center;margin: 10px 0;'>category already Exists.</p>";
    } else {
        // insert database 
       
        $image=rand(1111111,9999999).'_'.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],'../media/product/'.$image);

          $sql1 = "INSERT INTO product (categories_id,product_name,rmp,price,qty,image,short_description,description,meta_title,meta_description,meta_key,status)   

              VALUES ('{$categories_id}','{$name}','{$rmp}','{$price}','{$qty}','{$image}',
              '{$short_description}','{$description}','{$meta_title}','{$meta_description}','{$meta_key}','1')";
        if (mysqli_query($conn, $sql1)) {
            // redirect user all show 
            header("Location: {$hostname}/admin/product.php");
        } else {
            echo "<p style='color:red;text-align:center;margin: 10px 0;'>Can't Insert User.</p>";
        }
    }
}

// image validation 



?>
<?php include "header.php" ?>
<?php include "sidebar.php" ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><strong>Product</strong> <small>From</small></h1>

                </div><!-- /.col -->
                <button> <a href="product.php">Show product</a></button>

            </div><!-- /.row -->
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">

                    <label>Category Name </label>
                    <select class="form-control" name="categories_id">
                        <?php $result = mysqli_query($conn, "SELECT id,categories from categories order by categories asc");
                        while ($row = mysqli_fetch_assoc($result)) {

                            echo "<option value=" . $row['id'] . ">" . $row['categories'] . "</option>";
                        }
                        ?>

                    </select>

                </div>
                <div class="form-group">
                    <label>Product Name </label>
                    <input type="product_name" name="product_name" class="form-control" placeholder="Entre the prduct name  " required>
                </div>
                <div class="form-group">
                    <label>RMP </label>
                    <input type="text" name="rmp" class="form-control" placeholder="Entre the RMP" required>
                </div>
                <div class="form-group">
                    <label>price </label>
                    <input type="text" name="price" class="form-control" placeholder="Entre the price" required>
                </div>
                <div class="form-group">
                    <label>Quantity </label>
                    <input type="text" name="qty" class="form-control" placeholder="Entre Quantity" required>
                </div>
                <div class="form-group">
                    <label><small>Image upload</small></label>
                    <input type="file" name="image" class="form-control" >
                </div>
                <div class="form-group">
                    <label><small>Short Description</small></label>
                    <textarea type="text" name="short_description" class="form-control" placeholder="Entre the Short Description"></textarea>
                </div>
                <div class="form-group">
                  
                  <label><small>Description</small></label>
                  <textarea type="text" name="description" class="form-control" placeholder="entre description"></textarea>
                
                </div>
                <div class="form-group">
                    <label><small>Meta Title</small> </label>
                    <textarea type="text" name="meta_title" class="form-control" placeholder="Meta Title"></textarea>

                </div>
                <div class="form-group">
                    <label><small>Meta Description</small> </label>
                    <textarea type="text" name="meta_description" class="form-control" placeholder="meta Description"></textarea>

                </div>
                <div class="form-group">
                    <label><small>Meta Key</small> </label>
                    <textarea type="text" name="meta_key" class="form-control" placeholder="Meta Key"></textarea>

                </div>
                <input type="submit" name="save" class="btn btn-primary" value="Save" required />

            </form>



        </div>
    </div><!-- /.container-fluid -->
</div>




<?php
include "footer.php" ?>