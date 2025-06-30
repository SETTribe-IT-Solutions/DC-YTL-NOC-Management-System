<!DOCTYPE html>
<html lang="en">

<head>
    <title>Registration | NOC Management System</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php include("include/cssLinks.php"); 
    
    include("include/conn.php");

    ?>
    
    <style>
        body {
            background-color: #ffffff;
        }
        .header-bar {
            background-color: #7e41c3;
            padding: 10px 20px;
            color: white;
        }
        .header-bar img {
            height: 60px;
        }
        .header-title {
            font-size: 22px;
            font-weight: bold;
        }
        .register-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            padding: 30px 10px;
        }
        .register-image {
            flex: 1;
            min-width: 300px;
            max-width: 600px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .register-image img {
            max-width: 100%;
            height: auto;
        }
        .register-form {
            flex: 1;
            min-width: 300px;
            max-width: 600px;
            padding: 30px;
            background: #ffffff;
            box-shadow: 0 0 15px rgba(0,0,0,0.08);
            border-radius: 10px;
        }
    </style>
</head>
<body>

<!-- Header -->
<div class="header-bar d-flex align-items-center justify-content-between flex-wrap">
    <img src="assets/media/icons/india-emblem.png" alt="India Emblem">
    <div class="flex-grow-1 text-center header-title">NOC Management System</div>
    <img src="assets/media/icons/maharashtra-seal.png" alt="Maharashtra Seal">
</div>

<!-- Registration Section -->
<div class="register-section">
    <!-- Left: Image -->
    <div class="register-image">
        <img src="img/login.png" alt="Register Illustration">
    </div>

    <!-- Right: Form -->
    <div class="register-form">
        <h3 class="text-center mb-4">युजर नोंदणी</h3>
        <form method="post" action="registrationDB.php" enctype="multipart/form-data">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">पुर्ण नाव</label><span style="color: red;">*</span>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">पत्ता</label><span style="color: red;">*</span>
                    <input type="text" name="address" class="form-control" required>
                </div>
            </div>
                <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">तालुका निवडा</label><span style="color: red;">*</span>
                    <select name="taluka" id="taluka" class="form-select" required>
                        <option value="" selected disabled>-- निवडा --</option>
                        <?php
                        include("include/conn.php");
                        $res = mysqli_query($con, "SELECT DISTINCT taluka FROM taluka");
                        while ($row = mysqli_fetch_assoc($res)) {
                            $taluka = htmlspecialchars($row['taluka']);
                            echo "<option value='$taluka'>$taluka</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">गाव निवडा</label><span style="color: red;">*</span>
                    <select name="village" id="village" class="form-select" required>
                        <option value="" selected disabled>-- गाव निवडा --</option>
                    </select>
                </div>
            </div>


            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">आधार क्रमांक</label><span style="color: red;">*</span>
                    <input type="text" name="aadharNo" class="form-control" maxlength="12" pattern="\d{12}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">ईमेल</label><span style="color: red;">*</span>
                    <input type="email" name="emailId" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">ओळखपत्र अपलोड करा</label><span style="color: red;">*</span>
                    <input type="file" name="identificationCertificate" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">मोबाईल क्रमांक</label><span style="color: red;">*</span>
                    <input type="text" name="mobileNo" class="form-control" maxlength="10" pattern="\d{10}" required>
                </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label">पासवर्ड</label><span style="color: red;">*</span>
                <input type="number" name="password" class="form-control" required>
            </div>   
            <div class="col-md-6">
                <label class="form-label">OTP टाका</label><span style="color: red;">*</span>
                <input type="text" name="otp" class="form-control" maxlength="6" required>
            </div>
            </div>
            <div class="d-grid mb-3">
                <button type="submit" name="submit" class="btn btn-primary" style="background-color:#7e41c3; border:none;">नोंदणी करा</button>
            </div>
            <div class="text-center">
                <a href="login.php">आधीच खाते आहे? लॉगिन करा</a>
            </div>
        </form>
    </div>
</div>

<?php include("include/jsLinks.php"); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$('#taluka').on('change', function () {
    var selectedTaluka = $(this).val();
    $.ajax({
        url: 'get_villages.php',
        type: 'GET',
        data: { taluka: selectedTaluka },
        success: function (data) {
            $('#village').empty().append('<option value="" disabled selected>-- गाव निवडा --</option>');
            if (Array.isArray(data)) {
                data.forEach(function (village) {
                    $('#village').append('<option value="' + village + '">' + village + '</option>');
                });
            }
        },
        error: function (xhr) {
            alert("गाव माहिती मिळवता आली नाही.");
            console.error(xhr.responseText);
        }
    });
});
</script>

</body>
</html>
