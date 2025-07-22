<?php
session_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
if (!isset($_SESSION['userId'])) {
    unset($_SESSION['designation']);
    unset($_SESSION['role']);
    header('location:../login.php?role=civilian&page=index');
    exit;
    die();
}

if ($_SESSION['designation'] != 'Civilian') {
    unset($_SESSION['userId']);
    unset($_SESSION['designation']);
    unset($_SESSION['role']);
    header('location:../login.php?role=civilian');
    exit;
    die();
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
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <?php include("../include/cssLinks.php"); ?>

    <!-- Custom Dashboard Styles -->
    <style>
        .dashboard-card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            margin-bottom: 20px;
        }

        .icon-primary {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        }

        .icon-success {
            background: linear-gradient(135deg, #10b981, #059669);
        }

        .icon-warning {
            background: linear-gradient(135deg, #ff0000, #ff0000);
        }

        .icon-info {
            background: linear-gradient(135deg, #f6c000, #f6c000);
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1f2937;
            line-height: 1;
        }

        .stat-label {
            color: #6b7280;
            font-weight: 500;
            font-size: 1rem;
        }

        .trend-indicator {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-top: 8px;
        }

        .trend-up {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
        }

        .trend-down {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
        }

        .chart-container {
            height: 300px;
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 18px;
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .chart-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
        }

        .progress-bar {
            background: #e5e7eb;
            border-radius: 10px;
            height: 8px;
            overflow: hidden;
            margin-top: 15px;
        }

        .progress-fill {
            height: 100%;
            border-radius: 10px;
            transition: width 2s ease-in-out;
        }

        .progress-primary {
            background: linear-gradient(90deg, #3b82f6, #1d4ed8);
        }

        .progress-success {
            background: linear-gradient(90deg, #10b981, #059669);
        }

        .progress-warning {
            background: linear-gradient(90deg, #ff0000, #ff0000);
        }

        .progress-info {
            background: linear-gradient(90deg, #8b5cf6, #7c3aed);
        }

        .activity-item {
            display: flex;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 16px;
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-weight: 600;
            color: #374151;
            margin-bottom: 2px;
        }

        .activity-time {
            font-size: 0.75rem;
            color: #9ca3af;
        }

        @keyframes countUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-count {
            animation: countUp 1s ease-out;
        }
    </style>
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
            <?php include('../include/header.php'); ?>
            <!--end::Header-->
            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <!--begin::Sidebar-->
                <?php
                include('../include/sidebar.php');
                ?>
                <!--end::Sidebar-->
                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main" style="height: 600px;">
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
                                            <!-- <li class="breadcrumb-item">
                                                <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
                                            </li> -->
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <!-- <li class="breadcrumb-item text-gray-700 fw-bold lh-1">Dashboards</li> -->
                                            <!--end::Item-->
                                        </ul>
                                        <!--end::Breadcrumb-->
                                        <!--begin::Title-->
                                        <h1
                                            class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">
                                            Dashboard</h1>
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

                                <!--begin::Row-->
                                <div class="row g-5 g-xl-10 mb-xl-10">
                                    <!-- Current Projects Card -->
                                    <div class="col-lg-6 col-xxl-3">
                                        <div class="card dashboard-card h-100">
                                            <div class="card-body p-9">
                                                <div class="stat-icon icon-primary">
                                                    <i class="ki-duotone ki-abstract-26 fs-2x" style="color: white;">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </div>
                                                <?php
                                                $userId = $_SESSION['userId'];
                                                $result = mysqli_query($conn, "SELECT COUNT(id) AS total FROM nocApplications WHERE civilianId = '$userId'");
                                                $data = mysqli_fetch_assoc($result);
                                                $total = $data['total'];
                                                ?>
                                                <div class="stat-value animate-count" style="font-size: 20px;">
                                                    एकूण अर्ज: <?php echo $total; ?>
                                                </div>
                                                <!-- <div class="stat-label">Current Projects</div> -->
                                                <div class="trend-indicator trend-up">
                                                    <i class="ki-duotone ki-arrow-up fs-7"></i>
                                                    <!-- +12% this month -->
                                                </div>
                                                <div class="progress-bar">
                                                    <div class="progress-fill progress-primary" style="width: 0%"
                                                        data-width="78%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Project Finance Card -->
                                    <div class="col-lg-6 col-xxl-3">
                                        <div class="card dashboard-card h-100">
                                            <div class="card-body p-9">
                                                <div class="stat-icon icon-success">
                                                    <i class="ki-duotone ki-check-circle fs-2x" style="color: white;">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </div>

                                                <?php
                                                $q1 = mysqli_query($con, "SELECT COUNT(*) AS count1 FROM nocApplications WHERE civilianId = '$userId' AND status = 'Approved'");
                                                $data1 = mysqli_fetch_assoc($q1);
                                                $count1 = $data1['count1'];
                                                ?>

                                                <div class="stat-value animate-count" style="font-size: 20px;">
                                                    मंजुर अर्ज: <?php echo $count1; ?>
                                                </div>

                                                <!-- <div class="stat-label">Project Finance</div> -->
                                                <div class="trend-indicator trend-up">
                                                    <i class="ki-duotone ki-arrow-up fs-7"></i>
                                                    <!-- +8.2% revenue -->
                                                </div>
                                                <div class="progress-bar">
                                                    <div class="progress-fill progress-success" style="width: 0%"
                                                        data-width="65%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <!-- Our Clients Card -->
                                    <div class="col-lg-6 col-xxl-3">
                                        <div class="card dashboard-card h-100">
                                            <div class="card-body p-9">
                                                <div class="stat-icon icon-warning">


                                                    <i class="ki-duotone ki-cross-circle fs-2x" style="color: white;">
                                                        <span class=" path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </div>
                                                <?php
                                                $q1 = mysqli_query($con, "SELECT COUNT(*) AS count1 FROM nocApplications WHERE civilianId = '$userId' AND status = 'Rejected'");
                                                $data1 = mysqli_fetch_assoc($q1);
                                                $count1 = $data1['count1'];
                                                ?>

                                                <div class="stat-value animate-count" style="font-size: 20px;">
                                                    नामंजुर अर्ज: <?php echo $count1; ?>
                                                </div>
                                                <!-- <div class="stat-label">Our Clients</div> -->
                                                <div class="trend-indicator trend-up">
                                                    <i class="ki-duotone ki-arrow-up fs-7"></i>
                                                    <!-- +3 new clients -->
                                                </div>

                                                <div class="progress-bar">
                                                    <div class="progress-fill progress-warning" style="width: 0%"
                                                        data-width="89%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Success Rate Card -->
                                    <div class="col-lg-6 col-xxl-3">
                                        <div class="card dashboard-card h-100">
                                            <div class="card-body p-9">

                                                <!-- 🟦 Info circle with ! icon -->
                                                <div class="stat-icon icon-info">
                                                    <i class="ki-duotone ki-information-5 fs-2x" style="color: white;">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>


                                                </div>

                                                <?php
                                                $q1 = mysqli_query($con, "SELECT COUNT(*) AS count1 FROM nocApplications WHERE civilianId = '$userId' AND (status = 'Under Review' OR status = 'Submitted')");
                                                $data1 = mysqli_fetch_assoc($q1);
                                                $count1 = $data1['count1'];

                                                ?>

                                                <div class="stat-value animate-count" style="font-size: 20px;">
                                                    प्रलंबित अर्ज: <?php echo $count1; ?>
                                                </div>

                                                <div class="trend-indicator trend-up">
                                                    <i class="ki-duotone ki-arrow-up fs-7"></i>
                                                </div>

                                                <div class="progress-bar">
                                                    <div class="progress-fill progress-info" style="width: 0%"
                                                        data-width="94%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!--end::Stats Row-->



                            </div>
                            <!--end::Content container-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Content wrapper-->
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