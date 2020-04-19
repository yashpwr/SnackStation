<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>SnacksStation | Admin Register</title>
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

<body class="ms-body ms-primary-theme ms-logged-out">
  <!-- Main Content -->
  <main class="body-content">
    <!-- Body Content Wrapper -->
    <div class="ms-content-wrapper ms-auth">
      <div class="ms-auth-container">
      
        <div class="ms-auth-col">
          <div class="ms-auth-form">
            <form class="needs-validation" novalidate="" method="post">
              <?php include 'errors.php'; ?>
              <h3>Create Admin Account</h3>
              <p>Please enter personal information to continue</p>
            
              <div class="form-row">
                <div class="col-md-12 ">
                  <label for="validationCustom03">Username</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="validationCustom03" name="username" placeholder="Username" required="">
                    <div class="invalid-feedback">
                      Please Enter Username.
                    </div>
                  </div>
                </div>
                <div class="col-md-12 ">
                  <label for="validationCustom03">Email Address</label>
                  <div class="input-group">
                    <input type="email" class="form-control" id="validationCustom03" name="email" placeholder="Email Address" required="">
                    <div class="invalid-feedback">
                      Please Enter Email.
                    </div>
                  </div>
                </div>
             
                <div class="col-md-12 ">
                  <label for="validationCustom04">Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control" id="validationCustom04" name="password1" placeholder="Password" required="">
                    <div class="invalid-feedback">
                      Please Enter password.
                    </div>
                  </div>
                </div>
                <div class="col-md-12 ">
                  <label for="validationCustom04">Retype Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control" id="validationCustom04" name="password2" placeholder="Retype Password" required="">
                    <div class="invalid-feedback">
                      Please Retype Password.
                    </div>
                  </div>
                </div>
              </div>

              <button class="btn btn-primary mt-4 d-block w-100" type="submit" name="reg_user">Create Account</button>
              <p class="mb-0 mt-3 text-center">Already have an account? <a class="btn-link" href="login.php">Login</a> </p>
            </form>
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