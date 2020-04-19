<?php
session_start();

$username = "";
$email    = "";
$errors = array();
$id = "";

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'snackstation');

//create users table
$sql = "CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `img` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `trn_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
mysqli_query($db, $sql);
$sql2 = "CREATE TABLE `snacks` (
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
  mysqli_query($db, $sql2);
// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $fname = mysqli_real_escape_string($db, $_POST['fname']);
  $lname = mysqli_real_escape_string($db, $_POST['lname']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password1 = mysqli_real_escape_string($db, $_POST['password1']);
  $password2 = mysqli_real_escape_string($db, $_POST['password2']);
  $trn_date = date("Y-m-d H:i:s");

  if (empty($fname)) {
    array_push($errors, "First-Name is required");
  }
  if (empty($lname)) {
    array_push($errors, "Last-Name is required");
  }
  if (empty($email)) {
    array_push($errors, "Email is required");
  }
  if (empty($password1)) {
    array_push($errors, "Password is required");
  }
  if ($password1 != $password1) {
    array_push($errors, "Password do not match");
  }

  $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  // if user exists
  if ($user) {
    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    //encrypt the password before saving in the database
    $password = md5($password1);
    $query = "INSERT INTO users (fname, lname, email, password, trn_date) 
  			  VALUES('$fname','$lname', '$email', '$password', '$trn_date')";
    mysqli_query($db, $query);
    $_SESSION['email'] = $email;
    $_SESSION['success'] = "You are now logged in";
    header('location: login.php');
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($email)) {
    array_push($errors, "Email is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }
  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {

      $_SESSION['email'] = $email;
      $_SESSION['success'] = "You are now logged in";
      header('location: index.php');
    } else {
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

    $query = "SELECT * FROM users WHERE email='$email'";
    $results = mysqli_query($db, $query);

    if (mysqli_num_rows($results) == 1) {
      $password = md5($password);
      $update = "UPDATE users SET password = '$password' WHERE email='$email'";
      $result = mysqli_query($db, $update);
      header('location: login.php');
    } else {
      array_push($errors, "please enter valid email.");
    }
  }
}
