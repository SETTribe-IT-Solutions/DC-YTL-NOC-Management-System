<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <?php include('include/title.php');
    include('include/cssLinks.php');
  ?>
  <style>
  @media (max-width: 768px) {
    .rounded-start {
      border-radius: 0 !important;
    }
  }
  @media (max-width: 767px) {
    .content-wrapper {
        margin-top: 30%;
        padding: 1.5rem 1.5rem;
    }
}
</style>

  <!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php include('include/header2.php'); ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">      
      
      <!-- partial -->
   <!-- Centering Wrapper -->
<div class="content-wrapper d-flex justify-content-center " style="background-color: #f5f5f5;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10 col-md-12 col-sm-12 shadow p-4 bg-white rounded">
        <div class="row">
          <!-- Login Image -->
          <div class="col-md-6 d-none d-md-block">
            <img src="img/login2.svg" alt="Login" class="img-fluid rounded-start w-100" style="height:100%;">
          </div>

          <!-- Login Form -->
          <div class="col-md-6 col-sm-12 p-4 card">
            <h3 class="mb-4 text-center">Login Form</h3>
            <form action="login_DB.php" method="POST">
              <div class="mb-3">
                <!-- <label for="username" class="form-label">Mobile Number</label> -->
                <input type="text" name="mobileNumber" id="username" class="form-control" maxlength="10" required placeholder="Mobile Number">
              </div>

              <div class="mb-3">
                <!-- <label for="password" class="form-label">Password</label> -->
                <input type="password" name="password" id="password" class="form-control" required placeholder="Password">
              </div>
              <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
  <p class="mt-3 text-center">
                <a href="registration.php">User register</a>
              </p>
              <!-- <p class="mt-3 text-center">
                <a href="forgot_password.php">Forgot password?</a>
              </p> -->
               
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    </div>
  </div>
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
   <?php include('include/footer.php'); ?>
 <?php include('include/jsLinks.php'); ?>
  <!-- End custom js for this page-->
</body>
</html>
