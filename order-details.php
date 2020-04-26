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
$id = $rowuser['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon.ico">
    <title>Munchbox | Order Details</title>
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
    <!-- tracking map -->
    <section class="checkout-page section-padding bg-light-theme">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- recipt -->
                    <?php
                    $queryshow = "SELECT snacks.id as ID, snacks.name, snacks.price, snacks.img, `order`.`snack_id`, `order`.`order_id`, 
                        `order`.`user_id`, vendor.r_name, users.email, order_details.name as oname, order_details.address, order_details.city, order_details.state,
                        order_details.country, order_details.pincode, order_details.phone, order_details.status as orderstatus
                        FROM `order`
                        JOIN snacks ON `order`.`snack_id` = snacks.id 
                        JOIN vendor ON `order`.`vendor_id` = vendor.id
                        JOIN users ON `order`.`user_id` = users.id
                        JOIN order_details ON `order`.`order_id` = order_details.order_id
                        WHERE `order`.user_id = '$id'";
                    $resultt = mysqli_query($db, $queryshow);
                    $row = mysqli_fetch_assoc($resultt);

                    
                    $q = "SELECT * FROM `order` WHERE user_id = $id";
                    $ress = mysqli_query($db, $q);
                    if (mysqli_num_rows($ress) == 0) {
                    ?>
                    <div class="recipt-sec padding-20">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="recipt-name full-width padding-tb-10 pt-0">
                                        <h5 class="text-light-black fw-600">Come back after order some food..!!!</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                    else{ ?>
                    <div class="recipt-sec padding-20">
                        <div class="u-line mb-xl-20">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="recipt-name full-width padding-tb-10 pt-0">
                                        <h5 class="text-light-black fw-600">Delivery (ASAP) to:</h5>
                                        <span class="text-light-white "><?php echo $row["oname"]; ?></span>
                                        <span class="text-light-white ">Home</span>
                                        <span class="text-light-white "><?php echo $row["address"]; ?></span>
                                        <span class="text-light-white "><?php echo $row["city"] . ", " . $row["state"] . ", " . $row["country"]; ?></span>
                                        <p class="text-light-white "><?php echo $row["pincode"]; ?></p>
                                        <p class="text-light-white "><?php echo $row["phone"]; ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                </div>
                                <div class="col-lg-4">
                                </div>
                            </div>
                        </div>
                        <div class="u-line mb-xl-20">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5 class="text-light-black fw-600 title">Your Order<span class="text-light-black">Order ID - <?php echo $row["order_id"]; ?></span> </h5>
                                </div>
                                <div class="col-lg-12">
                                    <?php
                                    $quer = "SELECT snacks.id as ID, snacks.name, snacks.price, snacks.img, order_details.id as orderid, order_details.status
                                    FROM `order`
                                    JOIN order_details ON `order`.`order_id` = order_details.order_id 
                                    JOIN snacks ON `order`.`snack_id` = snacks.id 
                                    WHERE `order`.user_id = '$id'";
                                    $res = mysqli_query($db, $quer);
                                    $count = 1;
                                        while ($r = mysqli_fetch_array($res)) {
                                            ?>
                                        <div class="checkout-product">
                                            <div class="img-name-value">
                                                <div class="product-img">
                                                    <a href="#">
                                                        <img src="/SnacksStation/uploads/admin-snacks-img/<?php echo $r['img']; ?>" style="height: 100px; width: 100px;" alt="#">
                                                    </a>
                                                </div>
                                                <div class="product-value"> <span class="text-light-white"></span>
                                                </div>
                                                <div class="product-name"> <span><a href="#" class="text-light-white"><?php echo $r['name']; ?></a></span>
                                                </div>
                                                <?php if($r["status"] == "pending") {?>
                                                <div class="product-value"> <span class="text-light-white"></span>
                                                </div>
                                                <div class="tags">
                                                <a href="cancel-order.php?id=<?php echo $r["orderid"]; ?>"><span class="text-custom-white rectangle-tag bg-red">Cancel Order
                                                </span></a>
                                                </div>
                                                <?php } ?>

                                                <div class="product-value"> <span class="text-light-white"></span>
                                                </div>
                                                <div class="tags">
                                                <span class="text-custom-white rectangle-tag bg-red"><?php echo $r["status"]; ?>
                                                </span>
                                            </div>
                                            </div>
                                            <div class="price"> <span class="text-light-white"> RS <?php echo $r['price']; ?></span>
                                            </div>
                                        </div>
                                    <?php $count++;
                                    } ?> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <!-- tracking map -->
    <!-- footer -->
    <?php include 'include/body_footer.php' ?>
    <div class="md-overlay"></div>

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
    <script src="assets/js/map.js"></script>
    <!-- sticky sidebar -->
    <script src="assets/js/sticksy.js"></script>
    <!-- Munch Box Js -->
    <script src="assets/js/munchbox.js"></script>
    <!-- /Place all Scripts Here -->
</body>


<!-- Mirrored from slidesigma.com/themes/html/munchbox/order-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Feb 2020 15:59:24 GMT -->

</html>