<?php
include 'db.php';
if (!isset($_SESSION['username'])) {
    header('location: login.php');
    exit;
}
$id = $_REQUEST['id'];
?>
<?php
$sql = "CREATE TABLE `vendor` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `v_profile` varchar(100) NOT NULL,
    `fname` varchar(100) NOT NULL,
    `lname` varchar(100) NOT NULL,
    `r_id` varchar(100) NOT NULL,
    `r_name` varchar(100) NOT NULL,
    `r_location` varchar(100) NOT NULL,
    `email` varchar(100) NOT NULL,
    `password` varchar(100) NOT NULL,
    `trn_date` datetime NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
mysqli_query($db, $sql);

$targetDir = $_SERVER["DOCUMENT_ROOT"] . "/SnacksStation/uploads/vendor-profile-img/";

if (isset($_POST['submit']) && isset($_FILES['v_profile'])) {
    $v_profile_name = $_FILES["v_profile"]["name"];
    $fname = mysqli_real_escape_string($db, $_POST['fname']);
    $lname = mysqli_real_escape_string($db, $_POST['lname']);
    $r_id = uniqid();
    $r_name = mysqli_real_escape_string($db, $_POST['r_name']);
    $r_location = mysqli_real_escape_string($db, $_POST['r_location']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $trn_date = date("Y-m-d H:i:s");

    if ($_FILES["v_profile"]["name"] != "") {
        $targetFilePath = $targetDir . $v_profile_name;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($_FILES["v_profile"]["tmp_name"], $targetFilePath)) {
                $password = md5($password1);
                // Insert image file name into database
                $queryi = "UPDATE vendor SET v_profile = '$v_profile_name', fname = '$fname', lname = '$lname', r_id = '$r_id',
                 r_name = '$r_name', r_location = '$r_location', email ='$email' WHERE id = '$id';";
                $result = mysqli_query($db, $queryi);
            }
        }
    } else {
        $query = "UPDATE vendor SET fname = '$fname', lname = '$lname', r_id = '$r_id', r_name = '$r_name', r_location = '$r_location',
         email ='$email' WHERE id = '$id';";
        $result2 = mysqli_query($db, $query);
    }
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
    <link rel="stylesheet" href="../../vendors/iconic-fonts/flat-icons/flaticon.css">
    <link href="vendors/iconic-fonts/font-awesome/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery UI -->
    <link href="assets/css/jquery-ui.min.css" rel="stylesheet">
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
                            <li class="breadcrumb-item"><a href="#"><i class="material-icons">home</i> Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Update Vendor</li>
                        </ol>
                    </nav>

                    <?php

                    $id = $_REQUEST['id'];
                    $sel_query = "SELECT * FROM vendor WHERE id='$id'";
                    $result = mysqli_query($db, $sel_query);
                    $row = mysqli_fetch_assoc($result);

                    ?>
                    <div class="col-md-12">
                        <div class="ms-panel">
                            <div class="ms-panel-body">
                                <div id="arrowSlider" class="ms-arrow-slider carousel slide" data-ride="carousel" data-interval="false">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block w-100" src="/SnacksStation/uploads/vendor-profile-img/<?php echo $row['v_profile']; ?>" style="height: 300px; width: 1040px;">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h3 class="text-white"><?php echo $row['r_name']; ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ms-panel">
                        <div class="ms-panel-header">
                            <h6>Update vendor</h6>
                        </div>
                        <div class="ms-panel-body">
                            <form class="needs-validation" novalidate method="post" enctype="multipart/form-data">
                                <?php include 'errors.php'; ?>

                                <div class="form-row">
                                    <div class="col-md-10 mb-3">
                                        <label for="validationCustom01">Change profile picture</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="v_profile" id="validatedCustomFile">
                                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                        </div>
                                    </div>
                                    <div class="col-md-10 mb-3">
                                        <label for="validationCustom01">First name</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="validationCustom01" value="<?php echo $row['fname']; ?>" name="fname" placeholder="First name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-10 mb-3">
                                        <label for="validationCustom02">Last name</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="validationCustom02" value="<?php echo $row['lname']; ?>" name="lname" placeholder="Last name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-10 mb-3">
                                        <label for="validationCustom01">Restaurant name</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="validationCustom01" value="<?php echo $row['r_name']; ?>" name="r_name" placeholder="Restaurant name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-10 mb-3">
                                        <label for="validationCustom01">Email</label>
                                        <div class="input-group">
                                            <input type="email" class="form-control" name="email" id="validationCustom01" value="<?php echo $row['email']; ?>" placeholder="Email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-10 mb-3">
                                        <label for="validationCustom01">Location</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="r_location" id="validationCustom01" value="<?php echo $row['r_location']; ?>" placeholder="Location" required>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit" name="submit">Add Vendor</button>
                            </form>
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
    <script src="assets/js/perfect-scrollbar.js">
    </script>
    <script src="assets/js/jquery-ui.min.js">
    </script>
    <!-- Global Required Scripts End -->
    <!-- Costic core JavaScript -->
    <script src="assets/js/framework.js"></script>
    <!-- Settings -->
    <script src="assets/js/settings.js"></script>
</body>

</html>