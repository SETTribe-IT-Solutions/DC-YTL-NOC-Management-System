<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
session_start();
if (!isset($_SESSION['userId'])) {
    unset($_SESSION['designation']);
    unset($_SESSION['role']);
    header('location:../index.html');
    exit;
    die();
}
include('../include/conn.php');
?>
<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../" />
    <title>Saul Theme by Keenthemes</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
    <script>var defaultThemeMode = "light"; var themeMode; if (document.documentElement) { if (document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if (localStorage.getItem("data-bs-theme") !== null) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


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
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            width: 48%;
            margin: 1%;
        }

        .chart-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        canvas {
            width: 100% !important;
            height: auto !important;
        }

        .main-heading {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-top: 30px;
            margin-bottom: 10px;
        }

        .chart-box {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .chart-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
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
    <!--begin::Theme mode setup on page load-->

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
                                            <li class="breadcrumb-item text-gray-700 fw-bold lh-1">डॅशबोर्ड</li>
                                            <!--end::Item-->
                                        </ul>
                                        <!--end::Breadcrumb-->
                                        <!--begin::Title-->
                                        <h1
                                            class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">
                                            डॅशबोर्ड</h1>
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
                                <div class="row g-6 g-xl-9 mb-8">
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
                                                $result = mysqli_query($conn, "SELECT COUNT(DISTINCT village) AS total FROM users WHERE taluka = 'Yavatmal'");
                                                $data = mysqli_fetch_assoc($result);
                                                $total = $data['total'];
                                                ?>

                                                <div class="stat-value animate-count" style="font-size: 20px;">
                                                    एकूण गावे: <?php echo $total; ?>
                                                </div>

                                                <div class="trend-indicator trend-up">
                                                    <i class="ki-duotone ki-arrow-up fs-7"></i>
                                                </div>

                                                <!-- <div class="progress-bar">
                                                    <div class="progress-fill progress-primary" style="width: 0%"
                                                        data-width="78%"></div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>



                                    <!-- Project Finance Card -->
                                    <div class="col-lg-6 col-xxl-3">
                                        <div class="card dashboard-card h-100">
                                            <div class="card-body p-9">
                                                <div class="stat-icon icon-success">
                                                    <i class="ki-duotone ki-check fs-2x" style="color: white;">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </div>

                                                <?php
                                                $q1 = mysqli_query($con, "SELECT COUNT(*) AS count1 FROM nocApplications WHERE status = 'Approved'");
                                                $data1 = mysqli_fetch_assoc($q1);
                                                $count1 = $data1['count1'];

                                                $q2 = mysqli_query($con, "SELECT COUNT(*) AS count2 FROM departmentNocApplications WHERE status = 'Approved'");
                                                $data2 = mysqli_fetch_assoc($q2);
                                                $count2 = $data2['count2'];

                                                $totalApproved = $count1 + $count2;
                                                ?>

                                                <div class="stat-value animate-count" style="font-size: 20px;">
                                                    मंजुर अर्ज: <?php echo $totalApproved; ?>
                                                </div>

                                                <!-- <div class="stat-label">Project Finance</div> -->
                                                <div class="trend-indicator trend-up">
                                                    <i class="ki-duotone ki-arrow-up fs-7"></i>
                                                    <!-- +8.2% revenue -->
                                                </div>
                                                <!-- <div class="progress-bar">
                                                    <div class="progress-fill progress-success" style="width: 0%"
                                                        data-width="65%"></div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>



                                    <!-- Our Clients Card -->
                                    <div class="col-lg-6 col-xxl-3">
                                        <div class="card dashboard-card h-100">
                                            <div class="card-body p-9">

                                                <!-- ✅ Updated icon using Font Awesome -->
                                                <div class="stat-icon icon-warning">
                                                    <!-- Font Awesome icon for "wrong" or "cancelled" -->
                                                    <i class="fas fa-circle-xmark fs-2x" style="color: white;"></i>
                                                </div>

                                                <?php
                                                $q1 = mysqli_query($con, "SELECT COUNT(*) AS count1 FROM nocApplications WHERE status = 'Rejected'");
                                                $data1 = mysqli_fetch_assoc($q1);
                                                $count1 = $data1['count1'];

                                                $q2 = mysqli_query($con, "SELECT COUNT(*) AS count2 FROM departmentNocApplications WHERE status = 'Rejected'");
                                                $data2 = mysqli_fetch_assoc($q2);
                                                $count2 = $data2['count2'];

                                                $totalRejected = $count1 + $count2;
                                                ?>

                                                <div class="stat-value animate-count" style="font-size: 20px;">
                                                    नामंजुर अर्ज: <?php echo $totalRejected; ?>
                                                </div>

                                                <div class="trend-indicator trend-up">
                                                    <!-- <i class="fas fa-arrow-up fs-7"></i> -->
                                                </div>

                                                <!-- <div class="progress-bar">
                                                    <div class="progress-fill progress-warning" style="width: 0%"
                                                        data-width="89%"></div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Success Rate Card -->
                                    <!-- Font Awesome CDN (add this in <head> section if not already included) -->

                                    <div class="col-lg-6 col-xxl-3">
                                        <div class="card dashboard-card h-100">
                                            <div class="card-body p-9">

                                                <!-- ✅ Updated Icon using Font Awesome -->
                                                <div class="stat-icon icon-info">
                                                    <i class="fas fa-circle-exclamation fs-2x"
                                                        style="color: white;"></i>
                                                </div>

                                                <?php
                                                // Fetch pending application counts from both tables
                                                $q1 = mysqli_query($con, "SELECT COUNT(*) AS count1 FROM nocApplications WHERE status = 'Under Review'");
                                                $data1 = mysqli_fetch_assoc($q1);
                                                $count1 = $data1['count1'];

                                                $q2 = mysqli_query($con, "SELECT COUNT(*) AS count2 FROM departmentNocApplications WHERE status = 'Under Review'");
                                                $data2 = mysqli_fetch_assoc($q2);
                                                $count2 = $data2['count2'];

                                                $totalPending = $count1 + $count2;
                                                ?>

                                                <div class="stat-value animate-count" style="font-size: 20px;">
                                                    प्रलंबित अर्ज: <?php echo $totalPending; ?>
                                                </div>

                                                <div class="trend-indicator trend-up">
                                                    <!-- <i class="fas fa-arrow-up fs-7"></i> -->
                                                </div>

                                                <!-- <div class="progress-bar">
                                                    <div class="progress-fill progress-info" style="width: 0%"
                                                        data-width="94%"></div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <!--end::Stats Row-->

                                <div class="row g-6 g-xl-9 mb-8">
                                    <div class="col-lg-12">
                                        <div class="card card-flush ">
                                            <div class="card-header pt-5">
                                                <!--begin::Title-->
                                                <h3 class="card-title align-items-start flex-column">
                                                    <span class="card-label fw-bold text-gray-900">NOC प्रलंबित
                                                        अर्ज</span>
                                                </h3>
                                                <!--end::Title-->
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="table-responsive">
                                                    <table class="table table-rounded table-striped border gy-7 gs-7"
                                                        id="datatable">
                                                        <thead>
                                                            <!--begin::Table row-->
                                                            <tr
                                                                class="text-start text-dark-500 fw-bold fs-7 text-uppercase">
                                                                <th class="min-w-70px">Sr. No.</th>
                                                                <th class="min-w-100px">NOC क्रमंक</th>
                                                                <th class="min-w-100px">NOC विषय</th>
                                                                <th class="min-w-100px">NOC प्रकार</th>
                                                                <th class="min-w-100px">अर्जदारचे नाव</th>
                                                                <th class="min-w-100px">मोबाईल क्र</th>
                                                            </tr>
                                                            <!--end::Table row-->
                                                        </thead>
                                                        <tbody class="fw-semibold text-gray-600">
                                                            <?php
                                                            $departmentId = $_SESSION['departmentId'];
                                                            $result = mysqli_query($conn, "
    SELECT 
        a.applicationId,
        a.civilianId,
        a.nocSubject,
        a.nocTypeId,
        a.landDesc,
        a.taluka,
        a.village,
        a.gatNo,
        a.panCard,
        a.aadharCard,
        a.status,
        a.createdDateTime,

        -- From civilianRegistrations table
        c.name,
        c.address,
        c.aadharNo,
        c.emailId,
        c.dob,
        c.mobileNo

    FROM nocApplications a
     INNER JOIN nocApplicationReviews r ON a.applicationId = r.applicationId
    LEFT JOIN civilianRegistrations c ON a.civilianId = c.civilianId
    WHERE r.departmentId = $departmentId  AND r.status = 'Pending'
    ORDER BY a.createdDateTime DESC
");

                                                            $i = 1;
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $civilianId = $row['civilianId'];
                                                                $q = mysqli_query($con, "SELECT name FROM civilianRegistrations WHERE civilianId = '$civilianId'");
                                                                $r = mysqli_fetch_assoc($q);

                                                                $nocType = $row['nocTypeId'];
                                                                $q1 = mysqli_query($con, "SELECT type FROM nocTypes WHERE id = '$nocType'");
                                                                $r1 = mysqli_fetch_assoc($q1);
                                                                ?>
                                                                <tr class="odd">
                                                                    <td><?= $i++ ?></td>
                                                                    <td><?php echo $row['applicationId'] ?></td>

                                                                    <td><?php echo $row['nocSubject'] ?></td>
                                                                    <td><?php echo $r1['type'] ?></td>
                                                                    <td><?php echo $r['name'] ?></td>
                                                                    <td><?php echo $row['mobileNo'] ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    // Yavatmal taluka ke villages count chart
                                    // $query2 = "SELECT taluka, COUNT(DISTINCT village) AS village_count FROM users WHERE taluka = 'Yavatmal' GROUP BY taluka";
                                    
                                    // $res2 = mysqli_query($con, $query2) or die("Village Count Query Error: " . mysqli_error($con));
                                    // $taluka_villages = $village_counts = [];
                                    
                                    // while ($row = mysqli_fetch_assoc($res2)) {
                                    //     $taluka_villages[] = $row['taluka'];
                                    //     $village_counts[] = $row['village_count'];
                                    // }
                                    ?>

                                    <!--begin::Charts Row-->
                                    <!-- <div class="main-heading">NOC अर्जांचा तालुकानिहाय अहवाल</div> -->
                                    <!-- <div class="row g-6 g-xl-9 mb-8">
                                    <div class="col-lg-12 col-xxl-6">
                                        <div class="chart-row">
                                            <div class="chart-container chart-box">
                                                <div class="chart-title">तालुकानिहाय गावांची संख्या </div>
                                                <canvas id="villageChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                    <!--end::Charts Row-->
                                </div>
                                <!--end::Content container-->
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Content wrapper-->
                        <!--begin::Footer-->
                        <?php include('../include/footer.php'); ?>
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
        <!--begin::Javascript-->
        <?php
        include('../include/jsLinks.php');
        ?>
        <!--end::Vendors Javascript-->
        <!--begin::Custom Javascript(used for this page only)-->
        <script src="assets/js/widgets.bundle.js"></script>
        <script src="assets/js/custom/widgets.js"></script>
        <script src="assets/js/custom/apps/chat/chat.js"></script>
        <script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
        <script src="assets/js/custom/utilities/modals/create-account.js"></script>
        <script src="assets/js/custom/utilities/modals/create-app.js"></script>
        <script src="assets/js/custom/utilities/modals/users-search.js"></script>

        <!-- Dashboard Enhancement Script -->
        <script>

            $("#datatable").DataTable({

                "scrollCollapse": true,
                "language": {
                    "lengthMenu": "Show _MENU_",
                },
                "dom":
                    "<'row mb-2'" +
                    "<'col-sm-6 d-flex align-items-center justify-conten-start dt-toolbar'l>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end dt-toolbar'f>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">"
            });


            const villageChart = new Chart(document.getElementById('villageChart'), {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($taluka_villages); ?>,
                    datasets: [
                        {
                            label: 'गावे (Distinct Villages)',
                            backgroundColor: '#90ed7d',
                            data: <?php echo json_encode($village_counts); ?>
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 5
                            }
                        }
                    }
                }
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Animate counters
                function animateCounter(element, target, duration = 2000) {
                    const start = 0;
                    const startTime = performance.now();

                    function updateCounter(currentTime) {
                        const elapsed = currentTime - startTime;
                        const progress = Math.min(elapsed / duration, 1);

                        let current;
                        if (target === '237') {
                            current = Math.floor(progress * 237);
                        } else if (target === '49') {
                            current = Math.floor(progress * 49);
                        } else {
                            element.textContent = target;
                            return;
                        }

                        element.textContent = current;

                        if (progress < 1) {
                            requestAnimationFrame(updateCounter);
                        } else {
                            element.textContent = target;
                        }
                    }

                    requestAnimationFrame(updateCounter);
                }

                // Animate progress bars
                function animateProgressBars() {
                    const progressBars = document.querySelectorAll('.progress-fill');
                    progressBars.forEach((bar, index) => {
                        setTimeout(() => {
                            const targetWidth = bar.getAttribute('data-width');
                            bar.style.width = targetWidth;
                        }, index * 200);
                    });
                }

                // Initialize animations
                setTimeout(() => {
                    const counters = document.querySelectorAll('.animate-count');
                    counters.forEach(counter => {
                        const target = counter.getAttribute('data-value') || counter.textContent;
                        if (target !== '$3,290.00' && target !== '94.2%') {
                            animateCounter(counter, target);
                        }
                    });

                    animateProgressBars();
                }, 500);

                // Add hover effects
                const cards = document.querySelectorAll('.dashboard-card');
                cards.forEach(card => {
                    card.addEventListener('mouseenter', function () {
                        this.style.transform = 'translateY(-8px)';
                    });

                    card.addEventListener('mouseleave', function () {
                        this.style.transform = 'translateY(0)';
                    });
                });
            });
        </script>
        <!--end::Custom Javascript-->
        <!--end::Javascript-->
</body>
<!--end::Body-->

</html>