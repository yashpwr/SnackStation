<?php
include 'db.php';
if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit;
}
//create order table
$sql = "CREATE TABLE `order` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `order_id` varchar(100) NOT NULL,
    `user_id` varchar(100) NOT NULL,
    `snack_id` varchar(100) NOT NULL,
    `vendor_id` varchar(100) NOT NULL,
    `trn_date` datetime NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
mysqli_query($db, $sql);

//create order_details table
$sql = "CREATE TABLE `order_details` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `order_id` varchar(100) NOT NULL,
    `name` varchar(100) NOT NULL,
    `email` varchar(100) NOT NULL,
    `address` varchar(100) NOT NULL,
    `city` varchar(100) NOT NULL,
    `state` varchar(100) NOT NULL,
    `country` varchar(100) NOT NULL,
    `pincode` int(11) NOT NULL,
    `phone` int(11) NOT NULL,
    `trn_date` datetime NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
mysqli_query($db, $sql);

$emaill = $_SESSION['email'];
$queryshow = "SELECT * from users WHERE email='" . $emaill . "'";
$result = mysqli_query($db, $queryshow);
$rowuser = mysqli_fetch_assoc($result);
$user_id = $rowuser['id'];

if (isset($_POST['submit'])) {
    // receive all input values from the form
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $city = mysqli_real_escape_string($db, $_POST['city']);
    $state = mysqli_real_escape_string($db, $_POST['state']);
    $country = mysqli_real_escape_string($db, $_POST['country']);
    $pincode = mysqli_real_escape_string($db, $_POST['pincode']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $trn_date = date("Y-m-d H:i:s");

    $query2 = "SELECT snacks.id as ID, snacks.uploaded_by, snacks.price, snacks.category, snacks.img, cart.id, 
    cart.snacks_id, cart.id as cartid, cart.user_id, cart.vendor_id FROM snacks JOIN cart ON snacks.id = cart.snacks_id 
    WHERE cart.user_id = '$user_id'";
    $res = mysqli_query($db, $query2);
    $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
    $orderid = substr(str_shuffle($data), 0, 6);
    $order_id = $orderid;
    while ($roww = mysqli_fetch_array($res)) {
        $cart_id = $roww['cartid'];
        $vendor_id = $roww['vendor_id'];
        $snack_id = $roww['ID'];
        $trn_date = date("Y-m-d H:i:s");
        $query3 = "INSERT INTO `order` (order_id, user_id, snack_id, vendor_id, trn_date) VALUE ('$order_id','$user_id','$snack_id','$vendor_id','$trn_date');";
        if (mysqli_query($db, $query3)) {
            if (mysqli_query($db, "DELETE FROM cart where id='$cart_id'")) {
                
                echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                        <script src="assets/js/toastr.min.js"></script>
                        <script src="assets/js/toast.js"></script>
                        <script>
                        jQuery(document).ready(function () {
                        Toaster.checkoutt(); });
                        </script>';

        //header("location:order-details.php");
            }
        }
        else{
            header("location:order-details.php");
        }
    }
    $query4 = "INSERT INTO order_details (order_id, name, email, address, city, state, country, pincode, phone, trn_date)
             VALUE ('$order_id','$name','$email','$address','$city','$state','$country','$pincode','$phone','$trn_date');";
             mysqli_query($db, $query4);
}
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
    <link href="assets/css/toastr.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation -->
    <?php include 'include/body_header.php' ?>
    <div class="main-sec"></div>
    <!-- Navigation -->
    <section class="final-order section-padding bg-light-theme">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="main-box padding-20">
                        <div class="row mb-xl-20">
                            <div class="col-md-6">
                                <div class="section-header-left">
                                    <h3 class="text-light-black header-title fw-700">Review and place order</h3>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <form method="post">
                                    <div class="payment-sec">
                                        <div class="form-group">
                                            <label class="text-light-white fs-14">Full Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Full Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-light-white fs-14">Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Email I'd" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-light-white fs-14">Address</label>
                                            <input type="text" class="form-control" name="address" placeholder="Address" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-light-white fs-14">City</label>
                                            <input type="text" class="form-control" name="city" placeholder="city" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-light-white fs-14">State</label>
                                            <input type="text" class="form-control" name="state" placeholder="state" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-light-white fs-14">Country</label>
                                            <input type="text" class="form-control" name="country" placeholder="country" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-light-white fs-14">pincode</label>
                                            <input type="text" class="form-control" name="pincode" placeholder="pincode" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-light-white fs-14">Phone Number</label>
                                            <input type="text" class="form-control" name="phone" placeholder="Phone Number" required>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn-second btn-submit full-width" name="submit">Place Order</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="cart-detail-box">
                            <div class="card">
                                <div class="card-header padding-15 fw-700">Your order
                                </div>
                                <div class="card-body no-padding" id="scrollstyle-4">
                                    <?php
                                    $user_id = $row['id'];
                                    $query = "SELECT snacks.id as ID, snacks.name, snacks.price, cart.id as cid FROM cart 
                                        LEFT JOIN snacks ON snacks.id = cart.snacks_id WHERE cart.user_id='$user_id'";
                                    $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                    $count = 1;
                                    while ($r = mysqli_fetch_array($result)) {
                                    ?>
                                        <div class="cat-product-box">
                                            <div class="cat-product">
                                                <div class="cat-name">
                                                    <a href="product_details.php?id=<?php echo $r["ID"]; ?>">
                                                        <p class="text-light-green"> <?php echo $r['name']; ?></p>
                                                    </a>
                                                </div>
                                                <div class="delete-btn">
                                                    <a href="delete_order.php?id=<?php echo $r['cid']; ?>" class="text-dark-white"> <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                                <div class="price"> <a href="product_details.php?id=<?php echo $r["ID"]; ?>" class="text-dark-white fw-500">
                                                        <?php echo $r['price']; ?> RS
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    <?php $count++;
                                    } ?>

                                    <!-- product end -->
                                    <?php
                                    $query = "SELECT SUM(snacks.price) AS total FROM cart LEFT JOIN snacks ON snacks.id = cart.snacks_id WHERE cart.user_id='$user_id'";
                                    $res = mysqli_query($db, $query) or die(mysqli_error($db));
                                    $total = mysqli_fetch_assoc($res);
                                    ?>
                                    <div class="item-total">
                                        <div class="total-price border-0 pb-0"> <span class="text-dark-white fw-600">Items subtotal:</span>
                                            <span class="text-dark-white fw-600"><?php echo $total['total']; ?> RS</span>
                                        </div>
                                        <div class="total-price border-0 pt-0 pb-0"> <span class="text-light-green fw-600">Delivery fee:</span>
                                            <span class="text-light-green fw-600">Free</span>
                                        </div>
                                        <div class="total-price border-0 "> <span class="text-light-black fw-700">Total:</span>
                                            <span class="text-light-black fw-700"><?php echo $total['total']; ?> RS</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer p-0 modify-order">
                                    <a href="javascript:void(0)" class="total-amount"> <span class="text-custom-white fw-700">TOTAL</span>
                                        <span class="text-custom-white fw-700"><?php echo $total['total']; ?> RS</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- footer -->
    <?php include 'include/body_footer.php' ?>
    <!-- footer -->


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