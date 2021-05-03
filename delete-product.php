<?php
include "config.php";
if($_SESSION["user_role"] == '0'){
  header("Location: {$hostname}/user/dashboard.php");
}
$id = $_GET['id'];

$sql = "DELETE FROM product WHERE id = {$id}";

if(mysqli_query($conn, $sql)){
  header("Location: {$hostname}/admin/product.php");
}else{
  echo "<p style='color:red;margin: 10px 0;'>Can\'t Delete the User Record.</p>";
}

mysqli_close($conn);

?>
