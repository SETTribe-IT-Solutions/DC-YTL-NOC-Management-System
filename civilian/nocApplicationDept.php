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
    <base href="../"></base>

    <title>Saul Theme by Keenthemes</title>
    <meta charset="utf-8" />
    <meta name="description" content="Saul HTML Free - Bootstrap 5 HTML Multipurpose Admin Dashboard Theme" />
    <meta name="keywords"
        content="Saul, bootstrap, bootstrap 5, dmin themes, free admin themes, bootstrap admin, bootstrap dashboard" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <?php include("../include/conn.php"); ?>
    <?php include("../include/cssLinks.php"); ?>

    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/global/plugins.bundle.js"></script>
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
            ?>
            <!--end::Header-->
            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <!--begin::Sidebar-->
                <?php include("../include/sidebar.php"); ?>
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
                                            <li class="breadcrumb-item text-gray-700 fw-bold lh-1">Blank</li>
                                            <!--end::Item-->
                                        </ul>
                                        <!--end::Breadcrumb-->
                                        <!--begin::Title-->
                                        <h1
                                            class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">
                                            Noc अर्ज सादर करण्याचा फॉर्म</h1>
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
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <!--begin::Content container-->
                            <div id="kt_app_content_container" class="app-container container-fluid">
                                <!--begin::Contact-->
                                <div class="card p-lg-17">
                                    <!--begin::Body-->
                                    <div class="row mb-3">
                                        <!--begin::Col-->
                                        <div class="col-md-12 pe-lg-10">

                                        <?php
 $queryGet = mysqli_query($conn, "SELECT COUNT(*) as applicationId FROM `departmentNocApplications` WHERE applicationId!=''") or die($conn->error);
$fetchGet = mysqli_fetch_assoc($queryGet);
$count = $fetchGet['applicationId'] + 1;
$formatted_count = sprintf('%03d', $count);

$applicationId = "NOC-2025-"."".$formatted_count;
                                      ?>
                                    
                                            <!--begin::Form-->
                                            <form action="civilian/ApllicationDb.php" 
                                                class="form mb-15 fv-plugins-bootstrap5 fv-plugins-framework"
                                                method="post" id="kt_contact_form">
                                                <!-- <h1 class="fw-bold text-gray-900 mb-9">Send Us Email</h1> -->

                                                <!--begin::Input group-->
                                                <div class="row mb-5">
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row fv-plugins-icon-container">
                                                        <!--begin::Label-->
                                                        <label class="fs-5 fw-semibold mb-2">NOC क्रंमांक</label>
                                                        <!--end::Label-->

                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid"
                                                            placeholder="" value="<?php echo $applicationId ?>" readonly name="nocNumber">
                                                        <!--end::Input-->
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                    <!--end::Col-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row fv-plugins-icon-container">
                                                        <!--end::Label-->
                                                        <label class="fs-5 fw-semibold mb-2">NOC प्रकार </label>
                                                        <!--end::Label-->

                                                        <!--end::Input-->
                                                    <select class="form-select form-select-solid" data-control="select2" name="nocType" data-placeholder="प्रकार निवडा">
    <option selected disabled value="">प्रकार निवडा</option>
    <?php
    $query = mysqli_query($conn,"SELECT id,type  FROM `nocTypes`") or die($conn->error);
    while($fetch = mysqli_fetch_assoc($query)) {
    ?>
     <option value="<?php echo $fetch['id'] ?>"><?php echo $fetch['type'] ?></option>
    <?php } ?>
</select>

                                                        <!--end::Input-->
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>


                                                    <!--end::Col-->
                                                </div>
                                   



       <div class="row mb-5">
                                                           <div class="col-md-6 fv-row fv-plugins-icon-container">
    <label class="fs-5 fw-semibold mb-2">इमेल आयडी</label>
     <input type="email" class="form-control form-control-solid"
                                                            placeholder="इमेल आयडी" name="emailId">
      <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>

             <div class="col-md-6 fv-row fv-plugins-icon-container">
    <label class="fs-5 fw-semibold mb-2">मोबाईल क्रमांक</label>
     <input type="text" class="form-control form-control-solid"
                                                            placeholder="मोबाईल क्रमांक" name="mobileNumber">
      <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
    </div>


      <div class="row mb-5">
                                                           <div class="col-md-6 fv-row fv-plugins-icon-container">
    <label class="fs-5 fw-semibold mb-2">जमिनीचा तपशील</label>
     <input type="text" class="form-control form-control-solid"
                                                            placeholder="जमिनीचा तपशील" name="jaminichaTapshil">
      <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>

             <div class="col-md-6 fv-row fv-plugins-icon-container">
    <label class="fs-5 fw-semibold mb-2">विषय</label>
     <input type="text" class="form-control form-control-solid"
                                                            placeholder="विषय" name="vishay">
      <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
    </div>


       <div class="row mb-5">
                                                         <div class="col-md-6 fv-row fv-plugins-icon-container">
                                                        <!--end::Label-->
                                                        <label class="fs-5 fw-semibold mb-2">तालुका</label>
                                                        <!--end::Label-->

                                                        <!--end::Input-->
                                                    <select class="form-select form-select-solid" id="taluka" data-control="select2" data-placeholder="तालुका निवडा" name="taluka" onchange="getTaluka()">
    <option selected disabled value="">तालुका निवडा</option>
    <?php
    $query = mysqli_query($conn,"SELECT DISTINCT(taluka)  FROM `taluka`") or die($conn->error);
    while($fetch = mysqli_fetch_assoc($query)) {
    ?>
     <option value="<?php echo $fetch['taluka'] ?>"><?php echo $fetch['taluka'] ?></option>
    <?php } ?>
</select>

                                                        <!--end::Input-->
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>

                                                    <!--end::Col-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row fv-plugins-icon-container">
                                                        <!--end::Label-->
                                                        <label class="fs-5 fw-semibold mb-2">गाव</label>
                                                        <!--end::Label-->

                                                        <!--end::Input-->
                                                    <select class="form-select form-select-solid" data-control="select2" id="village" name="village" data-placeholder="गाव निवडा">
    <option selected disabled value="">गाव निवडा</option>

</select>

                                                        <!--end::Input-->
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>



                                        


                                                    <!--end::Col-->
                                                </div>

<div class="row mb-5">

                  <div class="col-md-6 fv-row fv-plugins-icon-container">
    <label class="fs-5 fw-semibold mb-2">गट विभाग</label>
     <input type="text" class="form-control form-control-solid"
                                                            placeholder="गट विभाग" name="gatVibhag">
      <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>



                                                    
                  <div class="col-md-6 fv-row fv-plugins-icon-container">
    <label class="fs-5 fw-semibold mb-2">विभाग</label>
     <input type="text" class="form-control form-control-solid"
                                                            placeholder="विभाग" name="department">
      <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
</div>
                                                <!--end::Input group-->

                                                <!--begin::Submit-->
                                                <button type="submit" class="btn btn-primary"
                                                   name="submit">

                                                    <!--begin::Indicator label-->
                                                    <span class="indicator-label">
                                                        Submit</span>
                                                    <!--end::Indicator label-->

                                                    <!--begin::Indicator progress-->
                                                    <span class="indicator-progress">
                                                        Please wait... <span
                                                            class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                    </span>
                                                    <!--end::Indicator progress--> </button>
                                                <!--end::Submit-->
                                            </form>
                                            <!--end::Form-->
                                        </div>
                                        <!--end::Col-->

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


    <script>
$("#kt_datepicker_2").flatpickr();
        </script>


<script>
    function getTaluka(){
        var taluka = $("#taluka").val();
       
       $.ajax('civilian/getTaluka.php', {
            type: 'POST',  
            data: { taluka : taluka },  
            success: function (data) {
          
                document.getElementById('village').innerHTML = data;
            }
        });
    }

</script>



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
    <!--end::Scrolltop-->

    <?php
    include('../include/jsLinks.php')
        ?>
</body>
<!--end::Body-->

</html>