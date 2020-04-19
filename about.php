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
    <link rel="icon" type="image/png" sizes="32x32" href="favicon.ico">
    <title>Munchbox | About Us</title>
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
    <!-- about us -->
    <section class="aboutus section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="history-title mb-md-40">
                        <h2 class="text-light-black">A History Has Written For SnackStation Explore <span class="text-light-green">more Our Story</span></h2>
                        <p class="text-light-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>
                        <p class="text-light-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-sm-6 col-md-6">
                            <div class="histry-img mb-xs-20">
                                <img src="assets/img/about/blog/255x200/about-section-3.jpg" class="img-fluid full-width" alt="Histry">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-md-6">
                            <div class="histry-img mb-xl-20">
                                <img src="assets/img/about/blog/255x200/about-section-1.jpg" class="img-fluid full-width" alt="Histry">
                            </div>
                            <div class="histry-img">
                                <img src="assets/img/about/blog/255x200/about-section-2.jpg" class="img-fluid full-width" alt="Histry">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about us -->
    <!-- How It Woks -->
    <section class="section-padding how-it-works bg-light-theme">
        <div class="container">
            <div class="section-header-style-2">
                <h6 class="text-light-green sub-title">Our Process</h6>
                <h3 class="text-light-black header-title">How Does It Work</h3>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="how-it-works-box arrow-1">
                        <div class="how-it-works-box-inner"> <span class="icon-box">
                <img src="assets/img/001-search.png" alt="icon">
                <span class="number-box">01</span>
                            </span>
                            <h6>Search</h6>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="how-it-works-box arrow-2">
                        <div class="how-it-works-box-inner"> <span class="icon-box">
                <img src="assets/img/004-shopping-bag.png" alt="icon">
                <span class="number-box">02</span>
                            </span>
                            <h6>Select</h6>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="how-it-works-box arrow-1">
                        <div class="how-it-works-box-inner"> <span class="icon-box">
                <img src="assets/img/002-stopwatch.png" alt="icon">
                <span class="number-box">03</span>
                            </span>
                            <h6>Order</h6>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="how-it-works-box">
                        <div class="how-it-works-box-inner"> <span class="icon-box">
                <img src="assets/img/003-placeholder.png" alt="icon">
                <span class="number-box">04</span>
                            </span>
                            <h6>Enjoy</h6>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- How It Woks -->
 
    <!-- feedback -->
    <section class="feedback-area-two section-padding">
        <div class="container">
            <div class="section-header-style-2">
                <h6 class="text-light-green sub-title">Testimonials</h6>
                <h3 class="text-custom-white header-title">People Say About Us!</h3>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="feedback-slider p-relative swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="feedback-item-two">
                                    <img src="assets/img/about/72x72/user-1.png" alt="Feedback">
                                    <p class="text-custom-white fs-16">I like Munchbox and as compared to other company it's polices and customers support is very good easy to reach., also many time they unable to delivered. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisist amet, sed do eiusm.</p>
                                    <h4 class="text-custom-white fw-600 no-margin">Janadhon doe</h4>
                                    <span class="text-custom-white fw-600">Co-founder</span>
                                </div>
                            </div>
                        </div>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- feedback -->
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


<!-- Mirrored from slidesigma.com/themes/html/munchbox/about.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Feb 2020 15:58:18 GMT -->
</html>
