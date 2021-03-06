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
                            <li class="breadcrumb-item active" aria-current="page">Snacks Detail</li>
                        </ol>
                    </nav>
                </div>
                <?php
                $order_id = $_REQUEST['order_id'];
                $queryshow = "SELECT snacks.id as ID, snacks.uploaded_by, snacks.name as snackname, snacks.description,  snacks.status as stock, snacks.price, snacks.category, 
                snacks.img, order_details.status, order_details.name, order_details.email, order_details.address, order_details.city, order_details.state, 
                order_details.country, order_details.pincode, order_details.phone, order_details.trn_date, order_details.id as orderid, vendor.r_name

                FROM `order` 
                JOIN vendor ON `order`.`vendor_id` = vendor.id
                JOIN snacks ON `order`.`snack_id` = snacks.id 
                JOIN order_details ON `order`.`order_id` = order_details.order_id 
                WHERE `order_details`.order_id = '$order_id'";


                $result = mysqli_query($db, $queryshow);
                $row = mysqli_fetch_assoc($result);
                ?>
                <div class="col-md-12">
                    <div class="ms-panel">
                        <div class="ms-panel-header">
                            <h6>Snacks Details</h6>
                        </div>
                        <div class="ms-panel-body">

                            <div id="arrowSlider" class="ms-arrow-slider carousel slide" data-ride="carousel" data-interval="false">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="/SnacksStation/uploads/admin-snacks-img/<?php echo $row['img']; ?>" style="height: 300px; width: 1040px;">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h3 class="text-white"><?php echo $row['snackname']; ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" col-md-12">
                    <div class="ms-panel ms-panel-fh">
                        <div class="ms-panel-body">
                            <h4 class="section-title bold">Snacks Info</h4>
                            <table class="table ms-profile-information">
                                <tbody>
                                    <tr>
                                        <th scope="row">Snacks Name</th>
                                        <td><?php echo $row['snackname']; ?></td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Restaurent Name</th>
                                        <td><?php echo $row['r_name']; ?></td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Category</th>
                                        <td><?php echo $row['category']; ?></td>
                                    </tr>
                                   
                                    <tr>
                                        <th scope="row">Availiblity</th>
                                        <td><span class="badge badge-pill badge-primary"><?php echo $row['stock']; ?></span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Price</th>
                                        <td><?php echo $row['price']; ?> R</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Description</th>
                                        <td><?php echo $row['description']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Status</th>
                                        <td><span class="badge badge-pill badge-primary"><?php echo $row['status']; ?></span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Date and Time</th>
                                        <td><?php echo $row['trn_date']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Address</th>
                                        <td><?php echo $row['address']; ?></td>
                                    </tr>

                                    <tr>
                                        <th scope="row">City</th>
                                        <td><?php echo $row['city']; ?></td>
                                    </tr>

                                    <tr>
                                        <th scope="row">State</th>
                                        <td><?php echo $row['state']; ?></td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Country</th>
                                        <td><?php echo $row['country']; ?></td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Pincode</th>
                                        <td><?php echo $row['pincode']; ?></td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Phone</th>
                                        <td><?php echo $row['phone']; ?></td>
                                    </tr>
                                    </tbody>
                            </table>
                       
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