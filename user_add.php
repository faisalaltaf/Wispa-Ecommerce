<?php 
  session_start();
if($_SESSION["user_role"] == '0'){
  header("Location: {$hostname}/admin/dashboard.php");
  
}
?>      





       
        <?php
        if(isset($_POST['save'])){
  include "config.php";

	$categories_id=mysqli_real_escape_string($conn,$_POST['categories_id']);
	if (empty($_POST["categories_id"])) {
		$categories_id = "Name is required";
	  } else {
		$categories_id = mysqli_real_escape_string($conn,$_POST['categories_id']);
	  }
  $fname =mysqli_real_escape_string($conn,$_POST['fname']);
  $lname = mysqli_real_escape_string($conn,$_POST['lname']);
  $user = mysqli_real_escape_string($conn,$_POST['user']);
  $password = mysqli_real_escape_string($conn,md5($_POST['password']));
  $role = mysqli_real_escape_string($conn,$_POST['role']);

  // $sql = "SELECT username FROM user WHERE username = '{$user}'";
$sql = "SELECT username FROM user WHERE username='{$user}'";
  // $result = mysqli_query($conn, $sql) or die("Query Failed 1 change add-user.");

  $result = mysqli_query($conn,$sql) or die("query failad 1 change add user");
  // check the user already exit
  if(mysqli_num_rows($result) > 0){
    echo "<p style='color:red;text-align:center;margin: 10px 0;'>UserName already Exists.</p>";
  }else{
    // insert database 
    $sql1 = "INSERT INTO user (first_name,last_name, username, password, role)   

              VALUES ('{$fname}','{$lname}','{$user}','{$password}','{$role}')";
    if(mysqli_query($conn,$sql1)){
      // redirect user all show 
      
    }else{
    echo  "<p style='color:red;text-align:center;margin: 10px 0;'>Can't Insert User.</p>";
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
<div class="content pb-0">

  <div id="admin-content">

      <div class="container">
    
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add User</h1>
                  <button type="button" class="btn btn-success m-4"> <a href="useradmin.php" style="color: white;">Show Data</a></button>
              </div>
              
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="0">Normal User</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="save" class="btn btn-primary" value="Save" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>


       
      </div><!-- /.container-fluid -->
    </div>


</div>
</div>
 <?php include "footer.php" ?> 
