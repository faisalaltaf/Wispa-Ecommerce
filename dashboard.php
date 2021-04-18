<?php
  include "config.php";
session_start();
if(!isset($_SESSION["username"])){
    header("Location: {$hostname}/admin/");
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
    <?php include "header.php" ?> 
 <?php include "sidebar.php" ?> 

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
         
        </div><!-- /.row -->
      
            </div>
      </div><!-- /.container-fluid -->
    </div>


</div>

 <?php include "footer.php" ?> 
</body>
</html>