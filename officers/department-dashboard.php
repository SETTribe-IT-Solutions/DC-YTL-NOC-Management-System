<?php
session_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
if (!isset($_SESSION['userId'])) {
    unset($_SESSION['designation']);
    unset($_SESSION['role']);
    header('location:../login.php?role=officer&page=department-dashboard');
    exit;
    die();
}

if ($_SESSION['designation'] != 'Department') {
    unset($_SESSION['userId']);
    unset($_SESSION['designation']);
    unset($_SESSION['role']);
    header('location:../login.php?role=officer&page=department-dashboard');
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
    <meta name="description" content="Saul HTML Free - Bootstrap 5 HTML Multipurpose Admin Dashboard Theme" />
    <meta name="keywords"
        content="Saul, bootstrap, bootstrap 5, dmin themes, free admin themes, bootstrap admin, bootstrap dashboard" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <?php include("../include/cssLinks.php"); ?>
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
                                            <!-- <li class="breadcrumb-item">
                                                <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
                                            </li> -->
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <!-- <li class="breadcrumb-item text-gray-700 fw-bold lh-1">Tahsildar Dashboard
                                            </li> -->
                                            <!--end::Item-->
                                        </ul>
                                        <!--end::Breadcrumb-->
                                        <!--begin::Title-->
                                        <h1
                                            class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">
                                            Hi, Department 👋🏻</h1>
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
                                    <!--begin::Col-->
                                    <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                                        <!--begin::Card widget 4-->
                                        <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                                            <!--begin::Header-->
                                            <div class="card-header pt-5">
                                                <!--begin::Title-->
                                                <div class="card-title d-flex flex-column">
                                                    <!--begin::Info-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Currency-->
                                                        <span
                                                            class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">$</span>
                                                        <!--end::Currency-->
                                                        <!--begin::Amount-->
                                                        <span
                                                            class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">69,700</span>
                                                        <!--end::Amount-->
                                                        <!--begin::Badge-->
                                                        <span class="badge badge-light-success fs-base">
                                                            <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>2.2%</span>
                                                        <!--end::Badge-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Subtitle-->
                                                    <span class="text-gray-400 pt-1 fw-semibold fs-6">Expected
                                                        Earnings</span>
                                                    <!--end::Subtitle-->
                                                </div>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Card body-->
                                            <div class="card-body pt-2 pb-4 d-flex align-items-center">
                                                <!--begin::Chart-->
                                                <div class="d-flex flex-center me-5 pt-2">
                                                    <div id="kt_card_widget_4_chart"
                                                        style="min-width: 70px; min-height: 70px" data-kt-size="70"
                                                        data-kt-line="11"></div>
                                                </div>
                                                <!--end::Chart-->
                                                <!--begin::Labels-->
                                                <div class="d-flex flex-column content-justify-center w-100">
                                                    <!--begin::Label-->
                                                    <div class="d-flex fs-6 fw-semibold align-items-center">
                                                        <!--begin::Bullet-->
                                                        <div class="bullet w-8px h-6px rounded-2 bg-danger me-3"></div>
                                                        <!--end::Bullet-->
                                                        <!--begin::Label-->
                                                        <div class="text-gray-500 flex-grow-1 me-4">Shoes</div>
                                                        <!--end::Label-->
                                                        <!--begin::Stats-->
                                                        <div class="fw-bolder text-gray-700 text-xxl-end">$7,660</div>
                                                        <!--end::Stats-->
                                                    </div>
                                                    <!--end::Label-->
                                                    <!--begin::Label-->
                                                    <div class="d-flex fs-6 fw-semibold align-items-center my-3">
                                                        <!--begin::Bullet-->
                                                        <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                                                        <!--end::Bullet-->
                                                        <!--begin::Label-->
                                                        <div class="text-gray-500 flex-grow-1 me-4">Gaming</div>
                                                        <!--end::Label-->
                                                        <!--begin::Stats-->
                                                        <div class="fw-bolder text-gray-700 text-xxl-end">$2,820</div>
                                                        <!--end::Stats-->
                                                    </div>
                                                    <!--end::Label-->
                                                    <!--begin::Label-->
                                                    <div class="d-flex fs-6 fw-semibold align-items-center">
                                                        <!--begin::Bullet-->
                                                        <div class="bullet w-8px h-6px rounded-2 me-3"
                                                            style="background-color: #E4E6EF"></div>
                                                        <!--end::Bullet-->
                                                        <!--begin::Label-->
                                                        <div class="text-gray-500 flex-grow-1 me-4">Others</div>
                                                        <!--end::Label-->
                                                        <!--begin::Stats-->
                                                        <div class="fw-bolder text-gray-700 text-xxl-end">$45,257</div>
                                                        <!--end::Stats-->
                                                    </div>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Labels-->
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Card widget 4-->
                                        <!--begin::Card widget 5-->
                                        <div class="card card-flush h-md-50 mb-xl-10">
                                            <!--begin::Header-->
                                            <div class="card-header pt-5">
                                                <!--begin::Title-->
                                                <div class="card-title d-flex flex-column">
                                                    <!--begin::Info-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Amount-->
                                                        <span
                                                            class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">1,836</span>
                                                        <!--end::Amount-->
                                                        <!--begin::Badge-->
                                                        <span class="badge badge-light-danger fs-base">
                                                            <i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>2.2%</span>
                                                        <!--end::Badge-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Subtitle-->
                                                    <span class="text-gray-400 pt-1 fw-semibold fs-6">Orders This
                                                        Month</span>
                                                    <!--end::Subtitle-->
                                                </div>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Card body-->
                                            <div class="card-body d-flex align-items-end pt-0">
                                                <!--begin::Progress-->
                                                <div class="d-flex align-items-center flex-column mt-3 w-100">
                                                    <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                                        <span class="fw-bolder fs-6 text-dark">1,048 to Goal</span>
                                                        <span class="fw-bold fs-6 text-gray-400">62%</span>
                                                    </div>
                                                    <div class="h-8px mx-3 w-100 bg-light-success rounded">
                                                        <div class="bg-success rounded h-8px" role="progressbar"
                                                            style="width: 62%;" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <!--end::Progress-->
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Card widget 5-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                                        <!--begin::Card widget 6-->
                                        <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                                            <!--begin::Header-->
                                            <div class="card-header pt-5">
                                                <!--begin::Title-->
                                                <div class="card-title d-flex flex-column">
                                                    <!--begin::Info-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Currency-->
                                                        <span
                                                            class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">$</span>
                                                        <!--end::Currency-->
                                                        <!--begin::Amount-->
                                                        <span
                                                            class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">2,420</span>
                                                        <!--end::Amount-->
                                                        <!--begin::Badge-->
                                                        <span class="badge badge-light-success fs-base">
                                                            <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>2.6%</span>
                                                        <!--end::Badge-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Subtitle-->
                                                    <span class="text-gray-400 pt-1 fw-semibold fs-6">Average Daily
                                                        Sales</span>
                                                    <!--end::Subtitle-->
                                                </div>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Card body-->
                                            <div class="card-body d-flex align-items-end px-0 pb-0">
                                                <!--begin::Chart-->
                                                <div id="kt_card_widget_6_chart" class="w-100" style="height: 80px">
                                                </div>
                                                <!--end::Chart-->
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Card widget 6-->
                                        <!--begin::Card widget 7-->
                                        <div class="card card-flush h-md-50 mb-xl-10">
                                            <!--begin::Header-->
                                            <div class="card-header pt-5">
                                                <!--begin::Title-->
                                                <div class="card-title d-flex flex-column">
                                                    <!--begin::Amount-->
                                                    <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">6.3k</span>
                                                    <!--end::Amount-->
                                                    <!--begin::Subtitle-->
                                                    <span class="text-gray-400 pt-1 fw-semibold fs-6">New Customers This
                                                        Month</span>
                                                    <!--end::Subtitle-->
                                                </div>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Card body-->
                                            <div class="card-body d-flex flex-column justify-content-end pe-0">
                                                <!--begin::Title-->
                                                <span class="fs-6 fw-bolder text-gray-800 d-block mb-2">Today’s
                                                    Heroes</span>
                                                <!--end::Title-->
                                                <!--begin::Users group-->
                                                <div class="symbol-group symbol-hover flex-nowrap">
                                                    <div class="symbol symbol-35px symbol-circle"
                                                        data-bs-toggle="tooltip" title="Alan Warden">
                                                        <span
                                                            class="symbol-label bg-warning text-inverse-warning fw-bold">A</span>
                                                    </div>
                                                    <div class="symbol symbol-35px symbol-circle"
                                                        data-bs-toggle="tooltip" title="Michael Eberon">
                                                        <img alt="Pic" src="assets/media/avatars/300-11.jpg" />
                                                    </div>
                                                    <div class="symbol symbol-35px symbol-circle"
                                                        data-bs-toggle="tooltip" title="Susan Redwood">
                                                        <span
                                                            class="symbol-label bg-primary text-inverse-primary fw-bold">S</span>
                                                    </div>
                                                    <div class="symbol symbol-35px symbol-circle"
                                                        data-bs-toggle="tooltip" title="Melody Macy">
                                                        <img alt="Pic" src="assets/media/avatars/300-2.jpg" />
                                                    </div>
                                                    <div class="symbol symbol-35px symbol-circle"
                                                        data-bs-toggle="tooltip" title="Perry Matthew">
                                                        <span
                                                            class="symbol-label bg-danger text-inverse-danger fw-bold">P</span>
                                                    </div>
                                                    <div class="symbol symbol-35px symbol-circle"
                                                        data-bs-toggle="tooltip" title="Barry Walter">
                                                        <img alt="Pic" src="assets/media/avatars/300-12.jpg" />
                                                    </div>
                                                    <a href="#" class="symbol symbol-35px symbol-circle"
                                                        data-bs-toggle="modal" data-bs-target="#kt_modal_view_users">
                                                        <span
                                                            class="symbol-label bg-light text-gray-400 fs-8 fw-bold">+42</span>
                                                    </a>
                                                </div>
                                                <!--end::Users group-->
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Card widget 7-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
                                        <!--begin::Chart widget 3-->
                                        <div class="card card-flush overflow-hidden h-md-100">
                                            <!--begin::Header-->
                                            <div class="card-header py-5">
                                                <!--begin::Title-->
                                                <h3 class="card-title align-items-start flex-column">
                                                    <span class="card-label fw-bold text-dark">Sales This Months</span>
                                                    <span class="text-gray-400 mt-1 fw-semibold fs-6">Users from all
                                                        channels</span>
                                                </h3>
                                                <!--end::Title-->
                                                <!--begin::Toolbar-->
                                                <div class="card-toolbar">
                                                    <!--begin::Menu-->
                                                    <button
                                                        class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end"
                                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                                        data-kt-menu-overflow="true">
                                                        <i class="ki-duotone ki-dots-square fs-1">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                            <span class="path4"></span>
                                                        </i>
                                                    </button>
                                                    <!--begin::Menu 2-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                                                        data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">
                                                                Quick Actions</div>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu separator-->
                                                        <div class="separator mb-3 opacity-75"></div>
                                                        <!--end::Menu separator-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">New Ticket</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">New Customer</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                                            data-kt-menu-placement="right-start">
                                                            <!--begin::Menu item-->
                                                            <a href="#" class="menu-link px-3">
                                                                <span class="menu-title">New Group</span>
                                                                <span class="menu-arrow"></span>
                                                            </a>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu sub-->
                                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                                <!--begin::Menu item-->
                                                                <div class="menu-item px-3">
                                                                    <a href="#" class="menu-link px-3">Admin Group</a>
                                                                </div>
                                                                <!--end::Menu item-->
                                                                <!--begin::Menu item-->
                                                                <div class="menu-item px-3">
                                                                    <a href="#" class="menu-link px-3">Staff Group</a>
                                                                </div>
                                                                <!--end::Menu item-->
                                                                <!--begin::Menu item-->
                                                                <div class="menu-item px-3">
                                                                    <a href="#" class="menu-link px-3">Member Group</a>
                                                                </div>
                                                                <!--end::Menu item-->
                                                            </div>
                                                            <!--end::Menu sub-->
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">New Contact</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu separator-->
                                                        <div class="separator mt-3 opacity-75"></div>
                                                        <!--end::Menu separator-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <div class="menu-content px-3 py-3">
                                                                <a class="btn btn-primary btn-sm px-4" href="#">Generate
                                                                    Reports</a>
                                                            </div>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu 2-->
                                                    <!--end::Menu-->
                                                </div>
                                                <!--end::Toolbar-->
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Card body-->
                                            <div class="card-body d-flex justify-content-between flex-column pb-1 px-0">
                                                <!--begin::Statistics-->
                                                <div class="px-9 mb-5">
                                                    <!--begin::Statistics-->
                                                    <div class="d-flex mb-2">
                                                        <span class="fs-4 fw-semibold text-gray-400 me-1">$</span>
                                                        <span
                                                            class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">14,094</span>
                                                    </div>
                                                    <!--end::Statistics-->
                                                    <!--begin::Description-->
                                                    <span class="fs-6 fw-semibold text-gray-400">Another $48,346 to
                                                        Goal</span>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Statistics-->
                                                <!--begin::Chart-->
                                                <div id="kt_charts_widget_3" class="min-h-auto ps-4 pe-6"
                                                    style="height: 300px"></div>
                                                <!--end::Chart-->
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Chart widget 3-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->

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