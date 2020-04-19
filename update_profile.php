<?php
require('db.php');
if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit;
}
?>
<?php
$email = $_SESSION['email'];
$sel_query = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($db, $sel_query) or die(mysqli_error());
$row1 = mysqli_fetch_assoc($result);

$targetDir = $_SERVER["DOCUMENT_ROOT"] . "/SnacksStation/uploads/user-profile-img/";

$id = $row1['id'];
if (isset($_POST['submit']) && isset($_FILES['img'])) {
    $img = $_FILES["img"]["name"];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email =  $_POST['email'];
    $trn_date = date("Y-m-d H:i:s");

    if ($_FILES["img"]["name"] != "") {
        $targetFilePath = $targetDir . $img;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $targetFilePath)) {
                // Insert image file name into database
                $queryi = "UPDATE users SET img='$img', fname='$fname', lname='$lname', email='$email' WHERE id='$id'";
                $result = mysqli_query($db, $queryi);
                if ($result) {
                    header('location: profile.php');
                }
            }
        } else {
            $query = "UPDATE users SET fname='$fname', lname='$lname', email='$email' WHERE id='$id'";
            $result = mysqli_query($db, $query);
            header('location: profile.php');
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon.ico">
    <title>SnacksStation | Edit Profile</title>
    <!-- Fav and touch icons -->
    <link rel="icon" type="image/png" sizes="32x32" href="favicon.ico">
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
    <style>
        body {
            background: #fe444412;
        }

        .emp-profile {
            padding: 3%;
            margin-top: 6%;
            margin-bottom: 3%;
            border-radius: 0.5rem;
            background: #fff;
        }

        .profile-img {
            text-align: center;
        }

        .profile-img img {
            margin-top: 10%;
            width: 70%;
            height: 100%;
        }

        .profile-img .file {
            position: relative;
            overflow: hidden;
            margin-top: -20%;
            width: 70%;
            border: none;
            border-radius: 0;
            font-size: 15px;
            background: #212529b8;
        }

        .profile-img .file input {
            position: absolute;
            opacity: 0;
            right: 0;
            top: 0;
        }

        .profile-head h5 {
            color: #333;
        }

        .profile-head h6 {
            color: #0062cc;
        }

        .profile-edit-btn {
            border: none;
            border-radius: 1.5rem;
            width: 70%;
            padding: 2%;
            font-weight: 600;
            color: #6c757d;
            cursor: pointer;
        }

        .proile-rating {
            font-size: 12px;
            color: #818182;
            margin-top: 5%;
        }

        .proile-rating span {
            color: #495057;
            font-size: 15px;
            font-weight: 600;
        }

        .profile-head .nav-tabs {
            margin-bottom: 5%;
        }

        .profile-head .nav-tabs .nav-link {
            font-weight: 600;
            border: none;
        }

        .profile-head .nav-tabs .nav-link.active {
            border: none;
            border-bottom: 2px solid #0062cc;
        }

        .profile-work {
            padding: 14%;
            margin-top: -15%;
        }

        .profile-work p {
            font-size: 12px;
            color: #818182;
            font-weight: 600;
            margin-top: 10%;
        }

        .profile-work a {
            text-decoration: none;
            color: #495057;
            font-weight: 600;
            font-size: 14px;
        }

        .profile-work ul {
            list-style: none;
        }

        .profile-tab label {
            font-weight: 600;
        }

        .profile-tab p {
            font-weight: 600;
            color: #0062cc;
        }
    </style>
</head>

<body>
     <?php include 'include/body_header.php' ?>
    <div class="container emp-profile">
        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <?php if ($row1['img'] == "") { ?>
                            <img src="https://maxcdn.icons8.com/Share/icon/Users//user_male_circle_filled1600.png" alt="profile picture" />
                        <?php } else { ?>
                            <img src="/SnacksStation/uploads/user-profile-img/<?php echo $row1['img']; ?>" alt="profile picture" />
                        <?php } ?>
                        <div class="file btn btn-lg btn-primary">
                            Change Photo
                            <input type="file" name="img" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        <h5><span>Full Name:</span>&nbsp;&nbsp;&nbsp;
                            <?php echo $row1["fname"] . " " .  $row1["lname"]; ?>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-8">
                    <div class=" profile-tab">
                        <div class="col-md-6">
                            <label>First Name</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name" value="<?php echo $row1['fname']; ?>">
                        </div>
                        <br>
                        <div class="col-md-6">
                            <label>Last Name</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name" value="<?php echo $row1['lname']; ?>">
                        </div>
                        <br>
                        <div class="col-md-6">
                            <label>Email</label>
                        </div>
                        <div class="col-md-6">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo $row1['email']; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="col-md-2">
                <input type="submit" class="profile-edit-btn" name="submit" value="Update" />
            </div>
        </form>
    </div>

    <?php include 'include/body_footer.php'; ?>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $("#form").validate({
                rules: {
                    username: "required",
                    fname: "required",
                    lname: "required",
                    email: "required",
                    password: "required"
                },
            });
        });
    </script>
</body>

</html>