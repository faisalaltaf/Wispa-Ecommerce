<?php
include "config.php";
session_start();
if($_SESSION['user_role'] == '0'){
    header("Location: {$hostname}/admin/dashboard.php");
}

?>
<?php include "header.php" ?>
<?php include "sidebar.php" ?>


<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
              <?php
                include 'config.php';// database configuration
                 /* Calculate Offset Code */
                  $limit = 3;
                  if(isset($_GET["page"])){
                      $page = $_GET["page"];
                  }
                  else{
                      $page = 1;
                  };
                  $offset = ($page-1)* $limit;
              /* select query with offset and limit */
              $sql = "SELECT * FROM  category ORDER BY category_id DESC Limit $offset,$limit";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
                  $table = '<table class="content-table">';
                  $table .= '<thead>
                                  <th>S.No.</th>
                                  <th>Category Name</th>
                                  <th>No. of Posts</th>
                                  <th>Edit</th>
                                  <th>Delete</th>
                              </thead>
                              <tbody>';
                    $serial = $offset + 1;
                  while($row = mysqli_fetch_assoc($result)) {
                    $table .= "<tr>
                            <td class='id'>{$serial}</td>
                            <td>{$row["category_name"]}</td>
                            <td>{$row["post"]}</td>
                            <td class='edit'><a href='update-category.php?id={$row['category_id']}' ><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?id={$row['category_id']}'><i class='fa fa-trash-o'></i></a></td>
                        </tr>";
                        $serial++;
                  }
                  $table .= '</tbody></table>';
                  // show table
                  echo $table;
              } else {
                  echo "<h3>No Results Found.</h3>";
              }
              // select count() query for pagination
              $sql1 = "SELECT COUNT(category_id) FROM category";
              $result_1 = mysqli_query($conn,$sql1);
              $row_db = mysqli_fetch_row($result_1);
              $total_record = $row_db[0];
              $total_page = ( $total_record / $limit);
              // show pagination
              echo  "<ul class='pagination admin-pagination'>";
                  if($page>1){
                      echo "<li><a href='category.php?page=".($page-1)."'>Prev</a></li>";
                  }
                  if($total_record > $limit){
                      for ($i=1; $i<=$total_page ; $i++) {
                          if($i == $page){
                              $cls ='btn-primary active';
                          }else{
                              $cls ='btn-primary';
                          }
                          echo"<li><a href='category.php?page=".$i."' class='{$cls}'>$i</a></li>";
                      }
                  }

                  if($total_page>$page){
                      echo"<li> <a href='category.php?page=".($page+1)."'>Next</a></li>";
                  }
              echo "</ul>";
              ?>
            </div>
        </div>
    </div>
</div>


<div class="card">
              <div class="card-header">
                <h3 class="card-title">Bordered Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Task</th>
                      <th>Progress</th>
                      <th style="width: 40px">Label</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1.</td>
                      <td>Update software</td>
                      <td>
                        <div class="progress progress-xs">
                          <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-danger">55%</span></td>
                    </tr>
                    <tr>
                      <td>2.</td>
                      <td>Clean database</td>
                      <td>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-warning" style="width: 70%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-warning">70%</span></td>
                    </tr>
                    <tr>
                      <td>3.</td>
                      <td>Cron job running</td>
                      <td>
                        <div class="progress progress-xs progress-striped active">
                          <div class="progress-bar bg-primary" style="width: 30%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-primary">30%</span></td>
                    </tr>
                    <tr>
                      <td>4.</td>
                      <td>Fix and squish bugs</td>
                      <td>
                        <div class="progress progress-xs progress-striped active">
                          <div class="progress-bar bg-success" style="width: 90%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-success">90%</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
              </div>
            </div>
<?php include "footer.php"; ?>
