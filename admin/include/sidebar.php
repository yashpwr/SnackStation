<aside id="ms-side-nav" class="side-nav fixed ms-aside-scrollable ms-aside-left">
    <!-- Logo -->
    <div class="logo-sn ms-d-block-lg">
      <a class="pl-0 ml-0 text-center" href="index.php">
        <img src="assets/img/costic/costic-logo-216x62.png" alt="logo">
      </a>
    </div>
    <!-- Navigation -->
    <ul class="accordion ms-main-aside fs-14" id="side-nav-accordion">

      <li class="menu-item">
        <a href="index.php"> <span><i class="material-icons fs-16">dashboard</i>Dashboard</span>
        </a>
      </li>

      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#vendor" aria-expanded="false" aria-controls="dashboard"> 
          <span><i class="material-icons fs-16">dashboard</i>Vendor </span>
        </a>
        <ul id="vendor" class="collapse" aria-labelledby="dashboard" data-parent="#side-nav-accordion">
          <li> <a href="vendor_list.php">Vendor List</a>
          </li>
          <li> <a href="vendor_add.php">Add Vendor</a>
          </li>
        </ul>
      </li>

      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#user" aria-expanded="false" aria-controls="user"> <span><i class="material-icons fs-16">dashboard</i>User </span>
        </a>
        <ul id="user" class="collapse" aria-labelledby="user" data-parent="#side-nav-accordion">
          <li> <a href="user_list.php">User List</a>
          </li>
        </ul>
      </li>

      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#slider" aria-expanded="false" aria-controls="slider"> 
          <span><i class="material-icons fs-16">dashboard</i>Slider</span>
        </a>
        <ul id="slider" class="collapse" aria-labelledby="slider" data-parent="#side-nav-accordion">
          <li> <a href="slider_list.php">Slider List</a></li>
          <li> <a href="add_slider.php">Add Slider</a></li>
        </ul>
      </li>

      <li class="menu-item">
        <a href="order_list.php"> <span><i class="material-icons fs-16">dashboard</i>Orders</span>
        </a>
      </li>
    </ul>
  </aside>