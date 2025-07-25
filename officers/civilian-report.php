<?php
session_start();

$designation = $_SESSION['designation'];

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
if (!isset($_SESSION['userId'])) {
    header('location:../login.php');
    exit;
}
$taluka = $_SESSION['taluka'];
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

    <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />

    <style>
        .table:not(.table-bordered) th:first-child,
        .table:not(.table-bordered) td:first-child {
            padding-left: 1.2rem !important;
        }

        .table:not(.table-bordered) td:last-child {
            padding-right: 1.2rem !important;
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
            <?php
            include("../include/header.php");
            ?>
            <!--end::Header-->
            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <!--begin::Sidebar-->
                <?php
// Check the user's designation
if ($designation === 'admin') {
    // If designation is 'admin', include the admin sidebar
    include("../include/admin-sidebar.php");
} else {
    // For all other designations, include the regular sidebar
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
                                            <li class="breadcrumb-item text-gray-700 fw-bold lh-1">NOC अर्जाची ट्रॅकिंग अहवाल
                                            </li>
                                            <!--end::Item-->
                                        </ul>
                                        <!--end::Breadcrumb-->
                                        <!--begin::Title-->
                                        <h1
                                            class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1">
                                            NOC Applications
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
                                <div class="card card-flush">
                                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                        <div class="card-title">
                                            <!--begin::Search-->
                                            <div class="d-flex align-items-center position-relative my-1">

                                                <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-4">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                <input type="text" data-kt-filter="search"
                                                    class="form-control form-control-solid w-250px ps-14"
                                                    placeholder="Search Report" />
                                            </div>
                                            <!--end::Search-->
                                            <!--begin::Export buttons-->
                                            <div id="kt_datatable_example_1_export" class="d-none"></div>
                                            <!--end::Export buttons-->
                                        </div>
                                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                            <!--begin::Export dropdown-->
                                            <button type="button" class="btn btn-light-primary"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                <i class="ki-duotone ki-exit-down fs-2"><span class="path1"></span><span
                                                        class="path2"></span></i>
                                                Export Report
                                            </button>
                                            <!--begin::Menu-->
                                            <div id="kt_datatable_example_export_menu"
                                                class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4"
                                                data-kt-menu="true">

                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3" data-kt-export="excel">
                                                        Export as Excel
                                                    </a>
                                                </div>
                                                <!--end::Menu item-->

                                            </div>
                                            <!--end::Menu-->
                                            <!--end::Export dropdown-->

                                            <!--begin::Hide default export buttons-->
                                            <div id="kt_datatable_example_buttons" class="d-none"></div>
                                            <!--end::Hide default export buttons-->
                                        </div>
                                    </div>
                                    <div class="card-body">
                                      <table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="kt_datatable_example">
    <thead>
        <tr class="text-start text-black-500 fw-bold fs-7 text-uppercase">
            <th>NOC क्रमांक</th>
            <th>NOC प्रकार</th>
            <th>पूर्ण नाव</th>
            <th>पत्ता</th>
            <th>ईमेल ID</th>
            <th>मोबाईल क्र.</th>
            <th>आधार क्रमांक</th>
            <th>जमिनीची तपशील</th>
            <th>तालुका</th>
            <th>गाव</th>
            <th>गट क्रमांक</th>
            <th>आधार कार्ड अपलोड करा</th>
            <th>पॅन कार्ड अपलोड करा</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="fw-semibold text-black-800">
        <?php
        // civilianId filter हटा दिया गया
        $sql = "SELECT na.*, nt.type AS nocType 
                FROM nocApplications na
                LEFT JOIN nocTypes nt ON nt.id = na.nocTypeId
                WHERE na.taluka = '$taluka'
                ORDER BY na.createdDateTime DESC ";

        $q = mysqli_query($con, $sql);
        while ($r = mysqli_fetch_assoc($q)) {
        ?>
            <tr class="odd">
                <td><?= $r['applicationId']; ?></td>
                <td><?= $r['nocType']; ?></td>
                <td><?= $r['name']; ?></td>
                <td><?= $r['address']; ?></td>
                <td><?= $r['emailId']; ?></td>
                <td><?= $r['mobileNo']; ?></td>
                <td><?= $r['aadharNo']; ?></td>
                <td><?= $r['landDesc']; ?></td>
                <td><?= $r['taluka']; ?></td>
                <td><?= $r['village']; ?></td>
                <td><?= $r['gatNo']; ?></td>
                <td><?= $r['aadharCard'] ? '<a href="' . $r['aadharCard'] . '" target="_blank">View</a>' : 'फाईल निवडलेली नाही'; ?></td>
                <td><?= $r['panCard'] ? '<a href="' . $r['panCard'] . '" target="_blank">View</a>' : 'फाईल निवडलेली नाही'; ?></td>
                <td>
                    <a href="civilian/trackNoc.php?applicationId=<?= $r['applicationId'] ?>">
                        <button type="button" class="btn btn-primary btn-sm">Track</button>
                    </a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

                                    </div>
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
    ?>

    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script>
        "use strict";

        // Class definition
        var KTDatatablesExample = function () {
            // Shared variables
            var table;
            var datatable;

            // Private functions
            var initDatatable = function () {
                // Set date data order
                const tableRows = table.querySelectorAll('tbody tr');

                tableRows.forEach(row => {
                    const dateRow = row.querySelectorAll('td');
                    const realDate = moment(dateRow[3].innerHTML, "DD MMM YYYY, LT").format(); // select date from 4th column in table
                    dateRow[3].setAttribute('data-order', realDate);
                });

                // Init datatable --- more info on datatables: https://datatables.net/manual/
                datatable = $(table).DataTable({
                    "info": false,
                    'order': [],
                    'pageLength': 10,
                });
            }

            // Hook export buttons
            var exportButtons = () => {
                const documentTitle = 'Customer Orders Report';
                var buttons = new $.fn.dataTable.Buttons(table, {
                    buttons: [

                        {
                            extend: 'excelHtml5',
                            title: documentTitle
                        }

                    ]
                }).container().appendTo($('#kt_datatable_example_buttons'));

                // Hook dropdown menu click event to datatable export buttons
                const exportButtons = document.querySelectorAll('#kt_datatable_example_export_menu [data-kt-export]');
                exportButtons.forEach(exportButton => {
                    exportButton.addEventListener('click', e => {
                        e.preventDefault();

                        // Get clicked export value
                        const exportValue = e.target.getAttribute('data-kt-export');
                        const target = document.querySelector('.dt-buttons .buttons-' + exportValue);

                        // Trigger click event on hidden datatable export buttons
                        target.click();
                    });
                });
            }

            // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
            var handleSearchDatatable = () => {
                const filterSearch = document.querySelector('[data-kt-filter="search"]');
                filterSearch.addEventListener('keyup', function (e) {
                    datatable.search(e.target.value).draw();
                });
            }

            // Public methods
            return {
                init: function () {
                    table = document.querySelector('#kt_datatable_example');

                    if (!table) {
                        return;
                    }

                    initDatatable();
                    exportButtons();
                    handleSearchDatatable();
                }
            };
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            KTDatatablesExample.init();
        });
    </script>
</body>
<!--end::Body-->

</html>