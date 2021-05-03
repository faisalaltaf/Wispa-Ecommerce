<?php
include "config.php";

session_start();
if(isset($_SESSION['username'])){
  header("Location: {$hostname}/admin/dashboard.php");

} ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Panel Login</title>
</head>
<body>


                       <?php include "css.php" ?>
<div class="login-content">
                       <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="au-input au-input--full" type="text" name="username" placeholder="Username" require>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password" require>
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">Remember Me
                                    </label>
                                    <label>
                                        <a href="#">Forgotten only admin Password?</a>
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name="login">sign in</button>
                                <div class="social-login-content">
                                    
                                </div>
                            </form>
                            <div class="register-link">
                                <p>
                                    Don't you have account?
                                    <a href="#">Sign Up only admin Here</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <?php 
                      if(isset($_POST['login'])){
                        include "config.php";

                        $username = mysqli_real_escape_string($conn,$_POST['username']);
                        $password = md5($_POST['password']);

                       $sql ="SELECT user_id, first_name ,last_name, username, role FROM user WHERE  username = '{$username}' AND password= '{$password}'";
                      $result = mysqli_query($conn,$sql) or die("faild query");
                      if(mysqli_num_rows($result) > 0){
                      while($row =mysqli_fetch_assoc($result)){
                        

                        $_SESSION['username'] = $row['username'];
                         $_SESSION['user_id'] = $row['user_id'];
                        $_SESSION['user_role'] = $row['role'];
                        $_SESSION['first_name'] = $row['first_name'];
                        $_SESSION['last_name'] = $row['last_name'];

                        if($_SESSION['user_role']==0){
                            header("Location: {$hostname}/user/dashboard.php");

                        }else
                         header("Location: {$hostname}/admin/dashboard.php");

                      }
                      }else {

                        echo '<div class="alert alert-danger"><p>username and password not match</p></div>';
                      }
                     } ?>
                     
</body>
</html>