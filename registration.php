<?php
session_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <title>NOC Portal - Maharashtra Shashan</title>
    <meta charset="utf-8" />
    <meta name="description" content="No Objection Certificate Portal - Maharashtra Government" />
    <meta name="keywords" content="NOC, No Objection Certificate, Maharashtra Government, Maharashtra Shashan" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php
    include("include/cssLinks.php");
    ?>
    <style>
        .government-header {
            background: linear-gradient(135deg, #0f5132 0%, #198754 100%);
            border-bottom: 3px solid #20c997;
        }

        .emblem-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .emblem-logo {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 8px;
        }

        .emblem-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .maharashtra-logo {
            width: 84px;
            height: 79px;
            background: white;
            border-radius: 47px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 8px;
        }

        .maharashtra-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .noc-title {
            color: #20c997;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .government-text {
            color: white;
            font-size: 1.1rem;
            margin-bottom: 10px;
        }

        .login-form {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 600px;
            position: relative;
            overflow: hidden;
        }

       

        .login-form>* {
            position: relative;
            z-index: 2;
        }

        .form-control:focus {
            border-color: #198754;
            box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
        }

        .btn-government {
            background: linear-gradient(45deg, #198754, #20c997);
            border: none;
            color: white;
            font-weight: bold;
        }

        .btn-government:hover {
            background: linear-gradient(45deg, #0f5132, #198754);
            color: white;
        }

        .ashoka-chakra {
            width: 60px;
            height: 60px;
            border: 3px solid #000080;
            border-radius: 50%;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ashoka-chakra::before {
            content: "☸";
            font-size: 30px;
            color: #000080;
        }

        .maharashtra-text {
            font-size: 12px;
            color: #000080;
            font-weight: bold;
            text-align: center;
        }

        .logo-fallback {
            font-size: 12px;
            color: #1e3c72;
            font-weight: bold;
            text-align: center;
            line-height: 1.2;
        }


        .login-form {
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    padding: 40px;
    width: 100%;
    max-width: 600px;
    position: relative;
    overflow: hidden;
}

.form-label{

    font-weight: bold !important;
}

    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <script>var defaultThemeMode = "light"; var themeMode; if (document.documentElement) { if (document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if (localStorage.getItem("data-bs-theme") !== null) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }
    </script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="app-blank">
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Aside-->
            <div class="d-flex flex-column flex-lg-row-auto government-header w-xl-600px positon-xl-relative">
                <!--begin::Wrapper-->
                <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px">
                    <!--begin::Header-->
                    <div class="d-flex flex-row-fluid flex-column text-center p-5 p-lg-10 pt-lg-20">
                        <!--begin::Government Logos-->
                        <div class="emblem-container py-4">
                            <div class="emblem-logo">
                                <!-- Indian National Emblem -->
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/55/Emblem_of_India.svg/512px-Emblem_of_India.svg.png"
                                    alt="Emblem of India" />
                            </div>
                            <div class="maharashtra-logo">

                                <img src="assets/media/logos/Seal_of_Maharashtra.png"
                                    alt="Maharashtra Government Logo" />
                            </div>
                        </div>
                        <!--end::Government Logos-->

                        <!--begin::Title-->
                        <h1 class="d-none d-lg-block fw-bold text-white fs-2qx pb-3">
                            <span class="noc-title">NOC Portal</span>
                        </h1>
                        <div class="d-none d-lg-block government-text mb-4">
                            <div style="font-size: 1.3rem; margin-bottom: 5px;">महाराष्ट्र शासन</div>
                            <div style="font-size: 1.1rem;">Government of Maharashtra</div>
                        </div>
                        <!--end::Title-->

                        <!--begin::Description-->
                        <p class="d-none d-lg-block fw-semibold text-white" style="font-size: 28px;">
                            No Objection Certificate
                            <br />Management System
                        </p>
                        <!--end::Description-->
                    </div>
                    <!--end::Header-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--begin::Aside-->
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid py-5"
                style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">
                <!--begin::Content-->
                <div class="d-flex flex-center flex-column flex-column-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-700px p-10 p-lg-15 mx-auto" style="padding-top: 1rem !important;">
                        <!--begin::Form-->
                        

                            <div class="register-form login-form">
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
                <!--<div class="col-md-6">
                <label class="form-label">पासवर्ड</label><span style="color: red;">*</span>
                <input type="number" name="password" class="form-control" required>
            </div>    -->

            
  <div class="col-md-6 position-relative">
    <label class="form-label">पासवर्ड</label><span style="color: red;">*</span>
    <div class="input-group">
      <input type="password" name="password" id="passwordInput" class="form-control" required>
      <span class="input-group-text" onclick="togglePassword()" style="cursor: pointer;">
        <i id="eyeIcon" class="fa fa-eye"></i>
      </span>
    </div>
  </div>

            <div class="col-md-6">
                <label class="form-label">OTP टाका</label><span style="color: red;">*</span>
                <input type="text" name="otp" class="form-control" maxlength="6" required>
            </div>
            </div>
            <div class="d-grid mb-3">
                <button type="submit" name="submit" class="btn btn-lg btn-government w-100 mb-5" style="background-color:#7e41c3; border:none;">नोंदणी करा</button>
            </div>
            <div class="text-center">
                <a href="login.php">आधीच खाते आहे? लॉगिन करा</a>
            </div>

            
        </form>

          <div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
                    <!--begin::Links-->
                    <div class="d-flex flex-center fw-semibold fs-6">
                        <div class="text-muted text-hover-primary px-2">Developed & Maintained By <a
                                href="https://settribe.com/" style="color: #09969a;" target="_blank">SETTribe</a></div>
                        <!-- <a href="#" class="text-muted text-hover-primary px-2">Contact Support</a>
                        <a href="#" class="text-muted text-hover-primary px-2">Terms & Conditions</a> -->
                    </div>
                    <!--end::Links-->
                </div>
    </div>
</div>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Content-->
                <!--begin::Footer-->
              
                <!--end::Footer-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->
    <!--begin::Javascript-->
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

<script>
  function togglePassword() {
    const passwordInput = document.getElementById("passwordInput");
    const eyeIcon = document.getElementById("eyeIcon");

    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      eyeIcon.classList.remove("fa-eye");
      eyeIcon.classList.add("fa-eye-slash");
    } else {
      passwordInput.type = "password";
      eyeIcon.classList.remove("fa-eye-slash");
      eyeIcon.classList.add("fa-eye");
    }
  }
</script>

    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>