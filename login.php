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

        .login-form::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="%23198754" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>');
            background-repeat: no-repeat;
            background-size: 120px 120px;
            background-position: center;
            opacity: 0.05;
            z-index: 1;
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
    </style>
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
                    <div class="w-lg-700px p-10 p-lg-15 mx-auto">
                        <!--begin::Form-->
                        <div class="login-form">
                            <form class="form w-100" method="post" id="kt_sign_in_form" action="login_db.php">
                                <!--begin::Heading-->
                                <div class="text-center mb-8">
                                    <!--begin::Title-->
                                    <h1 class="text-dark mb-3" style="color: #1e3c72 !important;">Login to NOC Portal
                                    </h1>
                                    <!--end::Title-->
                                    <!--begin::Subtitle-->
                                    <div class="text-gray-600 fw-semibold fs-5 mb-4">
                                        Access your No Objection Certificate applications
                                    </div>
                                    <!--end::Subtitle-->
                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-6">New User?
                                        <a href="registration.php" class="fw-bold" style="color: #ff6600;">Register
                                            Here</a>
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--begin::Heading-->

                                <!--begin::Input group-->
                                <div class="fv-row mb-8">
                                    <!--begin::Label-->
                                    <label class="form-label fs-6 fw-bold" style="color: #1e3c72;">Mobile No</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control form-control-lg form-control-solid" required type="tel"
                                        name="mobileNo" minlength="10" maxlength="10" placeholder="Enter your mobile no"
                                        autocomplete="off" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="fv-row mb-8">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-stack mb-2">
                                        <!--begin::Label-->
                                        <label class="form-label fw-bold fs-6 mb-0"
                                            style="color: #1e3c72;">Password</label>
                                        <!--end::Label-->
                                        <!--begin::Link-->
                                        <a href="forgot_password.php" class="fs-6 fw-bold" style="color: #ff6600;">
                                            Forgot Password?
                                        </a>
                                        <!--end::Link-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Input-->
                                    <input class="form-control form-control-lg form-control-solid" type="password"
                                        name="password" placeholder="Enter your password" required autocomplete="off" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Actions-->
                                <div class="text-center">
                                    <!--begin::Submit button-->
                                    <button type="submit" id="kt_sign_in_submit" name="logIn"
                                        class="btn btn-lg btn-government w-100 mb-5">
                                        <span class="indicator-label">Login to Portal</span>
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <!--end::Submit button-->
                                </div>
                                <!--end::Actions-->
                            </form>
                        </div>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Content-->
                <!--begin::Footer-->
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
                <!--end::Footer-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->
    <!--begin::Javascript-->
    <?php
    include('include/jsLinks.php');
    include('include/sweetAlert.php');
    if (isset($_SESSION['msg'])) {
        $status = $_SESSION['status'];
        $msg = $_SESSION['msg'];
        if ($status != true) {
            sweetMsg('error', $msg);
        } else {
            sweetMsg('success', $msg);
        }
        unset($_SESSION['status']);
        unset($_SESSION['msg']);
    }
    ?>
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>