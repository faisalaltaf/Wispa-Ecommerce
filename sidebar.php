
<?php
  include "config.php";


  if(!isset($_SESSION["username"])){
    header("Location: {$hostname}/admin/");
  }
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="asset/dist/img/news.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"> | M Faisal </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="asset/dist/img/faisal altaf 3.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="user_profile.php" class="d-block"><?php echo $_SESSION['username']; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div><div class="sidebar-search-results"><div class="list-group"><a href="#" class="list-group-item">
        <div class="search-title">
          <b class="text-light"></b>N<b class="text-light"></b>o<b class="text-light"></b> <b class="text-light"></b>e<b class="text-light"></b>l<b class="text-light"></b>e<b class="text-light"></b>m<b class="text-light"></b>e<b class="text-light"></b>n<b class="text-light"></b>t<b class="text-light"></b> <b class="text-light"></b>f<b class="text-light"></b>o<b class="text-light"></b>u<b class="text-light"></b>n<b class="text-light"></b>d<b class="text-light"></b>!<b class="text-light"></b>
        </div>
        
      </a></div></div>
      </div>
      <li class="py-2" style="list-style: none; ">
                <a href="user_profile.php" class="nav-link">
                  
                  <p>Profile Login User</p>
                </a>
<?php 
                if($_SESSION['user_role'] == 1){

                
?>
              </li>
      <li class="" style="list-style: none; ">
                <a href="user_add.php" class="nav-link">
                
                  <p>Admin and User Add</p>
                </a>
              </li>
      <li class="" style="list-style: none; ">
                <a href="useradmin.php" class="nav-link">
               
                  <p>Show Data Admin & User</p>
                </a>
              </li>
      <li class="" style="list-style: none; ">
                <a href="product.php  " class="nav-link">
               
                  <p>Product Add</p>
                </a>
              </li>
      <li class="" style="list-style: none; ">
                <a href="" class="nav-link">
               
                  <p>Category Add</p>
                </a>
              </li>
      <li class="" style="list-style: none; ">
                <a href="" class="nav-link">
               
                  <p>Order Master</p>
                </a>
              </li>
      <li class="" style="list-style: none; ">
                <a href="" class="nav-link">
               
                  <p>Contact Us</p>
                </a>
              </li>
    </div>
    <?php }?>
    <!-- /.sidebar -->
  </aside>