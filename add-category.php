<?php
include "config.php";
session_start();
if ($_SESSION['user_role'] == '0') {
    header("Location: {$hostname}/user/dashboard.php");
}

?>
<?php
if (isset($_POST['save'])) {
    include "config.php";

    $category = mysqli_real_escape_string($conn, $_POST['category']);




    // $sql = "SELECT username FROM user WHERE username = '{$user}'";
    $sql = "SELECT categories FROM categories WHERE categories='{$category}'";
    // $result = mysqli_query($conn, $sql) or die("Query Failed 1 change add-user.");

    $result = mysqli_query($conn, $sql) or die("query failad ");
    // check the user already exit
    if (mysqli_num_rows($result) > 0) {
        echo "<p style='color:red;text-align:center;margin: 10px 0;'>category already Exists.</p>";
    } else {
        // insert database 
        echo  $sql1 = "INSERT INTO categories (categories,status)   

              VALUES ('{$category}','1')";
        if (mysqli_query($conn, $sql1 )) {
            // redirect user all show 
            header("Location: {$hostname}/admin/category.php");
        } else {
           echo "<p style='color:red;text-align:center;margin: 10px 0;'>Can't Insert User.</p>";
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
                    <h1 class="m-0">Category</h1>

                </div><!-- /.col -->
                <button> <a href="category.php">Show category</a></button>

            </div><!-- /.row -->
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                <div class="form-group">
                    <label>Category Name </label>
                    <input type="category" name="category" class="form-control" placeholder="Entre the category" required>
                </div>
                <input type="submit" name="save" class="btn btn-primary" value="Save" required />
            </form>



        </div>
    </div><!-- /.container-fluid -->
</div>




<?php
include "footer.php" ?>