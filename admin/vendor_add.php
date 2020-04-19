<?php
include 'db.php';
if (!isset($_SESSION['username'])) {
    header('location: login.php');
    exit;
}
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
    $password1 = mysqli_real_escape_string($db, $_POST['password1']);
    $password2 = mysqli_real_escape_string($db, $_POST['password2']);
    $trn_date = date("Y-m-d H:i:s");

    if (empty($fname)) { array_push($errors, "fname is required"); }
    if (empty($lname)) { array_push($errors, "lname is required"); }
    if (empty($r_name)) { array_push($errors, "Restaurant name is required"); }
    if (empty($r_location)) { array_push($errors, "Restaurant Address is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password1)) { array_push($errors, "Password is required"); }
    if ($password1 != $password1) {
      array_push($errors, "Password do not match");
    }
    if (count($errors) == 0) {
    $targetFilePath = $targetDir . $v_profile_name;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg');
    if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($_FILES["v_profile"]["tmp_name"], $targetFilePath)) {
            $password = md5($password1);
            // Insert image file name into database
            $queryi = "INSERT into vendor (v_profile, fname, lname, r_id, r_name, r_location, email, password, trn_date)
               VALUES ('$v_profile_name','$fname','$lname','$r_id','$r_name','$r_location', '$email', '$password', '$trn_date');";
            $result = mysqli_query($db, $queryi);
            if ($result) {
                $statusMsg = "The file " . $v_profile_name . " has been uploaded successfully.";
            } else {
                $statusMsg = "File upload failed, please try again.";
            }
        } else {
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }
    } else {
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, files are allowed to upload.';
    }
} else {
    $statusMsg = 'Please select a file to upload.';
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
                            <li class="breadcrumb-item active" aria-current="page">Add Vendor</li>
                        </ol>
                    </nav>

                    <div class="ms-panel">
                        <div class="ms-panel-header">
                            <h6>Add vendor</h6>
                        </div>
                        <div class="ms-panel-body">
                            <form class="needs-validation" novalidate method="post" enctype="multipart/form-data">
                            <?php include 'errors.php';?>
                                <div class="form-row">
                                    <div class="col-md-10 mb-3">
                                        <label for="validationCustom01">First name</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="validationCustom01" name="fname" placeholder="First name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-10 mb-3">
                                        <label for="validationCustom02">Last name</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="validationCustom02" name="lname" placeholder="Last name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-10 mb-3">
                                        <label for="validationCustom01">Restaurant name</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="validationCustom01" name="r_name" placeholder="Restaurant name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-10 mb-3">
                                        <label for="validationCustom01">Email</label>
                                        <div class="input-group">
                                            <input type="email" class="form-control" name="email" id="validationCustom01" placeholder="Email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-10 mb-3">
                                        <label for="validationCustom01">Location</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="r_location" id="validationCustom01" placeholder="Location" required>
                                        </div>
                                    </div>

                                    <div class="col-md-10 mb-3">
                                        <label for="validationCustom01">Upload profile picture</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="v_profile" id="validatedCustomFile" required>
                                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                            <p class="error" style="color: red;"><?php echo $statusMsg; ?></p> <br>
                                        </div>
                                    </div>

                                    <div class="col-md-10 mb-3">
                                        <label for="validationCustom01">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password1" id="validationCustom01" placeholder="Password" required>
                                        </div>
                                    </div>

                                    <div class="col-md-10 mb-3">
                                        <label for="validationCustom01">Retype Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password2" id="validationCustom01" placeholder="Retype Password" required>
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