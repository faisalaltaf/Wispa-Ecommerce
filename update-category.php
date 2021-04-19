<?php
include "config.php";
session_start();
if ($_SESSION['user_role'] == '0') {
    header("Location: {$hostname}/admin/dashboard.php");
}
if (isset($_POST['submit'])) {

    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $sql = "SELECT categories FROM categories WHERE categories='{$category}'";
    $result = mysqli_query($conn, $sql) or die("query failad ");
    if(mysqli_num_rows($result) > 0){
        echo "<p style='color:red;text-align:center;margin: 10px 0;'>category already Exists.</p>";
    }else{
        $sql = "UPDATE categories SET categories = '{$category}' WHERE id = {$id}";

        if (mysqli_query($conn, $sql)) {
            header("Location: {$hostname}/admin/category.php");
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
                    <h1 class="m-0">Update Category</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
            <?php

            $id = $_GET['id'];
            $sql = "SELECT * FROM categories WHERE id = {$id}";
            $result = mysqli_query($conn, $sql) or die("Query Failed.");
            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_assoc($result)) {
            ?>


                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">

                    <div class="form-group">
                          <input type="hidden" name="id" class="form-control" value="<?php echo $row['id'];  ?>">
                      </div>
                        <div class="form-group">

                            <label>Category Name </label>
                            <input type="category" name="category" class="form-control" value="<?php $row['categories'] ?>" placeholder="" required>
                        </div>

                        <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                    </form>
        </div>
    </div><!-- /.container-fluid -->
</div>

<?php }
            } ?>
</div>

<?php include "footer.php" ?>