<?php
session_start();
$designation = $_SESSION['designation'];

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../">
    </base>

    <title>NOC Application</title>
    <meta charset="utf-8" />
    <meta name="description" content="Saul HTML Free - Bootstrap 5 HTML Multipurpose Admin Dashboard Theme" />
    <meta name="keywords"
        content="Saul, bootstrap, bootstrap 5, dmin themes, free admin themes, bootstrap admin, bootstrap dashboard" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <?php include("../include/conn.php"); ?>
    <?php include("../include/cssLinks.php"); ?>

    <link href="../assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />


    <link href="../assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />

</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_app_body" data-kt-app-header-fixed="true" data-kt-app-header-fixed-mobile="true"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
    data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true"
    data-kt-app-aside-enabled="true" data-kt-app-aside-fixed="true" data-kt-app-aside-push-toolbar="true"
    data-kt-app-aside-push-footer="true" class="app-default">
    <!--end::Theme mode setup on page load-->
    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!--begin::Header-->
            <?php
            include("../include/header.php");
            include('../include/conn.php');
            ?>
            <!--end::Header-->
            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <!--begin::Sidebar-->
                         <?php

if ($designation === 'admin') {
    include("../include/admin-sidebar.php");
} else {
    include("../include/sidebar.php");
}
?>
                <!--end::Sidebar-->
                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">
                        <!--begin::Toolbar-->
                        <div id="kt_app_toolbar" class="app-toolbar pt-5">
                            <!--begin::Toolbar container-->
                            <div id="kt_app_toolbar_container"
                                class="app-container container-fluid d-flex align-items-stretch">
                                <!--begin::Toolbar wrapper-->
                                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                                    <!--begin::Page title-->
                                    <div class="page-title d-flex flex-column gap-1 me-3 mb-2">
                                        <!--begin::Breadcrumb-->
                                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold mb-6">
                                            <!--begin::Item-->
                                            <li class="breadcrumb-item text-gray-700 fw-bold lh-1">
                                                <a href="../dist/index.html" class="text-gray-500">
                                                    <i class="ki-duotone ki-home fs-3 text-gray-400 me-n1"></i>
                                                </a>
                                            </li>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <li class="breadcrumb-item">
                                                <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
                                            </li>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <li class="breadcrumb-item text-gray-700 fw-bold lh-1">NOC</li>
                                            <!--end::Item-->
                                        </ul>
                                        <!--end::Breadcrumb-->
                                        <!--begin::Title-->
                                        <!-- <h1
                                            class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">
                                            NOC</h1> -->
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Page title-->
                                </div>
                                <!--end::Toolbar wrapper-->
                            </div>
                            <!--end::Toolbar container-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Content-->
                        <div id="kt_app_content" class="app-content flex-column-fluid p-0">
                            <!--begin::Content container-->
                            <div id="kt_app_content_container" class="app-container container-fluid">
                                <!--begin::Contact-->
                                <div class="card">
                                    <!--begin::Body-->
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <!--begin::Col-->
                                            <div class="col-md-12">
                                                <!--begin::Form-->
                                                <?php
                                                $queryGet = mysqli_query($conn, "SELECT COUNT(*) as applicationId FROM `nocApplicationIds`");
                                                $fetchGet = mysqli_fetch_assoc($queryGet);
                                                $count = $fetchGet['applicationId'] + 1;
                                                $formatted_count = sprintf('%03d', $count);

                                                $applicationId = "NOC-2025-" . "" . $formatted_count;

                                                $userId = $_SESSION['userId'];
                                                $queryCivilian = mysqli_query($conn, "SELECT * FROM `civilianRegistrations` WHERE civilianId='$userId'");
                                                $resultCivilian = mysqli_fetch_assoc($queryCivilian);
                                                $civilianRow = mysqli_num_rows($queryCivilian);
                                                $name = $resultCivilian['name'];
                                                $aadharNo = $resultCivilian['aadharNo'];
                                                $address = $resultCivilian['address'];
                                                $mobileNo = $resultCivilian['mobileNo'];
                                                $emailId = $resultCivilian['emailId'];

                                                if ($civilianRow == 0) {
                                                    $readonly = "";
                                                }else {
                                                    $readonly = "readonly";
                                                }


                                                ?>

                                                <form action="nocApplicationDB.php"
                                                    class="form mb-15 fv-plugins-bootstrap5 fv-plugins-framework p"
                                                    method="pgitost" id="" enctype="multipart/form-data">
                                                    <h1 class="fw-bold text-gray-900 mb-9">NOC अर्ज सादर करण्याचा फॉर्म
                                                    </h1>
                                                    <input type="hidden" name="applicationType" value="Civillian">

                                                    <!--begin::Input group-->
                                                    <div class="row">
                                                        <!--begin::Col-->
                                                        <div class="col-md-6 mb-2 fv-row fv-plugins-icon-container">
                                                            <label class="fs-5 fw-semibold mb-2">NOC क्रमांक <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                value="<?php echo $applicationId; ?>" name="nocNumber"
                                                                placeholder="NOC क्रमांक" <?php echo $readonly; ?>>
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                            </div>
                                                        </div>
                                                        <!--end::Col-->

                                                        <!--begin::Col-->
                                                        <div class="col-md-6 mb-2 fv-row fv-plugins-icon-container">
                                                            <label class="fs-5 fw-semibold mb-2">NOC प्रकार निवडा <span
                                                                    class="text-danger">*</span></label>
                                                            <select data-control="select2" name="nocType"
                                                                data-placeholder="प्रकार निवडा" id="nocType"
                                                                class="form-control">
                                                                <option value="" disabled selected>NOC प्रकार निवडा
                                                                </option>
                                                                <?php
                                                                $sql = "SELECT type,id FROM nocTypes";
                                                                $stmt = $conn->prepare($sql);

                                                                if ($stmt->execute()) {
                                                                    $result = $stmt->get_result();
                                                                    while ($row = $result->fetch_assoc()) {
                                                                        echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['type']) . "</option>";
                                                                    }
                                                                } else {
                                                                    echo "Query execution failed: ";
                                                                }
                                                                $stmt->close();
                                                                ?>
                                                            </select>
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                            </div>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="row">
                                                        <!--begin::Col-->
                                                        <div class="col-md-6 mb-2 fv-row fv-plugins-icon-container">
                                                            <label class="fs-5 fw-semibold mb-2">जन्मतारीख <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="date" class="form-control" id="dob" name="dob"
                                                                placeholder="जन्मतारीख">
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                            </div>
                                                        </div>

                                                        <!--begin::Col-->
                                                        <div class="col-md-6 mb-2 fv-row fv-plugins-icon-container">
                                                            <label class="fs-5 fw-semibold mb-2">पूर्ण नाव <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                value="<?php echo $name; ?>" <?php echo $readonly; ?> name="fullName"
                                                                placeholder="पूर्ण नाव">
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                            </div>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="row">
                                                        <!--begin::Col-->
                                                        <div class="col-md-6 mb-2 fv-row fv-plugins-icon-container">
                                                            <label class="fs-5 fw-semibold mb-2">आधार क्रमांक <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="aadharNo"
                                                                placeholder="आधार क्रमांक" <?php echo $readonly; ?>
                                                                value="<?php echo $aadharNo; ?>" maxlength="12"
                                                                minlength="12" pattern="\d{12}"
                                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                                required>
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                            </div>
                                                        </div>
                                                        <!--end::Col-->

                                                        <!--begin::Col-->
                                                        <div class="col-md-6 mb-2 fv-row fv-plugins-icon-container">
                                                            <label class="fs-5 fw-semibold mb-2">पत्ता <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" <?php echo $readonly; ?> class="form-control"
                                                                value="<?php echo $address; ?>" name="address"
                                                                placeholder="पत्ता" required>
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                            </div>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="row">
                                                        <!--begin::Col-->
                                                        <div class="col-md-6 mb-2 fv-row fv-plugins-icon-container">
                                                            <label class="fs-5 fw-semibold mb-2">इमेल ID <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="email" <?php echo $readonly; ?> class="form-control"
                                                                value="<?php echo $emailId; ?>" name="email"
                                                                placeholder="इमेल ID" required>
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                            </div>
                                                        </div>
                                                        <!--end::Col-->

                                                        <!--begin::Col-->
                                                        <div class="col-md-6 mb-2 fv-row fv-plugins-icon-container">
                                                            <label class="fs-5 fw-semibold mb-2">मोबाईल क्र. <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="mobileNo"
                                                                placeholder="मोबाईल क्र." <?php echo $readonly; ?> maxlength="10"
                                                                value="<?php echo $mobileNo; ?>" minlength="10"
                                                                pattern="\d{10}"
                                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                                required>
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                            </div>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="row">
                                                        <!--begin::Col-->
                                                        <div class="col-md-6 mb-2 fv-row fv-plugins-icon-container">
                                                            <label class="fs-5 fw-semibold mb-2">जामिनीची तपशील <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="landDesc"
                                                                placeholder="जामिनीची तपशील" required>
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                            </div>
                                                        </div>
                                                        <!--end::Col-->

                                                        <!--begin::Col-->
                                                        <div class="col-md-6 mb-2 fv-row fv-plugins-icon-container">
                                                            <label class="fs-5 fw-semibold mb-2">विषय <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="nocSubject"
                                                                placeholder="विषय" required>
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                            </div>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="row">
                                                        <!--begin::Col-->
                                                        <div class="col-md-6 mb-2 fv-row fv-plugins-icon-container">
                                                            <label class="fs-5 fw-semibold mb-2">तालुका <span
                                                                    class="text-danger">*</span></label>
                                                            <select name="taluka" data-control="select2"
                                                                data-placeholder="तालुका निवडा" id="taluka"
                                                                class="form-control" onchange="getVillages()">
                                                                <option value="">तालुका निवडा</option>
                                                                <?php
                                                                $sql = "SELECT DISTINCT taluka FROM taluka";
                                                                $stmt = $conn->prepare($sql);

                                                                if ($stmt->execute()) {
                                                                    $result = $stmt->get_result();
                                                                    while ($row = $result->fetch_assoc()) {
                                                                        echo "<option>" . htmlspecialchars($row['taluka']) . "</option>";
                                                                    }
                                                                } else {
                                                                    echo "Query execution failed: ";
                                                                }
                                                                $stmt->close();
                                                                ?>
                                                            </select>
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                            </div>
                                                        </div>
                                                        <!--end::Col-->

                                                        <!--begin::Col-->
                                                        <div class="col-md-6 mb-2 fv-row fv-plugins-icon-container">
                                                            <label class="fs-5 fw-semibold mb-2">गाव <span
                                                                    class="text-danger">*</span></label>
                                                            <select id="villageSelect" name="village"
                                                                data-control="select2" data-placeholder="गाव निवडा"
                                                                class="form-control">
                                                                <option value="">गाव निवडा</option>
                                                            </select>
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                            </div>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="row">
                                                        <!--begin::Col-->
                                                        <div class="col-md-6 mb-2 fv-row fv-plugins-icon-container">
                                                            <label class="fs-5 fw-semibold mb-2">गट क्रमांक <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="gatNo"
                                                                placeholder="गट क्रमांक" required>
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                            </div>
                                                        </div>
                                                        <!--end::Col-->

                                                        <!--begin::Col-->
                                                        <div class="col-md-6 mb-2 fv-row fv-plugins-icon-container">
                                                            <label class="fs-5 fw-semibold mb-2">पेन कार्ड अपलोड करा
                                                                <span class="text-danger">*</span></label>
                                                            <input type="file" class="form-control"
                                                                accept="image/*, .pdf" id="penCard" name="penCard"
                                                                required>
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                            </div>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <div class="row">
                                                        <!--begin::Col-->
                                                        <div class="col-md-6 mb-2 fv-row fv-plugins-icon-container">
                                                            <label class="fs-5 fw-semibold mb-2">आधारकार्ड अपलोड करा
                                                                <span class="text-danger">*</span></label>
                                                            <input type="file" class="form-control"
                                                                accept="image/*, .pdf" id="aadharCard" name="aadharCard"
                                                                required>
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                            </div>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Submit-->
                                                    <button type="submit" name="submit" class="btn btn-primary"
                                                        id="kt_contact_submit_button">
                                                        <span class="indicator-label">Submit</span>
                                                    </button>
                                                    <button type="button" class="btn btn-light ms-2">Cancel</button>
                                                    <!--end::Submit-->
                                                </form> <!--end::Form-->
                                            </div>
                                            <!--end::Col-->

                                        </div>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Contact-->
                            </div>
                            <!--end::Content container-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Content wrapper-->
                    <!--begin::Footer-->
                    <?php
                    include('../include/footer.php')
                        ?>
                    <!--end::Footer-->
                </div>
                <!--end:::Main-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::App-->
    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-duotone ki-arrow-up">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </div>
    <!--end::Scrolltop-->
    <?php
    include('../include/jsLinks.php');
    include('../include/sweetAlert.php');
    if (isset($_SESSION['msg'])) {
        $status = $_SESSION['status'];
        $msg = $_SESSION['msg'];
        if ($status != true) {
            toastMsg('error', $msg);
        } else {
            toastMsg('success', $msg);
        }
        unset($_SESSION['status']);
        unset($_SESSION['msg']);
    }
    ?>
    <?php
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




    <script>
        function getVillages() {
            var taluka = $('#taluka').val();
            var taluka = document.getElementById("taluka").value;

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
        }
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
    <?php include('../include/jsLinks.php'); ?>
    <script src="../assets/plugins/global/plugins.bundle.js"></script>
    <script src="../assets/js/scripts.bundle.js"></script>
    <script>
        $("#dob").flatpickr();
    </script>
</body>
<!--end::Body-->

</html>