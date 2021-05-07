<?php

session_start();
if ($_SESSION["user_role"] == 0) {
    header("Location: {$hostname}/admin/dashboard");
}

?>


<?php include "header.php" ?>
<?php include "sidebar.php" ?>

<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
	 <div class="container-fluid">
<div class="content pb-0">

                <div class="card-header">
                <button type="button" class="btn btn-success mx-4"> <a href="user_add.php" style="color: white;"> Add Data</a></button>
                    <h3 class="card-title">User and Admin data</h3>
                    
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
<?php
                  include "config.php"; // database configuration
                  /* Calculate Offset Code */
                  $limit = 6;
                  if(isset($_GET['page'])){
                    $page = $_GET['page'];
                  }else{
                    $page = 1;
                  }
                  $offset = ($page - 1) * $limit;
                  /* select query of user table with offset and limit */
                  $sql = "SELECT * FROM user ORDER BY user_id DESC LIMIT {$offset},{$limit}";
                  $result = mysqli_query($conn, $sql) or die("Query Failed.");
                  if(mysqli_num_rows($result) > 0){
                ?>


                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Full Name</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Edit</th>
                                <th>Delete</th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php
                          $serial = $offset + 1;
                          while($row = mysqli_fetch_assoc($result)) {
                        ?>
                          <tr>
                              <td class='id'><?php echo $serial; ?></td>
                              <td><?php echo $row['first_name'] . " ". $row['last_name']; ?></td>
                              <td><?php echo $row['username']; ?></td>
                              <td><?php
                                  if($row['role'] == 1){
                                    echo "Admin";
                                  }else{
                                    echo "Normal";
                                  }
                               ?></td>
                              <td class='edit'><a href='update-user.php?id=<?php echo $row["user_id"]; ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-user.php?id=<?php echo $row["user_id"]; ?>'><i class='fa fa-trash'></i></a></td>
                          </tr>
                        <?php
                          $serial++;
                        } ?>
                      </tbody>
                    </table>
                </div>
                <?php
                }else {
                  echo "<h3>No Results Found.</h3>";
                }
                // show pagination
                $sql1 = "SELECT * FROM user";
                $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");

                if(mysqli_num_rows($result1) > 0){

                  $total_records = mysqli_num_rows($result1);

                  $total_page = ceil($total_records / $limit);

                  echo '<ul class="pagination pagination-sm">';
                  if($page > 1){
                    echo '<li><a href="useradmin.php?page='.($page - 1).'">Prev</a></li>';
                  }
                  for($i = 1; $i <= $total_page; $i++){
                    if($i == $page){
                      $active = "active";
                    }else{
                      $active = "";
                    }
                    echo '<li class="'.$active.'"><a href="useradmin.php?page='.$i.'">'.$i.'</a></li>';
                  }
                  if($total_page > $page){
                    echo '<li><a href="useradmin.php?page='.($page + 1).'">Next</a></li>';
                  }

                  echo '</ul>';
                }
                  ?>

                <!-- /.card-body -->
            </div>

        </div>
    </div>
</div>
<?php include "footer.php" ?>