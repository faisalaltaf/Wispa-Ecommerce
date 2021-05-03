<?php
include "config.php";
session_start();
if ($_SESSION['user_role'] == '0') {
  header("Location: {$hostname}/user/dashboard.php");
}

?>

<!-- active and deactive status query  -->
<?php if (isset($_GET['type']) && $_GET['type'] != '') {
  $type = mysqli_real_escape_string($conn, $_GET['type']);
  if ($type == 'status') {
    $operation = mysqli_real_escape_string($conn, $_GET['operation']);
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    if ($operation == 'active') {
      $status = '1';
    } else {
      $status = '0';
    }
    $update_status = "UPDATE categories set status='$status' where id='$id'";
    mysqli_query($conn, $update_status);
  }
} ?>


<?php $sql = "SELECT * FROM categories order by categories asc ";
$result =  mysqli_query($conn, $sql);
?>
<?php include "header.php" ?>
<?php include "sidebar.php" ?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <h1 class="admin-heading">All Categories</h1>
      </div>
      <div class="col-md-2">
        <a class="add-new" href="add-category.php">add category</a>
      </div>
      <div class="col-md-12">

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Category</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">Serial No</th>
                  <th>ID</th>
                  <th>Categories</th>
                  <th style="width: 40px">Status</th>
                  <th style="width: 40px">Edit</th>
                  <th style="width: 40px">Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                  <tr>
                    <td><?php echo $i++ ?></td>
                    <td><?php echo $row['id']; ?></td>
                    <td>  <?php echo $row['categories']; ?>

          </div>
          </td>
          <td><?php if ($row['status'] == 1) {
                    echo "<a href= '?type=status&operation=deactive&id=" . $row['id'] . "'>Active</a>";
                  } else {
                    echo "<a href='?type=status&operation=active&id=" . $row['id'] . "'>Deactive</a>";
                  } ?></td>
                  <td class='edit'><a href='update-category.php?id=<?php echo $row["id"]; ?>'><i class='fa fa-edit'></i></a></td>
          <td class='delete'><a href='category-delete.php?id=<?php echo $row["id"]; ?>'><i class='fa fa-trash'></i></a></td>

          </tr>


        <?php } ?>

        </tbody>
        </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
          <ul class="pagination pagination-sm m-0 float-right">
            <li class="page-item"><a class="page-link" href="#">«</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">»</a></li>
          </ul>
        </div>
      </div> </div></div></div>
      <?php include "footer.php"; ?>