<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <?php include('include/title.php');
    include('include/cssLinks.php');
    include('include/conn.php');
  ?>
  
   
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php include('include/header.php'); ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">      
      
      <?php include('include/sidebar.php'); ?>
      
      <!-- partial -->
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">NOC अर्ज सादर करण्याचा फॉर्म</h4>
                  <!-- <p class="card-description">
                    Basic form layout
                  </p> -->
                  <form class="forms-sample row" method="post" action="nocApplicationDB.php">
                    <input type="hidden" name="applicationType" value="Civillian">
                    <div class="form-group col-md-6">
                      <label for="exampleInputUsername1">NOC क्रमांक</label>
                      <input type="text" class="form-control" name="nocNumber" id="exampleInputUsername1" placeholder="NOC क्रमांक">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">NOC प्रकार निवडा</label>
                      <input type="text" class="form-control" name="nocType" id="exampleInputEmail1" placeholder="NOC प्रकार निवडा">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputPassword1">जन्मतारीख</label>
                      <input type="date" class="form-control" name="dob" id="exampleInputPassword1" placeholder="जन्मतारीख">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputPassword1">पूर्ण नाव</label>
                      <input type="text" class="form-control" name="fullName" id="exampleInputPassword1" placeholder="पूर्ण नाव">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputConfirmPassword1">आधार क्रमांक</label>
                      <input  type="text" class="form-control" name="aadharNo" id="exampleInputConfirmPassword1"  placeholder="आधार क्रमांक"  maxlength="12"  minlength="12"  pattern="\d{12}"  oninput="this.value = this.value.replace(/[^0-9]/g, '')"  required>

                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputConfirmPassword1">पत्ता</label>
                      <input  type="text" class="form-control" name="address" id="exampleInputConfirmPassword1"  placeholder="पत्ता"  required>

                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputConfirmPassword1">इमेल ID</label>
                      <input  type="email" class="form-control" name="email" id="exampleInputConfirmPassword1"  placeholder="इमेल ID"  required>

                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputConfirmPassword1">मोबाईल क्र.</label>
                <input  type="text" class="form-control" name="mobileNo"  id="exampleInputConfirmPassword1"  placeholder="मोबाईल क्र."  maxlength="10"  minlength="10"  pattern="\d{10}"  oninput="this.value = this.value.replace(/[^0-9]/g, '')"  required>

                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputConfirmPassword1">जामिनीची तपशील</label>
                      <input  type="text" class="form-control" name="landDesc"  id="exampleInputConfirmPassword1"  placeholder="जामिनीची तपशील"  required>

                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputConfirmPassword1">विषय</label>
                      <input  type="text" class="form-control" name="nocSubject" id="exampleInputConfirmPassword1"  placeholder="विषय"  required>

                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputConfirmPassword1">पत्ता</label>
                    <select name="taluka" id="talukaSelect" class="form-control">
                        <option value="">तालुका निवडा</option>
                        <?php
                            $sql = "SELECT DISTINCT taluka FROM taluka";
                            $stmt = $conn->prepare($sql);

                            if ($stmt->execute()) {
                                $result = $stmt->get_result();

                                while ($row = $result->fetch_assoc()) {
                                    echo "<option>".$row['taluka']."</option>";
                                }
                            } else {
                                echo "Query execution failed: " ;
                            }

                            $stmt->close();
                            ?>
                    </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputConfirmPassword1">गाव</label>
                        <select id="villageSelect" name="village" class="form-control ">
                            <option value="">गाव निवडा</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputConfirmPassword1">गट क्रमांक</label>
                      <input  type="text" class="form-control" name="gatNo" id="exampleInputConfirmPassword1"  placeholder="गट क्रमांक"  required>

                    </div>

                    <div class="form-group col-md-6">
                      <label for="exampleInputConfirmPassword1">पेन कार्ड अपलोड करा</label>
                      <input  type="file" class="form-control"  id="penCard"  name="" placeholder="पत्ता"  required>

                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputConfirmPassword1">आधारकार्ड अपलोड करा</label>
                      <input  type="file" class="form-control"  id="aadharCard"  placeholder="पत्ता"  required>

                    </div>
                    <div class="form-group col-md-6">
                    

                    <div class="form-check form-check-flat form-check-primary">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input">
                        Remember me
                      </label>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php include('include/footer.php'); ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
 <?php include('include/jsLinks.php'); ?>
  <!-- End custom js for this page-->

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $('#talukaSelect').change(function () {
    var taluka = $(this).val();

    if (taluka !== "") {
      $.ajax({
        url: 'ajax/villagesAjax.php',
        type: 'POST',
        data: { taluka: taluka },
        success: function (response) {
          $('#villageSelect').html(response);
        }
      });
    } else {
      $('#villageSelect').html('<option value="">गाव निवडा</option>');
    }
  });
</script>

<script>
const allowedTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png'];
const maxSize = 2 * 1024 * 1024; // 2MB

document.getElementById('penCard').addEventListener('change', function () {
  validateFile(this, 'पेन कार्ड');
});

document.getElementById('aadharCard').addEventListener('change', function () {
  validateFile(this, 'आधारकार्ड');
});

function validateFile(input, label) {
  const file = input.files[0];
  if (file) {
    if (!allowedTypes.includes(file.type)) {
      alert(`${label} साठी फक्त PDF, JPG, JPEG आणि PNG फाईल्स परवान्याच आहेत.`);
      input.value = ''; // Clear the input
      return;
    }

    if (file.size > maxSize) {
      alert(`${label} फाईलचा साइज 2 MB पेक्षा कमी असावा.`);
      input.value = ''; // Clear the input
      return;
    }
  }
}
</script>


</body>
</html>
