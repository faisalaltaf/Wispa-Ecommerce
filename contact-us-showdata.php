<?php
include "config.php";
session_start();
if($_SESSION['user_role'] == '0') {
  header("Location: {$hostname}/user/dashboard.php");
}

?>

<!-- active and deactive status query  -->



<?php $sql = "SELECT `id`, `email`, `company_name`, `mobile`, `address`, `Date and Time` FROM `contact_us` WHERE 1 ";
$result =  mysqli_query($conn, $sql);
?>
<?php include "header.php" ?>
<?php include "sidebar.php" ?>
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
	 <div class="container-fluid">
<div class="content pb-0">

<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <h1 class="admin-heading">All Contact</h1>
      </div>
      <div class="col-md-2">
      <button type="button" class="btn btn-danger container">      <a style="color:white;" class="add-new" href="contact-us.php"> Add Contact</a></button>


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
                  <th>Email</th>
                  <th>Company Nama</th>
                  <th>Mobile No</th>
                  <th>Address</th>
                  
                  <th style="width: 40px">Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                  <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row['id']; ?></td>
                    <td>

                      <?php echo $row['email']; ?>

          </td>
                    <td>

                      <?php echo $row['company_name']; ?>

          </td>
                    <td>

                      <?php echo $row['mobile']; ?>

          </td>
                    <td>

                      <?php echo $row['address']; ?>

          </td>
          </div>
        
          <td class='delete'><a href='contact-delete.php?id=<?php echo $row["id"]; ?>'><i class='fa fa-trash'></i></a></td>

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
      </div>
    </div></div></div></div></div></div></div>  
      <?php include "footer.php"; ?>