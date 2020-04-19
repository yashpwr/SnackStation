<?php
include 'db.php';
if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Costic Dashboard</title>
  <!-- Iconic Fonts -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="vendors/iconic-fonts/font-awesome/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="vendors/iconic-fonts/flat-icons/flaticon.css">
  <link rel="stylesheet" href="vendors/iconic-fonts/cryptocoins/cryptocoins.css">
  <link rel="stylesheet" href="vendors/iconic-fonts/cryptocoins/cryptocoins-colors.css">
  <!-- Bootstrap core CSS -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <!-- jQuery UI -->
  <link href="assets/css/jquery-ui.min.css" rel="stylesheet">
  <!-- Page Specific CSS (Slick Slider.css) -->
  <link href="assets/css/slick.css" rel="stylesheet">
  <link href="assets/css/datatables.min.css" rel="stylesheet">
  <!-- Costic styles -->
  <link href="assets/css/style.css" rel="stylesheet">
  <!-- Favicon -->
  <link rel="icon" type="image/png" sizes="32x32" href="favicon.ico">
</head>

<body class="ms-body ms-aside-left-open ms-primary-theme ms-has-quickbar">
  <!-- Overlays -->
  <div class="ms-aside-overlay ms-overlay-left ms-toggler" data-target="#ms-side-nav" data-toggle="slideLeft"></div>
  <div class="ms-aside-overlay ms-overlay-right ms-toggler" data-target="#ms-recent-activity" data-toggle="slideRight"></div>
  <!-- Sidebar Navigation Left -->
  <?php include 'include/sidebar.php'?>
  <!-- Sidebar Right -->
  <!-- Main Content -->
  <main class="body-content">
    <!-- Navigation Bar -->
    <?php include 'include/body_header.php'?>
    <div class="ms-content-wrapper">
      <div class="row">
        <div class="col-md-12">
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget">
            <span class="ms-chart-label bg-black"><i class="material-icons">arrow_upward</i> 3.2%</span>
            <div class="ms-card-body media">
              <div class="media-body">
                <span class="black-text"><strong>Sells Graph</strong></span>
                <h2>$8,451</h2>
              </div>
            </div>
            <canvas id="line-chart"></canvas>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget">
            <span class="ms-chart-label bg-red"><i class="material-icons">arrow_downward</i> 4.5%</span>
            <div class="ms-card-body media">
              <div class="media-body">
                <span class="black-text"><strong>Total Visitors</strong></span>
                <h2>3,973</h2>
              </div>
            </div>
            <canvas id="line-chart-2"></canvas>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget">
            <span class="ms-chart-label bg-black"><i class="material-icons">arrow_upward</i> 12.5%</span>
            <div class="ms-card-body media">
              <div class="media-body">
                <span class="black-text"><strong>New Users</strong></span>
                <h2>7,333</h2>
              </div>
            </div>
            <canvas id="line-chart-3"></canvas>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget">
            <span class="ms-chart-label bg-red"><i class="material-icons">arrow_upward</i> 9.5%</span>
            <div class="ms-card-body media">
              <div class="media-body">
                <span class="black-text"><strong>Total Orders</strong></span>
                <h2>48,973</h2>
              </div>
            </div>
            <canvas id="line-chart-4"></canvas>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- MODALS -->
 
  <!-- SCRIPTS -->
  <!-- Global Required Scripts Start -->
  <script src="assets/js/jquery-3.3.1.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/perfect-scrollbar.js">
  </script>
  <script src="assets/js/jquery-ui.min.js">
  </script>
  <!-- Global Required Scripts End -->
  <!-- Page Specific Scripts Start -->
  <script src="assets/js/Chart.bundle.min.js">
  </script>
  <script src="assets/js/widgets.js"> </script>
  <script src="assets/js/clients.js"> </script>
  <script src="assets/js/Chart.Financial.js"> </script>
  <script src="assets/js/d3.v3.min.js">
  </script>
  <script src="assets/js/topojson.v1.min.js">
  </script>
  <script src="assets/js/datatables.min.js">
  </script>
  <script src="assets/js/data-tables.js">
  </script>
  <!-- Page Specific Scripts Finish -->
  <!-- Costic core JavaScript -->
  <script src="assets/js/framework.js"></script>
  <!-- Settings -->
  <script src="assets/js/settings.js"></script>
</body>
</html>
