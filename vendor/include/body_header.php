  <?php
  $email = $_SESSION['email'];
  $queryshow = "SELECT * from vendor WHERE email='" . $email . "'";
  $result = mysqli_query($db, $queryshow);
  $row = mysqli_fetch_assoc($result);
  ?>

  <!-- Navigation Bar -->
  <nav class="navbar ms-navbar">
    <div class="ms-aside-toggler ms-toggler pl-0" data-target="#ms-side-nav" data-toggle="slideLeft"> <span class="ms-toggler-bar bg-primary"></span>
      <span class="ms-toggler-bar bg-primary"></span>
      <span class="ms-toggler-bar bg-primary"></span>
    </div>
    <div class="logo-sn logo-sm ms-d-block-sm">
      <a class="pl-0 ml-0 text-center navbar-brand mr-0" href="index.php"><img src="assets/img/costic/costic-logo-84x41.png" alt="logo"> </a>
    </div>
    <ul class="ms-nav-list ms-inline mb-0" id="ms-nav-options">

      <li class="ms-nav-item ms-nav-user dropdown">
        <a href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img class="ms-user-img ms-img-round float-right" src="/SnacksStation/uploads/vendor-profile-img/<?php echo $row['v_profile']; ?>" style="height: 40px; width: 40px;" alt="people">
        </a>
        <ul class="dropdown-menu dropdown-menu-right user-dropdown" aria-labelledby="userDropdown">
          <li class="ms-dropdown-list">
            <a class="media fs-14 p-2" href="profile.php"> <span><i class="flaticon-user mr-2"></i> Profile</span>
            </a>
          </li>
          <li class="dropdown-divider"></li>

          <li class="dropdown-menu-footer">
            <a class="media fs-14 p-2" href="logout.php"> <span><i class="flaticon-shut-down mr-2"></i> Logout</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>
    <div class="ms-toggler ms-d-block-sm pr-0 ms-nav-toggler" data-toggle="slideDown" data-target="#ms-nav-options"> <span class="ms-toggler-bar bg-primary"></span>
      <span class="ms-toggler-bar bg-primary"></span>
      <span class="ms-toggler-bar bg-primary"></span>
    </div>
  </nav>