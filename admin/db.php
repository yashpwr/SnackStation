<?php
session_start();

$username = "";
$email    = "";
$errors = array(); 
$id = "";

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'snackstation');

//create users table
$sql = "CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `trn_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
mysqli_query($db, $sql);

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password1 = mysqli_real_escape_string($db, $_POST['password1']);
  $password2 = mysqli_real_escape_string($db, $_POST['password2']);
  $trn_date = date("Y-m-d H:i:s");

  if (empty($username)) { array_push($errors, "username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password1)) { array_push($errors, "Password is required"); }
  if ($password1 != $password1) {
	array_push($errors, "Password do not match");
  }

  $user_check_query = "SELECT * FROM admin WHERE username='$username' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  // if user exists
  if ($user) { 
    if ($user['username'] === $username) {
      array_push($errors, "username already exists");
    }
    if ($user['email'] === $email) {
        array_push($errors, "email already exists");
      }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    //encrypt the password before saving in the database
  	$password = md5($password1);
  	$query = "INSERT INTO admin (username, email, password, trn_date) 
  			  VALUES('$username', '$email', '$password', '$trn_date')";
  	mysqli_query($db, $query);
    $_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: login.php');
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }
  if (count($errors) == 0) {
    $password = md5($password);
  	$query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      
      $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Wrong Username/Password Combination");
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

    $query = "SELECT * FROM admin WHERE email='$email'";
    $results = mysqli_query($db, $query);

    if (mysqli_num_rows($results) == 1) {
      $password = md5($password);
      $update = "UPDATE admin SET password = '$password' WHERE email='$email'";
      $result = mysqli_query($db, $update);
      header('location: login.php');
    } else {
      array_push($errors, "please enter valid email.");
    }
  }
}

?>