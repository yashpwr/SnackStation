<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon.ico">
  <title>SnacksStation | Admin Login</title>
  <!-- Iconic Fonts -->
  <link rel="stylesheet" href="vendors/iconic-fonts/flat-icons/flaticon.css">
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

<body>
  <div class="inner-wrapper">
    <div class="container-fluid no-padding">
      <div class="row no-gutters overflow-auto">
        <div class="col-md-6">
          <div class="main-banner">
            <img src="assets/img/banner/banner-1.jpg" class="img-fluid full-width main-img" alt="banner">
            <div class="overlay-2 main-padding">
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="section-2 user-page main-padding">
            <div class="login-sec">
              <div class="login-box">

                <form id="register" name="register" method="post">

                  <h4 class="text-light-black fw-600">Create your account</h4>
                  <?php include 'errors.php';?> 
                  <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-6">
                      <div class="form-group">
                        <label class="text-light-white fs-14">First name</label>
                        <input type="text" name="fname" class="form-control form-control-submit" placeholder="First Name" required>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-6">
                      <div class="form-group">
                        <label class="text-light-white fs-14">Last name</label>
                        <input type="text" name="lname" class="form-control form-control-submit" placeholder="Last Name" required>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <label class="text-light-white fs-14">Email</label>
                        <input type="email" name="email" class="form-control form-control-submit" placeholder="Email I'd" required>
                      </div>
                      <div class="form-group">
                        <label class="text-light-white fs-14">Password</label>
                        <input type="password" id="password-field" name="password1" class="form-control form-control-submit" placeholder="Password" required>
                        <div data-name="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></div>
                      </div>

                      <div class="form-group">
                        <label class="text-light-white fs-14">Repeat Password</label>
                        <input type="password" id="password-field2" name="password2" class="form-control form-control-submit" placeholder="Repeat Password" required>
                        <div data-name="#password-field2" class="fa fa-fw fa-eye field-icon toggle-password"></div>
                      </div>

                      <div class="form-group">
                        <button type="submit" class="btn-second btn-submit full-width" name="reg_user">Create your account</button>
                      </div>
                      <div class="form-group text-center"> <span>or</span>
                      </div>

                      <div class="form-group text-center">
                        <p class="text-light-black mb-0">Have an account? <a href="login.php">Sign in</a>
                        </p>
                      </div> <span class="text-light-black fs-12 terms">By creating your SnacksStation account, you agree to the <a href="#"> Terms of Use </a> and <a href="#"> Privacy Policy.</a></span>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Place all Scripts Here -->
  <!-- jQuery -->
  <script src="assets/js/jquery.min.js"></script>
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
  <!-- Munch Box Js -->
  <script src="assets/js/munchbox.js"></script>
  <!-- /Place all Scripts Here -->
</html>