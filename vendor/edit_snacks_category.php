<?php
include 'db.php';
if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit;
}
?>
<?php

if (isset($_POST['submit'])) {
    $category = mysqli_real_escape_string($db, $_POST['category']);
    $trn_date = date("Y-m-d H:i:s");
    $id = $_REQUEST['id'];
    $query = "UPDATE snacks_category SET category = '$category' WHERE id = '$id';";
   $result2 = mysqli_query($db, $query);
   header('location: category_list.php');
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
                            <li class="breadcrumb-item active" aria-current="page">Add Snacks Category</li>
                        </ol>
                    </nav>
                </div>
                <?php
                $id = $_REQUEST['id'];
                $sel_query = "SELECT * FROM snacks_category WHERE id='$id'";
                $result = mysqli_query($db, $sel_query);
                $row = mysqli_fetch_assoc($result);
                ?>
                <div class="col-xl-12 col-md-12">
                    <div class="ms-panel ms-panel-fh">
                        <div class="ms-panel-header">
                            <h6>Add Snacks Categroy</h6>
                        </div>
                        <div class="ms-panel-body">
                            <form class="needs-validation clearfix" method="post" novalidate>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom18">Category Name</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="validationCustom18" value="<?php echo $row['category']; ?>" name="category" placeholder="Category Name" required>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary new" type="submit" name="submit"> Add Category</button>
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