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
    `img` varchar(100) NOT NULL,
    `title` varchar(100) NOT NULL,
    `description` varchar(100) NOT NULL,
    `trn_date` datetime NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
mysqli_query($db, $sql);

$targetDir = $_SERVER["DOCUMENT_ROOT"] . "/SnacksStation/uploads/slider-img/";

if (isset($_POST['submit']) && isset($_FILES['img'])) {
    $img = $_FILES["img"]["name"];
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $trn_date = date("Y-m-d H:i:s");

    if ($_FILES["img"]["name"] != "") {
        $targetFilePath = $targetDir . $img;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $targetFilePath)) {
                // Insert image file name into database
                $queryi = "UPDATE slider SET img = '$img', title = '$title', description = '$description' WHERE id = '$id';";
                $result = mysqli_query($db, $queryi);
                if($result){
                    header('location: slider_list.php');
                }
            }
        }
    } else {
        $query = "UPDATE slider SET title = '$title', description = '$description' WHERE id = '$id';";
        $result2 = mysqli_query($db, $query);
        if($result){
            header('location: slider_list.php');
        }
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
                    $sel_query = "SELECT * FROM slider WHERE id='$id'";
                    $result = mysqli_query($db, $sel_query);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <div class="col-md-12">
                        <div class="ms-panel">
                            <div class="ms-panel-body">
                                <div id="arrowSlider" class="ms-arrow-slider carousel slide" data-ride="carousel" data-interval="false">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block w-100" src="/SnacksStation/uploads/slider-img/<?php echo $row['img']; ?>" style="height: 300px; width: 1040px;">
                                            <div class="carousel-caption d-none d-md-block">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ms-panel">
                        <div class="ms-panel-header">
                            <h6>Update Slider</h6>
                        </div>
                        <div class="ms-panel-body">
                            <form class="needs-validation" novalidate method="post" enctype="multipart/form-data">
                                <?php include 'errors.php'; ?>

                                <div class="form-row">
                                    <div class="col-md-10 mb-3">
                                        <label for="validationCustom01">Change Slider picture</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="img" id="validatedCustomFile">
                                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                        </div>
                                    </div>
                                    <div class="col-md-10 mb-3">
                                        <label for="validationCustom02">Slider Title</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="validationCustom02" value="<?php echo $row['title']; ?>" name="title" placeholder="Slider Title" required>
                                        </div>
                                    </div>
                                    <div class="col-md-10 mb-3">
                                        <label for="validationCustom02">Slider Description</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="validationCustom02" value="<?php echo $row['description']; ?>" name="description" placeholder="Slider Description" required>
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