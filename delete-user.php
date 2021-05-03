<?php
include "config.php";
if($_SESSION["user_role"] == '0'){
  header("Location: {$hostname}/user/dashboard.php");
}
$userid = $_GET['id'];

$sql = "DELETE FROM user WHERE user_id = {$userid}";

if(mysqli_query($conn, $sql)){
  header("Location: {$hostname}/admin/useradmin.php");
}else{
  echo "<p style='color:red;margin: 10px 0;'>Can\'t Delete the User Record.</p>";
}

mysqli_close($conn);

?>
