<?php
include "config.php";
session_start();
if ($_SESSION['user_role'] == '0') {
	header("Location: {$hostname}/user/dashboard.php");
}
include "header.php" ; 

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=mysqli_real_escape_string($conn,$_GET['type']);
	if($type=='status'){
		$operation=mysqli_real_escape_string($conn,$_GET['operation']);
		$id=mysqli_real_escape_string($conn,$_GET['id']);
		if($operation=='active'){
			$status='1';
		}else{
			$status='0';
		}
		$update_status_sql="update product set status='$status' where id='$id'";
		mysqli_query($conn,$update_status_sql);
	}
	
	if($type=='delete'){
		$id=mysqli_real_escape_string($conn,$_GET['id']);
		$delete_sql="delete from product where id='$id'";
		mysqli_query($conn,$delete_sql);
	}
}



$sql="select product.*,categories.categories from product,categories where product.categories_id=categories.id order by product.id desc";
$res=mysqli_query($conn,$sql);
?>
 <?php include "sidebar.php" ?> 

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Products </h4>
				   <h4 class="box-link"><a href="manage_product.php"><button type="button" class="btn btn-success">Add Prodcut</button></a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>ID</th>
							   <th >Categories</th>
							   <th>Name</th>
							   <th>Image</th>
							   <th>MRP</th>
							   <th>Price</th>
							   <th>Qty</th>
							   <th>Update</th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							<td><?php echo $i++ ?></td>
							   <td><?php echo $row['id']?></td>
							   <td><?php echo $row['categories']?></td>
							   <td><?php echo $row['product_name']?></td>
							   <td > <img style="width: 4.1rem; height:auto;" class="img-circle elevation-2" src="../media/product/<?php echo $row['image']; ?> "/></td>

							   <td><?php echo $row['rmp']?></td>
							   <td>Rs <?php echo $row['price']?> </td>
							   <td><?php echo $row['qty']?></td>
							   <td>
								<?php
								if($row['status']==1){
									echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'><button type='button' class='btn btn-success'>Active</button></a></span>&nbsp;";
								}else{
									echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'><button type='button' class='btn btn-danger'>Deactive</button></a></span>&nbsp;";
								}
								echo "<span class='badge badge-edit'><a href='manage_product.php?id=".$row['id']."'>Edit</a></span>&nbsp;";
								
								echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>";
								
								?>
							   </td>
							</tr>
							<?php } ?>
						 </tbody>
					  </table>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
	  </div></div></div>
<?php
require('footer.php');
?>