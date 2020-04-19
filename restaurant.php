<?php
include 'db.php';
if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit;
}

$emaill = $_SESSION['email'];
$queryshow = "SELECT * from users WHERE email='" . $emaill . "'";
$result = mysqli_query($db, $queryshow);
$rowuser = mysqli_fetch_assoc($result);
$vendor_id = $_REQUEST['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon.ico">
    <title>Munchbox | Restaurant</title>
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
    <!-- Custom Stylesheet -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- Custom Responsive -->
    <link href="assets/css/responsive.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation -->
    <?php include 'include/body_header.php' ?>
    <div class="main-sec"></div>
    <!-- Navigation -->
    <!-- restaurent top -->
    <div class="page-banner p-relative smoothscroll" id="menu">
        <img src="assets/img/banner.jpg" class="img-fluid full-width" alt="banner">
        <div class="overlay-2">
            <div class="container">
            </div>
        </div>
    </div>
    <!-- restaurent top -->
    <!-- restaurent details -->
    <?php
    $query = "SELECT snacks.id as ID,snacks.img, snacks.name, snacks.category, snacks.quantity, 
            snacks.price, snacks.description, snacks.status, vendor.id, vendor.r_name, vendor.r_location, vendor.v_profile , vendor.email
            FROM snacks
            LEFT JOIN vendor ON snacks.uploaded_by = vendor.id WHERE vendor.id = '$vendor_id'";
    $result = mysqli_query($db, $query);
    $row = $result->fetch_assoc();
    ?>
    <section class="restaurent-details  u-line">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading padding-tb-10">
                        <h3 class="text-light-black title fw-700 no-margin"><?php echo $row['r_name']; ?></h3>
                        <p class="text-light-black sub-title no-margin"><?php echo $row['r_location']; ?>
                            <span><a href="product_details.php" class="text-success">Change locations</a></span>
                        </p>
                    </div>
                    <div class="restaurent-logo">
                        <img src="/SnacksStation/uploads/vendor-profile-img/<?php echo $row['v_profile']; ?>" style="width: 80px; height: 80px;" class="img-fluid" alt="#">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- restaurent details -->
    <!-- restaurent address -->
    <div class="restaurent-address u-line">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="address-details">
                        <div class="address">
                            <div class="delivery-address"> <a href="order-details.html" class="text-light-black">Delivery, ASAP (45–55m)</a>
                                <div class="delivery-type"> <span class="text-success fs-12 fw-500">No minimun</span><span class="text-light-white">, Free Delivery</span>
                                </div>
                            </div>
                            <div class="change-address"> <a href="product_details.php" class="fw-500">Change</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- restaurent address -->
    <!-- restaurent meals -->
    <section class="section-padding restaurent-meals bg-light-theme">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-2 col-lg-3">
                </div>
                <div class="col-xl-8 col-lg-6">
                    <div class="row">
                        <div class="col-lg-12 restaurent-meal-head mb-md-40">
                            <div class="card">
                                <div class="card-header">
                                    <div class="section-header-left">

                                    </div>
                                </div>
                                <div id="collapseOne" class="collapse show">
                                    <div class="card-body no-padding">
                                        <div class="row">
                                            <?php
                                            $resultt = mysqli_query($db, $query);
                                            $count = 1;
                                            while ($r = mysqli_fetch_array($resultt)) {
                                            ?>
                                                <!-- product start -->
                                                <div class="col-lg-12">
                                                    <div class="restaurent-product-list">
                                                        <div class="restaurent-product-detail">
                                                            <div class="restaurent-product-left">
                                                                <div class="restaurent-product-title-box">
                                                                    <div class="restaurent-product-box">
                                                                        <div class="restaurent-product-title">
                                                                            <h6 class="mb-2" data-toggle="modal" data-target="#restaurent-popup">
                                                                                <a href="product_details.php?id=<?php echo $r["ID"]; ?>" class="text-light-black fw-600"><?php echo $r['name']; ?></a></h6>
                                                                            <p class="text-light-white"><?php echo $r['price']; ?>$</p>
                                                                        </div>
                                                                        <div class="restaurent-product-label">
                                                                            <a href="add_to_cart.php?snackid=<?php echo $r["ID"]; ?>&vendorid=<?php echo $r["id"]; ?>&userid=<?php echo $rowuser["id"]; ?>">
                                                                                <span class="rectangle-tag bg-gradient-red text-custom-white">Order Now</span></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="restaurent-product-caption-box"> <span class="text-light-white"><?php echo $r['description']; ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="restaurent-product-img">
                                                                <img src="/SnacksStation/uploads/admin-snacks-img/<?php echo $r['img']; ?>" style="height: 120px; width: 120px;" class="img-fluid" alt="#">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php $count++;
                                            } ?>
                                            <!-- product end -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- restaurent meals -->
    <!-- restaurent about -->
    <section class="section-padding restaurent-about smoothscroll" id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="text-light-black fw-700 title"><?php echo $row['name']; ?> Menu Info</h3>
                    <p class="text-light-green no-margin"><?php echo $row['description']; ?></p>
                    <ul class="about-restaurent">
                        <li> <i class="fas fa-map-marker-alt"></i>
                            <span>
                                <a href="#" class="text-light-white">
                                    <?php echo $row['r_location']; ?>
                                </a>
                            </span>
                        </li>
                        <li> <i class="far fa-envelope"></i>
                            <span><a href="mailto:<?php echo $row['email']; ?>" class="text-light-white"><?php echo $row['email']; ?></a></span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <div class="restaurent-schdule">
                        <div class="card">
                            <div class="card-header text-light-white fw-700 fs-16">Hours</div>
                            <div class="card-body">
                                <div class="schedule-box">
                                    <div class="day text-light-black">Monday</div>
                                    <div class="time text-light-black">Delivery: 7:00am - 10:59pm</div>
                                </div>
                                <div class="collapse" id="schdule">
                                    <div class="schedule-box">
                                        <div class="day text-light-black">Tuesday</div>
                                        <div class="time text-light-black">Delivery: 7:00am - 10:00pm</div>
                                    </div>
                                    <div class="schedule-box">
                                        <div class="day text-light-black">Wednesday</div>
                                        <div class="time text-light-black">Delivery: 7:00am - 10:00pm</div>
                                    </div>
                                    <div class="schedule-box">
                                        <div class="day text-light-black">Thursday</div>
                                        <div class="time text-light-black">Delivery: 7:00am - 10:00pm</div>
                                    </div>
                                    <div class="schedule-box">
                                        <div class="day text-light-black">Friday</div>
                                        <div class="time text-light-black">Delivery: 7:00am - 10:00pm</div>
                                    </div>
                                    <div class="schedule-box">
                                        <div class="day text-light-black">Saturday</div>
                                        <div class="time text-light-black">Delivery: 7:00am - 10:00pm</div>
                                    </div>
                                    <div class="schedule-box">
                                        <div class="day text-light-black">Sunday</div>
                                        <div class="time text-light-black">Delivery: 7:00am - 10:00pm</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer"> <a class="fw-500 collapsed" data-toggle="collapse" href="#schdule">See the full schedule</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- restaurent about -->
    <!-- footer -->
    <?php include 'include/body_footer.php' ?>
    <!-- footer -->
    <!-- product popup -->

    <!-- Theme skins -->
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
    <!-- Maps -->
    <script src="assets/js/sticksy.js"></script>
    <!-- Munch Box Js -->
    <script src="assets/js/munchbox.js"></script>
    <!-- /Place all Scripts Here -->
</body>

</html>