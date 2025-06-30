<?php
session_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
if (!isset($_SESSION['userId'])) {
    header('location:../login.php');
    exit;
}

include('../include/conn.php');
include('../include/sweetAlert.php');
?>
<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../">
    <title>Saul Theme by Keenthemes</title>
    <meta charset="utf-8" />
    <meta name="description" content="Saul HTML Free - Bootstrap 5 HTML Multipurpose Admin Dashboard Theme" />
    <meta name="keywords"
        content="Saul, bootstrap, bootstrap 5, dmin themes, free admin themes, bootstrap admin, bootstrap dashboard" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <?php include("../include/cssLinks.php"); ?>

    <link href="assets/css/trackNoc.css" rel="stylesheet" type="text/css" />
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
                                            <li class="breadcrumb-item text-gray-700 fw-bold lh-1">NOC अर्जाची ट्रॅकिंग
                                            </li>
                                            <!--end::Item-->
                                        </ul>
                                        <!--end::Breadcrumb-->
                                        <!--begin::Title-->
                                        <?php
                                        $query = "SELECT nocSubject, applicationId, civilianId, na.createdDateTime, nt.type, taluka, village, panCard, aadharCard, gatNo FROM nocApplications na JOIN nocTypes nt ON na.nocTypeId = nt.id WHERE applicationId = ?";
                                        $stmt = $con->prepare($query);
                                        $stmt->bind_param("s", $_GET['applicationId']);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $row = $result->fetch_assoc();
                                        $civilianId = $row['civilianId'];
                                        $createdDateTime = $row['createdDateTime'];
                                        $type = $row['type'];
                                        $taluak = $row['taluka'];
                                        $village = $row['village'];
                                        $panCard = $row['panCard'];
                                        $aadharCard = $row['aadharCard'];
                                        $gatNo = $row['gatNO']
                                            ?>
                                        <h1
                                            class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1">
                                            NOC अर्जाची ट्रॅकिंग -
                                            <?php echo $row['nocSubject'] . " (" . $row['applicationId'] . ")" ?>
                                        </h1>
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
                                            <div class="timeline-wrapper">
                                                <!-- Green line for first 4 steps -->
                                                <div class="timeline-line green" style="height: 100%;"></div>
                                                <!-- Red line starting from rejection point -->
                                                <!-- <div class="timeline-line red" style="top: 60%; height: 20%;"></div> -->
                                                <!-- Yellow line for pending section -->
                                                <!-- <div class="timeline-line" style="top: 75%; bottom: 0; background: #ffc107;"></div> -->
                                                <!-- अर्जदार - यश बिभीषण गोटे

                                                अर्जाचा दिनांक: 12/01/2025
                                                अर्जाचा प्रकार : बांधकामासाठी NOC

                                                अर्जाची माहिती पहा -->
                                                <?php
                                                $query = "SELECT name FROM civilianRegistrations WHERE civilianId = ?";
                                                $stmt = $con->prepare($query);
                                                $stmt->bind_param("s", $civilianId);
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                $row = $result->fetch_assoc();

                                                ?>
                                                <div class="timeline-step">
                                                    <div class="timeline-circle">
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                    <div class="timeline-card">
                                                        <div class="timeline-header">
                                                            अर्जदार - <?php echo $row['name'] ?>
                                                        </div>
                                                        <div class="timeline-content">
                                                            <div class="timeline-detail">
                                                                <span class="label">अर्जाचा दिनांक:</span>
                                                                <span
                                                                    class="value"><?php echo date('d/m/y', strtotime($createdDateTime)) ?></span>
                                                            </div>
                                                            <div class="timeline-detail">
                                                                <span class="label">अर्जाचा प्रकार:</span>
                                                                <span class="value"><?php echo $type ?></span>
                                                            </div>
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                data-bs-toggle="modal" data-bs-target="#kt_modal_1">
                                                                <i class="fas fa-eye me-1"></i>अर्जाची माहिती पहा
                                                            </button>

                                                            <div class="modal fade" tabindex="-1" id="kt_modal_1">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h3 class="modal-title">अर्जाची माहिती</h3>

                                                                            <!--begin::Close-->
                                                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close">
                                                                                <i class="ki-duotone ki-cross fs-1"><span
                                                                                        class="path1"></span><span
                                                                                        class="path2"></span></i>
                                                                            </div>
                                                                            <!--end::Close-->
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            <div class="table-responsive">
                                                                                <table class="table">
                                                                                    <tbody>
                                                                                        <tr
                                                                                            class="fw-bold fs-6 text-gray-800">
                                                                                            <th>तालुका</th>
                                                                                            <td><?php echo $taluak ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr
                                                                                            class="fw-bold fs-6 text-gray-800">
                                                                                            <th>गाव</th>
                                                                                            <td><?php echo $village ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr
                                                                                            class="fw-bold fs-6 text-gray-800">
                                                                                            <th>पण कार्ड</th>
                                                                                            <td><?php echo $panCard; ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr
                                                                                            class="fw-bold fs-6 text-gray-800">
                                                                                            <th>आधार कार्ड</th>
                                                                                            <td><?php echo $aadharCard; ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr
                                                                                            class="fw-bold fs-6 text-gray-800">
                                                                                            <th>गठ क्र</th>
                                                                                            <td><?php echo $gatNo; ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>

                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-light"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                            <button type="button"
                                                                                class="btn btn-primary">Save
                                                                                changes</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                $applicationStatus = '';
                                                $query = "SELECT * FROM nocApplicationReviews WHERE applicationId = ?";
                                                $stmt = $con->prepare($query);
                                                $stmt->bind_param("s", $_GET['applicationId']);
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                while ($row = $result->fetch_assoc()) {

                                                    $departmentQuery = "SELECT * FROM departments WHERE id = ?";
                                                    $deptStmt = $con->prepare($departmentQuery);
                                                    $deptStmt->bind_param("i", $row['departmentId']);
                                                    $deptStmt->execute();
                                                    $departmentResult = $deptStmt->get_result();
                                                    $department = $departmentResult->fetch_assoc();

                                                    $userQuery = "SELECT * FROM users WHERE userId = ?";
                                                    $userStmt = $con->prepare($userQuery);
                                                    $userStmt->bind_param("s", $row['reviewedBy']);
                                                    $userStmt->execute();
                                                    $userResult = $userStmt->get_result();
                                                    $user = $userResult->fetch_assoc();

                                                    $applicationStatus = $row['status'];
                                                    if ($row['status'] == 'Approved') {
                                                        $statusColor = '20c997';

                                                    } elseif ($row['status'] == 'Rejected') {
                                                        $statusColor = 'dc3545';
                                                        $statusClass = 'rejected';
                                                    } else {
                                                        $statusColor = 'ffc107';
                                                        $statusClass = 'pending';
                                                    }
                                                    ?>
                                                    <div class="timeline-step">
                                                        <div class="timeline-circle <?php echo $statusClass; ?>">
                                                            <i class="fas fa-check"></i>
                                                        </div>
                                                        <div class="timeline-card">
                                                            <div class="timeline-header <?php echo $statusClass; ?>">
                                                                <?php
                                                                echo $department['departmentName'];
                                                                ?>
                                                            </div>
                                                            <div class="timeline-content">
                                                                <div class="timeline-detail">
                                                                    <span class="label">अनुमति दिनांक:</span>
                                                                    <span
                                                                        class="value"><?php echo date("d/m/y", strtotime($row['reviewedDateTime'])) ?></span>
                                                                </div>
                                                                <div class="timeline-detail">
                                                                    <span class="label">अनुमति स्थिति:</span>

                                                                    <span class="value"
                                                                        style="color: #<?php echo $statusColor; ?>; font-weight: bold;"><?php echo $row['status']; ?></span>
                                                                </div>
                                                                <?php
                                                                if ($row['status'] == 'Rejected') {
                                                                    ?>
                                                                    <div class="timeline-detail">
                                                                        <span class="label">नाकारले अधिकारी:</span>
                                                                        <span
                                                                            class="value"><?php echo $user['name'] ?? "-"; ?></span>
                                                                    </div>
                                                                    <div class="timeline-detail">
                                                                        <span class="label">नाकारण्याचे कारण:</span>
                                                                        <span class="value"
                                                                            style="color: #dc3545; font-weight: bold;"><?php echo $row['remarks']; ?></span>
                                                                    </div>
                                                                    <?php
                                                                } else {
                                                                    ?>

                                                                    <div class="timeline-detail">
                                                                        <span class="label">मंजूर अधिकारी:</span>
                                                                        <span
                                                                            class="value"><?php echo $user['name'] ?? "-"; ?></span>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <!-- <button class="btn-view">
                                                                    <i class="fas fa-eye me-1"></i>स्वीकृतिपेखें
                                                                </button> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }

                                                if ($applicationStatus == "Approved") {
                                                    ?>
                                                    <div class="timeline-step">
                                                        <div class="timeline-circle">
                                                            <i class="fas fa-check"></i>
                                                        </div>
                                                        <div class="timeline-card">
                                                            <div class="timeline-header">
                                                                NOC प्राप्त करा
                                                            </div>
                                                            <div class="timeline-content">
                                                                <div class="final-step">
                                                                    <div class="notice">
                                                                        नोट: सभावना हुआलेली आवश्यकताओं का ध्यान व सत्ये,
                                                                        अनुपालन उपलब्ध करे.
                                                                    </div>
                                                                    <button class="btn-download">
                                                                        <i class="fas fa-download me-2"></i>Download
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>


                                            </div>
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
    <!--end::Scrolltop-->

    <?php
    include('../include/jsLinks.php')
        ?>
</body>
<!--end::Body-->

</html>