<?php
include 'db.php';
if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit;
}
$uploaded_by = $_SESSION['email'];
$sql = "SELECT * FROM vendor WHERE email = '$uploaded_by'";
$findvendor = mysqli_query($db, $sql);
$row = $findvendor->fetch_assoc();
$id = $row['id'];
?>
<?php
$sql = "CREATE TABLE `snacks` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `img` varchar(100) NOT NULL,
    `name` varchar(100) NOT NULL,
    `category` varchar(100) NOT NULL,
    `quantity` varchar(100) NOT NULL,
    `price` int(11) NOT NULL,
    `description` varchar(200) NOT NULL,
    `status` ENUM ('in Stock', 'out of Stock') NOT NULL,
    `uploaded_by` varchar(100) NOT NULL,
    `trn_date` datetime NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
mysqli_query($db, $sql);

$targetDir = $_SERVER["DOCUMENT_ROOT"] . "/SnacksStation/uploads/admin-snacks-img/";

if (isset($_POST['submit']) && isset($_FILES['img'])) {
    $img = $_FILES["img"]["name"];
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $category = mysqli_real_escape_string($db, $_POST['category']);
    $quantity = mysqli_real_escape_string($db, $_POST['quantity']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $status = mysqli_real_escape_string($db, $_POST['status']);
    $trn_date = date("Y-m-d H:i:s");

    $targetFilePath = $targetDir . $img;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg');
    if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $targetFilePath)) {
            // Insert image file name into database
            $queryi = "INSERT into snacks (img, name, category, quantity, price, description, status, uploaded_by, trn_date)
               VALUES ('$img','$name','$category','$quantity','$price','$description', '$status', '$id', '$trn_date');";
            $result = mysqli_query($db, $queryi);
            if ($result) {
                $statusMsg = "The file " . $img . " has been uploaded successfully.";
            } else {
                $statusMsg = "File upload failed, please try again.";
            }
        } else {
            $statusMsg = "Sorry, there was an error uploading your file.";
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
                            <li class="breadcrumb-item"><a href="#"><i class="material-icons">home</i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Snacks</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-xl-12 col-md-12">
                    <div class="ms-panel ms-panel-fh">
                        <div class="ms-panel-header">
                            <h6>Add Product Form</h6>
                        </div>
                        <div class="ms-panel-body">
                            <form class="needs-validation clearfix" method="post" novalidate enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom18">Product Name</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="validationCustom18" placeholder="Product Name" name="name" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom22">Select Catagory</label>
                                        <div class="input-group">
                                            <select class="form-control" id="validationCustom22" name="category" required>
                                                <option value="">Select Catagory</option>
                                                <?php
                                                $sql = "SELECT * FROM snacks_category WHERE added_by = '$uploaded_by'";
                                                $result = mysqli_query($db, $sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo "<option value='" . $row['category'] . "'>" . $row['category'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom24">Quantity</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="validationCustom24" name="quantity" placeholder="01" required>
                                            <div class="invalid-feedback">
                                                Quantity
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom25">Price</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="validationCustom25" name="price" placeholder="₹ 10" required>
                                            <div class="invalid-feedback">
                                                Price
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom12">Description</label>
                                        <div class="input-group">
                                            <textarea rows="5" id="validationCustom12" class="form-control" placeholder="Message" name="description" required></textarea>
                                            <div class="invalid-feedback">
                                                Please provide a message.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-5">
                                        <label for="validationCustom12">Product Image</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="img" id="validatedCustomFile">
                                            <label class="custom-file-label" for="validatedCustomFile">Upload Images...</label>
                                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom22">Status</label>
                                        <div class="input-group">
                                            <select class="form-control" id="validationCustom22" name="status" required>
                                                <option value="in Stock">In Stock</option>
                                                <option value="out of Stock">Out of Stock</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="new">
                                        <button class="btn btn-primary d-block" type="submit" name="submit">Add Snacks</button>
                                    </div>
                                </div>
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