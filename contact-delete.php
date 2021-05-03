<?php
include "config.php";
session_start();
if($_SESSION["user_role"] == '0'){
  header("Location: {$hostname}/user/dashboard.php");
}
$id = $_GET['id'];

$sql = "DELETE FROM contact_us WHERE id = {$id}";

if(mysqli_query($conn, $sql)){
  header("Location: {$hostname}/admin/contact-us-showdata.php");
}else{
  echo "<p style='color:red;margin: 10px 0;'>Can\'t Delete the User Record.</p>";
}

mysqli_close($conn);

?>
