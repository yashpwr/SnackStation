<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon.ico">
  <title>SnacksStation | Login</title>
  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="#">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="#">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="#">
  <link rel="apple-touch-icon-precomposed" href="#">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon.ico">
  <!-- Bootstrap -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom Stylesheet -->
  <link href="assets/css/style.css" rel="stylesheet">
  <!-- Custom Responsive -->
  <link href="assets/css/responsive.css" rel="stylesheet">
</head>
<body>
  <div class="inner-wrapper">
    <div class="container-fluid no-padding">
      <div class="row no-gutters overflow-auto">
        <div class="col-md-6">
          <div class="main-banner">
            <img src="assets/img/banner/banner-1.jpg" class="img-fluid full-width main-img" alt="banner">
          </div>
        </div>
        <div class="col-md-6">
          <div class="section-2 user-page main-padding">
            <div class="login-sec">
              <div class="login-box">
                <form id="register" name="register" method="post">
                <?php include 'errors.php';?> 
                  <h4 class="text-light-black fw-600">Sign in with your SnacksStation account</h4>
                  <div class="row">
                    <div class="col-12">
                     
                      <div class="form-group">
                        <label class="text-light-white fs-14">Email</label>
                        <input type="email" class="form-control form-control-submit" autocomplete="off" name="email" id="email" placeholder="Email I'd" required>
                      </div>
                      <div class="form-group">
                        <label class="text-light-white fs-14">Password</label>
                        <input type="password" id="password-field" name="password" autocomplete="off" id="password" class="form-control form-control-submit"  placeholder="Password" required>
                        <div data-name="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></div>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn-second btn-submit full-width" name="login_user">Sign in</button>
                      </div>
                      <div class="form-group text-center mb-0"> <a href="forget-password.php">Lost your passwor? forget password</a>
                      <div class="form-group text-center"> <span>or</span>
                      </div>
                  
                      <div class="form-group text-center mb-0"> <a href="register.php">Create your account</a>
                      </div>
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
</body>
</html>
