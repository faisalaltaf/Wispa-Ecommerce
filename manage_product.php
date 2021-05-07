<?php
include "config.php";
session_start();
if ($_SESSION['user_role'] == '0') {
	header("Location: {$hostname}/user/dashboard.php");
}
include "header.php" ; 
$categories_id='';
$name='';
$rmp='';
$price='';
$qty='';
$image='';
$short_desc	='';
$description	='';
$meta_title	='';
$meta_description	='';
$meta_keyword='';

$msg='';
$image_required='required';
if(isset($_GET['id']) && $_GET['id']!=''){
	$image_required='';
	$id=mysqli_real_escape_string($conn,$_GET['id']);
	$res=mysqli_query($conn,"select * from product where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$categories_id=$row['categories_id'];
		$name=$row['product_name'];
		$rmp=$row['rmp'];
		$price=$row['price'];
		$qty=$row['qty'];
		$short_desc=$row['short_description'];
		$description=$row['description'];
		$meta_title=$row['meta_title'];
		$meta_desc=$row['meta_description'];
		$meta_keyword=$row['meta_key'];
	}else{
		header('location:product.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$categories_id=mysqli_real_escape_string($conn,$_POST['categories_id']);
	$name=mysqli_real_escape_string($conn,$_POST['name']);
	$rmp=mysqli_real_escape_string($conn,$_POST['rmp']);
	$price=mysqli_real_escape_string($conn,$_POST['price']);
	$qty=mysqli_real_escape_string($conn,$_POST['qty']);
	$short_desc=mysqli_real_escape_string($conn,$_POST['short_description']);
	$description=mysqli_real_escape_string($conn,$_POST['description']);
	$meta_title=mysqli_real_escape_string($conn,$_POST['meta_title']);
	$meta_desc=mysqli_real_escape_string($conn,$_POST['meta_description']);
	$meta_keyword=mysqli_real_escape_string($conn,$_POST['meta_key']);
	
	$res=mysqli_query($conn,"select * from product where product_name='$name'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="Product already exist";
			}
		}else{
			$msg="Product already exist";
		}
	}
	
	if($_GET['id']==0){
		if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
			$msg="Please select only png,jpg and jpeg image formate";
		}
	}else{
		if($_FILES['image']['type']!=''){
				if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
				$msg="Please select only png,jpg and jpeg image formate";
			}
		}
	}
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			if($_FILES['image']['name']!=''){
				$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];

				move_uploaded_file($_FILES['image']['tmp_name'],'../media/product/'.$image);
				$update_sql="update product set categories_id='$categories_id',product_name='$name',rmp='$rmp',price='$price',qty='$qty',short_description='$short_desc',description='$description',meta_title='$meta_title',meta_description='$meta_desc',meta_key='$meta_keyword',image='$image' where id='$id'";
			}else{
				$update_sql="update product set categories_id='$categories_id',product_name='$name',rmp='$rmp',price='$price',qty='$qty',short_description='$short_desc',description='$description',meta_title='$meta_title',meta_description='$meta_desc',meta_key='$meta_keyword' where id='$id'";
			}
			mysqli_query($conn,$update_sql);
		}else{
			$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'],'../media/product/'.$image);
			mysqli_query($conn,"insert into product(categories_id,product_name,rmp,price,qty,short_description,description,meta_title,meta_description,meta_key,status,image) values('$categories_id','$name','$rmp','$price','$qty','$short_desc','$description','$meta_title','$meta_desc','$meta_keyword',1,'$image')");
			
	}
		header('location:product.php');
		die();
	}
}

?>

<?php include "sidebar.php" ?> 

<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
	 <div class="container-fluid">
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Product</strong><small> Form</small></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="categories" class=" form-control-label">Categories</label>
									<select class="form-control" name="categories_id">
										<option>Select Category</option>
										<?php
										$res=mysqli_query($conn,"select id,categories from categories order by categories asc");
										while($row=mysqli_fetch_assoc($res)){
											if($row['id']==$categories_id){
												echo "<option selected value=".$row['id'].">".$row['categories']."</option>";
											}else{
												echo "<option value=".$row['id'].">".$row['categories']."</option>";
											}
											
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">Product Name</label>
									<input type="text" name="name" placeholder="Enter product name" class="form-control" required value="<?php echo $name?>">
								</div>
								
								<div class="col-4" class="form-group">
									<label  for="categories" class=" form-control-label">MRP</label>
									<input  type="text" name="rmp" placeholder="Enter product mrp" class="form-control" required value="<?php echo $rmp?>">
								
								</div>
								
								<div class="col-4" class="form-group">
									<label for="categories" class=" form-control-label">Price</label>
									<input type="number" name="price" placeholder="Enter product price" class="form-control" required value="<?php echo $price; ?>" maxlength="5">
								</div>
								
								<div class="form-group " >
									<label for="categories" class=" form-control-label">Qty</label>
									<input type="number" name="qty" placeholder="Enter qty" class="form-control" required value="<?php echo $qty?>">
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Image</label>
									<input type="file" name="image" class="form-control" <?php echo  $image_required?>>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Short Description</label>
									<textarea name="short_description" placeholder="Enter product short description" class="form-control" ><?php echo $short_desc?></textarea>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Description</label>
									<textarea name="description" placeholder="Enter product description" class="form-control" ><?php echo $description?></textarea>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Meta Title</label>
									<textarea name="meta_title" placeholder="Enter product meta title" class="form-control"><?php echo $meta_title?></textarea>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Meta Description</label>
									<textarea name="meta_description" placeholder="Enter product meta description" class="form-control"><?php echo $meta_description?></textarea>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Meta Keyword</label>
									<textarea name="meta_key" placeholder="Enter product meta keyword" class="form-control"><?php echo $meta_keyword?></textarea>
								</div>
								
								
							   <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							   <div class="field_error"><?php echo $msg?></div>
							</div>
						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
	 </div></div></div>
<?php
require('footer.php');
?>