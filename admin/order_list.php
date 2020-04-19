<?php
include 'db.php';
if (!isset($_SESSION['username'])) {
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
    <!-- Costic Core styles -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- Page Specific Css (Datatables.css) -->
    <link href="assets/css/datatables.min.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="favicon.ico">
</head>

<body class="ms-body ms-aside-left-open ms-primary-theme ms-has-quickbar">

    <!-- Overlays -->
    <div class="ms-aside-overlay ms-overlay-left ms-toggler" data-target="#ms-side-nav" data-toggle="slideLeft"></div>
    <div class="ms-aside-overlay ms-overlay-right ms-toggler" data-target="#ms-recent-activity" data-toggle="slideRight"></div>

    <!-- Sidebar Navigation Left -->
    <?php include 'include/sidebar.php' ?>

    <!-- Main Content -->
    <main class="body-content">

        <!-- Navigation Bar -->
        <?php include 'include/body_header.php' ?>

        <!-- Body Content Wrapper -->
        <div class="ms-content-wrapper">
            <div class="row">

                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb pl-0">
                            <li class="breadcrumb-item"><a href="index.php"><i class="material-icons">home</i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Vendor List</li>
                        </ol>
                    </nav>

                    <!-- Active Orders Graph -->
                    <div class="row">
                        <div class="col-xl-12">
                            <!-- <a href=""><button class="btn btn-round btn-danger" style="float:right;margin:10px 20px">Add Vendor</button></a> -->
                            <div class="ms-panel">
                                <div class="ms-panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover thead-primary" id="datatable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Order ID</th>
                                                    <th scope="col">Food Image</th>
                                                    <th scope="col">Food Name</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">User Email</th>
                                                    <th scope="col"> Restaurent Name </th>
                                                    <th scope="col"> status </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $state_query = "SELECT snacks.id as ID, snacks.uploaded_by, snacks.name, snacks.status, snacks.price, snacks.category, 
                                                snacks.img, `order`.`id`, `order`.`snack_id`, `order`.`order_id`, `order`.`user_id`, `order`.`vendor_id`, vendor.r_name, users.email 
                                                FROM `order` 
                                                JOIN snacks ON `order`.`snack_id` = snacks.id 
                                                JOIN vendor ON `order`.`vendor_id` = vendor.id
                                                JOIN users ON `order`.`user_id` = users.id";
                                                $state_result = mysqli_query($db, $state_query);
                                                $count = 1;
                                                while ($r = mysqli_fetch_array($state_result)) { ?>
                                                    <tr>
                                                        <td><?php echo $r['order_id']; ?></td>
                                                        <td><img src='/SnacksStation/uploads/admin-snacks-img/<?php echo $r['img']; ?>'></td>
                                                        <td><?php echo $r['name']; ?></td>
                                                        <td><?php echo $r['price']; ?></td>
                                                        <td><?php echo $r['email']; ?></td>
                                                        <td><?php echo $r['r_name']; ?></td>
                                                        <td><?php echo $r['status']; ?></td>
                                                    </tr>
                                                <?php $count++;
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- SCRIPTS -->
    <!-- Global Required Scripts Start -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/perfect-scrollbar.js"> </script>
    <script src="assets/js/jquery-ui.min.js"> </script>
    <!-- Global Required Scripts End -->
    <!-- Page Specific Scripts Start -->
    <script src="assets/js/Chart.bundle.min.js"> </script>
    <script src="assets/js/Resturant.js"> </script>
    <!-- Page Specific Scripts End -->
    <!-- Page Specific Scripts Finish -->
    <script src="assets/js/datatables.min.js"> </script>
    <script src="assets/js/data-tables.js"> </script>
    <!-- Costic core JavaScript -->
    <script src="assets/js/framework.js"></script>
    <!-- Settings -->
    <script src="assets/js/settings.js"> </script>
    <script>
        var tableFour = $('#datatable').DataTable();
    </script>
</body>

</html>