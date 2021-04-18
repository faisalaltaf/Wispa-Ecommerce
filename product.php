<?php
include "config.php";
session_start();
if($_SESSION['user_role'] == '0'){
    header("Location: {$hostname}/admin/dashboard.php");
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
            <h1 class="m-0">product</h1>
          </div><!-- /.col -->
         
        </div><!-- /.row -->
      
            </div>
      </div><!-- /.container-fluid -->
    </div>


</div>

<?php 
include "footer.php" ?>