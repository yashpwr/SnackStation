<?php
session_start();

$username = "";
$email    = "";
$errors = array(); 
$id = "";

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'snackstation');

//create users table
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
// REGISTER USER
if (isset($_POST['reg_user']) && isset($_FILES['v_profile'])) {
  $v_profile_name = $_FILES["v_profile"]["name"];
  // receive all input values from the form
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

  $user_check_query = "SELECT * FROM vendor WHERE email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  // if user exists
  if ($user) { 
    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
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
                //$statusMsg = "The file " . $v_profile_name . " has been uploaded successfully.";
                header('location: login.php');
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
  


// LOGIN USER
if (isset($_POST['login_user'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($email)) {
  	array_push($errors, "email is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }
  if (count($errors) == 0) {
    $password = md5($password);
  	$query = "SELECT * FROM vendor WHERE email='$email' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['email'] = $email;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Wrong email/Password Combination");
  	}
  }
}

// Forget-password USER
if (isset($_POST['forget_pass'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($email)) {
    array_push($errors, "Email is required");
  }
  if (count($errors) == 0) {

    $query = "SELECT * FROM vendor WHERE email='$email'";
    $results = mysqli_query($db, $query);

    if (mysqli_num_rows($results) == 1) {
      $password = md5($password);
      $update = "UPDATE vendor SET password = '$password' WHERE email='$email'";
      $result = mysqli_query($db, $update);
      header('location: login.php');
    } else {
      array_push($errors, "please enter valid email.");
    }
  }
}

?>