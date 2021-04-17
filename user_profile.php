<?php
  include "config.php";
session_start();
if(!isset($_SESSION["username"])){
    header("Location: {$hostname}/admin/");
} ?>


<body>

<?php include "sidebar.php" ?>
<?php include "header.php" ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
       

        <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Username</th>
      <th scope="col">Role</th>
    </tr>
  </thead>
  <tbody>
    <tr>

      <th scope="row"><?php echo $_SESSION['user_id'];?></th>
      <td><?php echo $_SESSION['first_name']; ?></td>
      <td><?php echo $_SESSION['last_name'] ?></td>
      <td><?php echo $_SESSION['username']; ?></td>
      <td><?php
      if($_SESSION['user_role'] == 1){echo "Admin";
        }else{echo "User"; }?></td>
    </tr>
  </tbody>
</table>


 
</table>

      </div><!-- /.container-fluid -->
    </div>


</div>
      
    
</div>
<?php include "footer.php" ?>

</body>
</html>