<?php
include 'db.php';
if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit;
}
$id = $_REQUEST['id'];

$emaill = $_SESSION['email'];
$queryshow = "SELECT * from users WHERE email='" . $emaill . "'";
$result = mysqli_query($db, $queryshow);
$rowuser = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon.ico">
    <title>Munchbox | Checkout</title>
    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="#">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="#">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="#">
    <link rel="apple-touch-icon-precomposed" href="#">
    <link rel="shortcut icon" href="#">
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fontawesome -->
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <!-- Flaticons -->
    <link href="assets/css/font/flaticon.css" rel="stylesheet">
    <!-- Swiper Slider -->
    <link href="assets/css/swiper.min.css" rel="stylesheet">
    <!-- Range Slider -->
    <link href="assets/css/ion.rangeSlider.min.css" rel="stylesheet">
    <!-- magnific popup -->
    <link href="assets/css/magnific-popup.css" rel="stylesheet">
    <!-- Nice Select -->
    <link href="assets/css/nice-select.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- Custom Responsive -->
    <link href="assets/css/responsive.css" rel="stylesheet">
    <!-- Color Change -->
    <link rel="stylesheet" class="color-changing" href="assets/css/color4.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&amp;display=swap" rel="stylesheet">
    <!-- place -->
</head>

<body>
    <!-- Navigation -->
    <?php include 'include/body_header.php' ?>
    <div class="main-sec"></div>
    <!-- Navigation -->
    <section class="final-order section-padding bg-light-theme">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box padding-20">
                        <div class="row mb-xl-20">
                            <div class="col-md-6">
                                <?php
                                //$query = "SELECT * FROM snacks WHERE id = '$id'";
                                $query = "SELECT snacks.id,snacks.img, snacks.name, snacks.category, snacks.quantity, 
                                snacks.price, snacks.description, snacks.status, vendor.id as ID, vendor.r_name, vendor.r_location,vendor.v_profile , vendor.email
                                FROM snacks LEFT JOIN vendor ON snacks.uploaded_by = vendor.id WHERE snacks.id = '$id'";
                                $result = mysqli_query($db, $query);
                                $row = $result->fetch_assoc();
                                ?>
                                <div class="section-header-left">
                                    <h3 class="text-light-black header-title fw-700"><?php echo $row['name']; ?></h3>
                                    <a href="restaurant.php?id=<?php echo $row["ID"]; ?>"><h6 class="text-light-green fw-600 mb-1">From, <?php echo $row['r_name']; ?></h6></a>
                                    <p class="text-light-white title2 "><?php echo $row['r_location']; ?></p>
                                </div>
                                
                                <h6 class="text-light-black fw-700 fs-14"><?php echo $row['description']; ?></h6>
                                <p class="text-light-green fw-600"><?php echo $row['status']; ?></p>
                                <p class="text-light-white title2 mb-1">Price<span style="color: red"><?php echo $row['price']; ?> RS</span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <div class="advertisement-img">
                                    <img src="/SnacksStation/uploads/admin-snacks-img/<?php echo $row['img']; ?>" style="height: 300px; width: 700px;" class="img-fluid full-width" alt="advertisement-img">
                                </div>
                            </div>
                            <a href="add_to_cart.php?snackid=<?php echo $row["id"]; ?>&vendorid=<?php echo $row["ID"]; ?>&userid=<?php echo $rowuser["id"]; ?>">
                            <button type="button" class="btn" style="background-color: red; color: white; margin-top: 10px; margin-bottom: 10px; margin-left: 15px">Order Now</button></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- footer -->
    <?php include 'include/body_footer.php' ?>
    <!-- Place all Scripts Here -->
    <!-- jQuery -->
    <script src="assets/js/jquery.min.js"></script>
    <!-- Popper -->
    <script src="assets/js/popper.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Range Slider -->
    <script src="assets/js/ion.rangeSlider.min.js"></script>
    <!-- Swiper Slider -->
    <script src="assets/js/swiper.min.js"></script>
    <!-- Nice Select -->
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <!-- magnific popup -->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <!-- Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnd9JwZvXty-1gHZihMoFhJtCXmHfeRQg"></script>
    <!-- sticky sidebar -->
    <script src="assets/js/sticksy.js"></script>
    <!-- Munch Box Js -->
    <script src="assets/js/munchbox.js"></script>
    <!-- /Place all Scripts Here -->
</body>

</html>