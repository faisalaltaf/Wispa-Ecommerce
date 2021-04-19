<?php
include "config.php";
session_start();
if($_SESSION['user_role'] == '0'){
    header("Location: {$hostname}/admin/dashboard.php");
}
  
?>
      <?php
        if(isset($_POST['save'])){
  include "config.php";

  $email =mysqli_real_escape_string($conn,$_POST['email']);
  $company = mysqli_real_escape_string($conn,$_POST['company']);
  $mobile = mysqli_real_escape_string($conn,$_POST['mobile']);
  $address = mysqli_real_escape_string($conn,($_POST['address']));


  // $sql = "SELECT username FROM user WHERE username = '{$user}'";
$sql = "SELECT email FROM contact_us WHERE email='{$email}'";
  // $result = mysqli_query($conn, $sql) or die("Query Failed 1 change add-user.");

  $result = mysqli_query($conn,$sql) or die("query failad 1 change add user");
  // check the user already exit
  if(mysqli_num_rows($result) > 0){
    echo "<p style='color:red;text-align:center;margin: 10px 0;'>UserName already Exists.</p>";
  }else{
    // insert database 
   echo  $sql1 = "INSERT INTO contact_us (email,company_name, mobile, address)   

              VALUES ('{$email}','{$company}','{$mobile}','{$address}')";
    if(mysqli_query($conn,$sql1)){
      // redirect user all show 
      header("Location: {$hostname}/admin/contact-us.php");
    }else{
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
            <h1 class="m-0">Contact Us</h1>

          </div><!-- /.col -->
          <button> <a href="contact-us-showdata.php">button</a></button>
         
        </div><!-- /.row -->
        <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>email </label>
                          <input type="email" name="email" class="form-control" placeholder="First email" required>
                      </div>
                          <div class="form-group">
                          <label>Company Name</label>
                          <input type="text" name="company" class="form-control" placeholder="Company Name" required>
                      </div>
                      <div class="form-group">
                          <label>Mobile No:</label>
                          <input type="text" name="mobile" class="form-control" placeholder="Mobile No" required>
                      </div>
                      <div class="form-group">
                          <label>City Address:</label>
                          <input type="text" name="address" class="form-control" placeholder="Address" required>
                      </div>

                      
                      
                      <input type="submit"  name="save" class="btn btn-primary" value="Save" required />
                  </form>


      
            </div>
      </div><!-- /.container-fluid -->
    </div>




<?php 
include "footer.php" ?>