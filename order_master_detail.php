<?php
session_start();
if ($_SESSION['user_role'] == '0') {
  header("Location: {$hostname}/user/dashboard.php");
}


require "config.php";
 $order_id=mysqli_real_escape_string($conn,$_GET['id']);
if(isset($_POST['update_order_status'])){
	$update_order_status=$_POST['update_order_status'];
	if($update_order_status=='5'){
		mysqli_query($conn,"update `order` set order_status='$update_order_status',payment_status='Success' where id='$order_id'");
	}else{
		mysqli_query($conn,"update `order` set order_status='$update_order_status' where id='$order_id'");
	}
	
}
require "header.php";
require "sidebar.php";
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">order master details</h3>
                    
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>



<!-- pagination  query -->



                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap table table-bordered">
                        <thead>
                            
							<tr>
										<th class="product-thumbnail">Product Name</th>
										<th class="product-thumbnail">Product Image</th>
										<th class="product-name">Qty</th>
										<th class="product-price">Price</th>
										<th class="product-price">Total Price</th>
									</tr>

                            
                        </thead>
						<tbody>
									<?php
// echo "SELECT distinct(order_detail.id) ,order_detail.*,product.product_name,product.image,'project.order.address','project.order.city','project.order.pincode' from `order_detail`,`product`,`order` where order_detail.order_id='1' AND order_detail.product_id=product.id GROUP BY order_detail.id";

									$result=mysqli_query($conn,"SELECT distinct(order_detail.id) ,order_detail.*,product.product_name,product.image,'project.order.address','project.order.city','project.order.pincode' from `order_detail`,`product`,`order` where order_detail.order_id='$order_id' AND order_detail.product_id=product.id GROUP BY order_detail.id");
									
									$total_price=0;
									
									$userInfo=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * from `order` where id='$order_id'"));
									
									$address=$userInfo['address'];
									$city=$userInfo['city'];
									$pincode=$userInfo['pincode'];
									
									while($row=mysqli_fetch_assoc($result)){
									
									$total_price=$total_price+($row['qty']*$row['price']);
									?>
									<tr>
										<td class="product-name"><?php echo $row['product_name']?></td>
										<td> <img style="width: 4.1rem; height:auto;" src="../media/product/<?php echo $row['image']; ?> "></td>
										<td class="product-name"><?php echo $row['qty']?></td>
										<td class="product-name"><?php echo $row['price']?></td>
										<td class="product-name"><?php echo $row['qty']*$row['price']?></td>
										
									</tr>
									<?php } ?>
									<tr>
										<td colspan="3"></td>
										<td class="product-name">Total Price</td>
										<td class="product-name"><?php echo $total_price?></td>
										
									</tr>
								</tbody>
                    </table>
                </div>
               
                <!-- /.card-body -->
				<div id="address_details">
							<strong class="badge badge-pill badge-info px-2">Address:</strong>
							<span class="badge badge-light">	<?php echo $address?>, <?php echo $city?>, <?php echo $pincode?></span>
							<br><br><strong class="badge badge-secondary ">Order Status</strong>
							<?php 
							$order_status_arr=mysqli_fetch_assoc(mysqli_query($conn,"SELECT order_status.name from order_status,`order` where `order`.id='$order_id' and `order`.order_status=order_status.id"));
						    ?> <small class="badge badge-success">   <?php echo $order_status_arr['name']; ?>  </small>
								
							
						

								<div class="form-group py-2">
                
								<form method="post">
									<select id="inputStatus" class="form-control custom-select " name="update_order_status" required>
										<option value="">Select Status</option>
										<?php
										$result=mysqli_query($conn,"select * from order_status");
										while($row=mysqli_fetch_assoc($result)){
											if($row['id']==$categories_id){
												echo "<option selected value=".$row['id'].">".$row['name']."</option>";
											}else{
												echo "<option value=".$row['id'].">".$row['name']."</option>";
											}
										}
										?>
									</select> <div class="container py-2">
									
									<button type="submit" class="btn btn-warning btn-lg btn-block">Order Status Change</button>
									</div>
								</form>
              </div>
			  <div class="row">
        <div class="col-12">
          <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
          <a href="order_master.php"  class="btn btn-success float-right">Order Master</a>
        </div>
      </div>	
						</div>
            </div>

        </div>
    </div>
</div>


<?php
require ('footer.php');
?>