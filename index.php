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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon.ico">
    <title>SnacksStation | Index</title>
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

    <link href="assets/css/toastr.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'include/body_header.php' ?>
    <!-- slider -->
    <section class="about-us-slider swiper-container p-relative">
        <div class="swiper-wrapper">
            <?php
            $query = "select * from slider";
            $result = mysqli_query($db, $query);
            $count = 1;
            while ($r = mysqli_fetch_array($result)) {
            ?>
                <div class="swiper-slide slide-item">
                    <img src="/SnacksStation/uploads/slider-img/<?php echo $r['img']; ?>" class="img-fluid full-width" alt="Banner">
                    <div class="transform-center">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-lg-7 align-self-center">
                                    <div class="right-side-content">
                                        <h1 class="text-custom-white fw-600"><?php echo $r['title']; ?></h1>
                                        <h3 class="text-custom-white fw-400"><?php echo $r['description']; ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php $count++;
            } ?>
        </div>
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </section>
    <!-- slider -->
    <!-- Explore collection -->
    <section class="ex-collection section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-header-left">
                        <h3 class="text-light-black header-title title">Explore our Latest collections</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-8">
                    <div class="row">
                        <?php
                        $query = "SELECT snacks.id as ID,snacks.img, snacks.name,  snacks.category,  snacks.quantity, 
                        snacks.price, snacks.description, snacks.status, vendor.id, vendor.r_name, vendor.r_location FROM snacks
                        LEFT JOIN vendor ON snacks.uploaded_by = vendor.id GROUP BY snacks.id DESC";
                        $result = mysqli_query($db, $query);
                        $count = 1;
                        while ($r = mysqli_fetch_array($result)) {
                        ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product-box mb-xl-20">
                                    <div class="product-img">
                                        <a href="product_details.php?id=<?php echo $r["ID"]; ?>">
                                            <img src="/SnacksStation/uploads/admin-snacks-img/<?php echo $r['img']; ?>" style="height: 200px; width: 508px;" class="img-fluid full-width" alt="product-img">
                                        </a>
                                    </div>
                                    <div class="product-caption">
                                        <div class="title-box">
                                            <h6 class="product-title"><a href="product_details.php?id=<?php echo $r["ID"]; ?>" class="text-light-black" style="margin-bottom: -3px;">
                                                    <?php echo $r['name']; ?></a></h6>
                                            <div class="tags">
                                                <a href="add_to_cart.php?snackid=<?php echo $r["ID"]; ?>&vendorid=<?php echo $r["id"]; ?>&userid=<?php echo $rowuser["id"]; ?>"><span class="text-custom-white rectangle-tag bg-red">
                                                    Order Now
                                                </span></a>
                                            </div>
                                        </div>
                                        <a href="restaurant.php?id=<?php echo $r["id"]; ?>" class="text-light-black ">
                                            <p style="color: red; margin-bottom: -3px;"><?php echo $r['r_name']; ?></p>
                                        </a>
                                        <p style="margin-bottom: -3px;"><?php echo $r['r_location']; ?></p>
                                        <div class="product-details">
                                            <div class="price-time">
                                                <span class="text-light-white price"><?php echo $r['price']; ?> RS</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php $count++;
                        } ?>
                    </div>
                </div>

                <section class="section-padding exclusive-deals">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7 align-self-center">
                                <div class="title">
                                    <div class="deals-heading">
                                        <h2 class="text-light-black fw-700">Discover exclusive deals with Perks</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="deals-image">
                                    <img src="assets/img/deals/banner-1.jpg" class="img-fluid full-width" alt="#">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="row">
                    <div class="col-12">
                        <div class="section-header-left">
                            <h3 class="text-light-black header-title title">Explore our collections</h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-8">
                    <div class="row">
                        <?php
                        $query = "SELECT snacks.id as ID,snacks.img, snacks.name, snacks.category, snacks.quantity, 
                        snacks.price, snacks.description, snacks.status, vendor.id, vendor.r_name, vendor.r_location FROM snacks
                        LEFT JOIN vendor ON snacks.uploaded_by = vendor.id GROUP BY snacks.id ASC";
                        $result = mysqli_query($db, $query);
                        $count = 1;
                        while ($r = mysqli_fetch_array($result)) {
                        ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product-box mb-xl-20">
                                    <div class="product-img">
                                        <a href="product_details.php?id=<?php echo $r["ID"]; ?>">
                                            <img src="/SnacksStation/uploads/admin-snacks-img/<?php echo $r['img']; ?>" style="height: 200px; width: 508px;" class="img-fluid full-width" alt="product-img">
                                        </a>
                                    </div>
                                    <div class="product-caption">
                                        <div class="title-box">
                                            <h6 class="product-title"><a href="product_details.php?id=<?php echo $r["ID"]; ?>" class="text-light-black" style="margin-bottom: -3px;">
                                                    <?php echo $r['name']; ?></a></h6>
                                            <a href="add_to_cart.php?snackid=<?php echo $r["ID"]; ?>&vendorid=<?php echo $r["id"]; ?>&userid=<?php echo $rowuser["id"]; ?>"><span class="text-custom-white rectangle-tag bg-red">
                                                    Order Now
                                                </span></a>
                                        </div>
                                        <a href="restaurant.php?id=<?php echo $r["id"]; ?>" class="text-light-black ">
                                            <p style="color: red; margin-bottom: -3px;"><?php echo $r['r_name']; ?></p>
                                        </a>
                                        <p style="margin-bottom: -3px;"><?php echo $r['r_location']; ?></p>
                                        <div class="product-details">
                                            <div class="price-time">
                                                <span class="text-light-white price"><?php echo $r['price']; ?> RS</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php $count++;
                        } ?>
                    </div>
                </div>

                <div class="restaurent-ad section-padding">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="ad-img p-relative">
                                    <img src="assets/img/about/blog/1110x350/hbanner-2.jpg" class="img-fluid full-width">
                                    <div class="overlay">
                                        <div class="content-box transform-center">
                                            <p class="text-custom-white">SnackStation</p>
                                            <h3 class="text-custom-white mb-1">More than 3000 restaurents</h3>
                                            <h5 class="text-custom-white">Book a meal easily at the best price</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-8">
                    <div class="row">
                        <?php
                        $query = "SELECT snacks.id as ID,snacks.img, snacks.name, snacks.category, snacks.quantity, 
                        snacks.price, snacks.description, snacks.status, vendor.id, vendor.r_name, vendor.r_location FROM snacks
                        LEFT JOIN vendor ON snacks.uploaded_by = vendor.id GROUP BY snacks.id ASC LIMIT 3";
                        $result = mysqli_query($db, $query);
                        $count = 1;
                        while ($r = mysqli_fetch_array($result)) {
                        ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product-box mb-xl-20">
                                    <div class="product-img">
                                        <a href="product_details.php?id=<?php echo $r["ID"]; ?>">
                                            <img src="/SnacksStation/uploads/admin-snacks-img/<?php echo $r['img']; ?>" style="height: 200px; width: 508px;" class="img-fluid full-width" alt="product-img">
                                        </a>
                                    </div>
                                    <div class="product-caption">
                                        <div class="title-box">
                                            <h6 class="product-title"><a href="product_details.php?id=<?php echo $r["ID"]; ?>" class="text-light-black" style="margin-bottom: -3px;">
                                                    <?php echo $r['name']; ?></a></h6>
                                            <a href="add_to_cart.php?snackid=<?php echo $r["ID"]; ?>&vendorid=<?php echo $r["id"]; ?>&userid=<?php echo $rowuser["id"]; ?>"><span class="text-custom-white rectangle-tag bg-red">
                                                    Order Now
                                                </span></a>
                                        </div>
                                        <a href="restaurant.php?id=<?php echo $r["id"]; ?>" class="text-light-black ">
                                            <p style="color: red; margin-bottom: -3px;"><?php echo $r['r_name']; ?></p>
                                        </a>
                                        <p style="margin-bottom: -3px;"><?php echo $r['r_location']; ?></p>
                                        <div class="product-details">
                                            <div class="price-time">
                                                <span class="text-light-white price"><?php echo $r['price']; ?> RS</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php $count++;
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Explore collection -->
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
    <!-- sticky sidebar -->
    <script src="assets/js/sticksy.js"></script>
    <!-- Munch Box Js -->
    <script src="assets/js/munchbox.js"></script>
    <!-- /Place all Scripts Here -->

    <script src="assets/js/toast.js"></script>
    <script src="assets/js/toastr.min.js"></script>
</body>

</html>