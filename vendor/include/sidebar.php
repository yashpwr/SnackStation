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
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#snackscategory" aria-expanded="false" aria-controls="snackscategory">
         <span><i class="material-icons fs-16">dashboard</i>Snacks Category</span>
        </a>
        <ul id="snackscategory" class="collapse" aria-labelledby="snacks" data-parent="#side-nav-accordion">
          <li> <a href="category_list.php">Category List</a>
          </li>
          <li> <a href="add_snacks_category.php">Add Category</a>
          </li>
        </ul>
      </li>

      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#snacks" aria-expanded="false" aria-controls="snacks">
         <span><i class="material-icons fs-16">dashboard</i>Snacks</span>
        </a>
        <ul id="snacks" class="collapse" aria-labelledby="snacks" data-parent="#side-nav-accordion">
          <li> <a href="snacks_list.php">Snacks List</a>
          </li>
          <li> <a href="snacks_add.php">Add snacks</a>
          </li>
        </ul>
      </li>

      <li class="menu-item">
        <a href="order_list.php"> <span><i class="material-icons fs-16">dashboard</i>Orders</span>
        </a>
      </li>
    </ul>
  </aside>