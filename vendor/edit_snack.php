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
$ID = $_REQUEST['id'];
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

    if ($_FILES["img"]["name"] != "") {
        $targetFilePath = $targetDir . $img;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg');
    

        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $targetFilePath)) {
                // Insert image file name into database
                $queryi = "UPDATE snacks SET img = '$img', name = '$name', category = '$category', quantity = '$quantity'
                , price = '$price', description = '$description', status = '$status' WHERE id = '$ID';";
                $result = mysqli_query($db, $queryi);
                if($result){
                    header('location: snacks_list.php');
                }
            }
        }
    } else {
        $query = "UPDATE snacks SET name = '$name', category = '$category', quantity = '$quantity'
        , price = '$price', description = '$description', status = '$status' WHERE id = '$ID';";
        $result2 = mysqli_query($db, $query);
        if($result2){
            header('location: snacks_list.php');
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
                <?php
                $id = $_REQUEST['id'];
                $sel_query = "SELECT * FROM snacks WHERE id='$id'";
                $result = mysqli_query($db, $sel_query);
                $row2 = mysqli_fetch_assoc($result);
                ?>
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
                                            <input type="text" class="form-control" id="validationCustom18" value="<?php echo $row2['name']; ?>" placeholder="Product Name" name="name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom22">Select Catagory</label>
                                        <div class="input-group">
                                            <select class="form-control" id="validationCustom22" name="category" required>
                                                <option value="<?php echo $row2['category']; ?>"><?php echo $row2['category']; ?></option>
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
                                            <input type="text" class="form-control" id="validationCustom24" value="<?php echo $row2['quantity']; ?>" name="quantity" placeholder="01" required>
                                            <div class="invalid-feedback">
                                                Quantity
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom25">Price</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="validationCustom25" value="<?php echo $row2['price']; ?>" name="price" placeholder="$10" required>
                                            <div class="invalid-feedback">
                                                Price
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom12">Description</label>
                                        <div class="input-group">
                                            <textarea rows="5" id="validationCustom12" class="form-control" placeholder="Message" name="description" required><?php echo $row2['description']; ?> </textarea>
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
                                                
                                                <option <?php if($row2['status'] == "in Stock") echo "Selected"?> value="in Stock">In Stock</option>
                                                <option <?php if($row2['status'] == "out of Stock") echo "Selected"?> value="out of Stock">Out of Stock</option>
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
                <div class="col-xl-12 col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="ms-panel">
                                <div class="ms-panel-header">
                                    <h6>Snack Image </h6>
                                </div>
                                <div class="ms-panel-body">
                                    <div id="imagesSlider" class="ms-image-slider carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img class="d-block w-100" src="/SnacksStation/uploads/admin-snacks-img/<?php echo $row2['img']; ?>" style="height: 500px; width: 200px;" alt="Snacks img">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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