<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  
  <?php
  include('include/conn.php');
  include('include/title.php');
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
         

          <!-- Login Form -->
         <div class="col-md-12 col-sm-12 p-4">
  <h3 class="mb-4 text-center">युजर नोंदणी</h3>
  <form action="registration_DB.php" method="POST">
    <div class="row">
      <!-- Full Name -->
      <div class="col-md-4 mb-3">
        <label for="fullname" class="form-label">पूर्ण नाव</label>
        <input type="text" name="fullname" id="fullname" class="form-control" required>
      </div>

      <!-- Address -->
      <div class="col-md-4 mb-3">
        <label for="address" class="form-label">पत्ता</label>
        <input type="text" name="address" id="address" class="form-control" required>
      </div>

      <!-- Taluka Dropdown -->
      <div class="col-md-4 mb-3">
        <label for="taluka" class="form-label">तालुका निवडा</label>
        <select name="taluka" id="taluka" class="form-control" required>
          <option value="">-- तालुका निवडा --</option>
       <?php 
       $query = mysqli_query($conn, " SELECT DISTINCT taluka FROM taluka ORDER BY taluka  ASC");
       while($row = mysqli_fetch_assoc($query)){
        echo '<option value="' . htmlspecialchars($row['taluka']) . '">' . htmlspecialchars($row['taluka']) . '</option>';
       }
       ?>
          <!-- Add more as needed -->
        </select>
      </div>

      <!-- Village Dropdown -->
      <div class="col-md-4 mb-3">
        <label for="village" class="form-label">गाव</label>
        <select name="village" id="village" class="form-control" required>
          <option value="">-- गाव निवडा --</option>
          
        </select>
      </div>

      <!-- Aadhaar Number -->
     <div class="col-md-4 mb-3">
  <label for="aadhaar" class="form-label">आधार क्रमांक</label>
  <input type="text" name="aadhaarNumber" id="aadhaar" class="form-control" maxlength="12" pattern="\d{12}" title="12 digit Aadhaar number" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
</div>

      <!-- Email -->
      <div class="col-md-4 mb-3">
        <label for="email" class="form-label">ईमेल</label>
        <input type="email" name="email" id="email" class="form-control" required>
      </div>
  

    <!-- <div class="col-md-4 mb-3">
  <label for="id_proof" class="form-label">ओळखपत्र अपलोड करा</label>
  <input type="file" name="id_proof" id="id_proof" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
</div> -->

<div class="col-md-4 mb-3">
        <label for="mobileNumber" class="form-label">मोबाईल क्रमांक</label>
        <input type="text" name="mobileNumber" id="mobileNumber" class="form-control" maxlength="10" pattern="\d{10}" title="Mobile Number" required>
      </div>

      <div class="col-md-2 mb-3">
           <button type="button"  id="sendOtpBtn"  class="btn btn-primary w-100 mt-4">OTP पटवा</button>
      </div>

      <div class="col-md-4 mb-3">
        <label for="otpnumber" class="form-label">OTP टाका</label>
        <input type="text" name="otpnumber" id="otpnumber" class="form-control" title="otpnumber">
      </div>

      <div class="col-md-2 mb-3">
           <button type="button" id="verifyOTP" class="btn btn-primary w-100 mt-4">Verify</button>
      </div>

      <!-- Password -->
<div class="col-md- 4 mb-3">
  <label for="password" class="form-label">पासवर्ड</label>
  <input type="password" name="password" id="password" class="form-control"  required>
</div>

<!-- Confirm Password -->
<div class="col-md-4 mb-3">
  <label for="confirm_password" class="form-label">पासवर्ड पुन्हा लिहा</label>
  <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
</div>

    </div>
    <button type="submit" name="submit" class="btn btn-primary w-100 mt-3">नोंदणी करा</button>
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
  
   <!-- Make sure SweetAlert2 is included -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<sceipt>
  <script>
  document.getElementById('sendOtpBtn').addEventListener('click', function () {
    Swal.fire({
      icon: 'success',
      title: 'OTP पाठवण्यात आला आहे',
      text: 'कृपया तुमचा OTP तपासा!',
      confirmButtonText: 'ठीक आहे'
    });
  });
</script>
<sceipt>
  <script>
  document.getElementById('verifyOTP').addEventListener('click', function () {
    var otp = document.getElementById('otpnumber').value;
    if(otp=="123456"){
    Swal.fire({
      icon: 'success',
      title: 'OTP Verified Successfully',
      // text: 'कृपया तुमचा OTP तपासा!',
      confirmButtonText: 'ठीक आहे'
    });
  }else{
    Swal.fire({
      icon: 'error',
      title: 'OTP is invalid',
      text: 'Please Check carefully otp',
      confirmButtonText: 'ठीक आहे'
    });
  }
  });
  
</script>

</sceipt>
<script>
  document.querySelector('form').addEventListener('submit', function(e) {
    const pwd = document.getElementById('password').value;
    const cpwd = document.getElementById('confirm_password').value;

    if (pwd !== cpwd) {
      e.preventDefault(); // prevent form submission

      Swal.fire({
        icon: 'error',
        title: 'पासवर्ड जुळत नाहीत',
        text: 'कृपया तपासा.',
        confirmButtonText: 'ठीक आहे'
      });
    }
  });
</script>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $('#taluka').on('change', function () {
    var selectedTaluka = $(this).val();
    if (selectedTaluka !== "") {
      $.ajax({
        url: 'fetch_villages.php',
        method: 'POST',
        data: { taluka: selectedTaluka },
        success: function (data) {
          $('#village').html(data);
        }
      });
    } else {
      $('#village').html('<option value="">-- गाव निवडा --</option>');
    }
  });
</script>

</body>
</html>
