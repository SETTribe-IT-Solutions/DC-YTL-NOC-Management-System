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
    <title>NOC अर्ज पहा</title>
    <meta charset="utf-8" />
    <meta name="description" content="Saul HTML Free - Bootstrap 5 HTML Multipurpose Admin Dashboard Theme" />
    <meta name="keywords"
        content="Saul, bootstrap, bootstrap 5, dmin themes, free admin themes, bootstrap admin, bootstrap dashboard" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <?php include("../include/cssLinks.php"); ?>

    <link href="assets/css/trackNoc.css" rel="stylesheet" type="text/css" />

    <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />

    <style>
        #datatable th {
            border: 1px solid #F4F4F4;

        }

        /* Style for table body cells */
        #datatable td {
            border: 1px solid #F4F4F4;
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
                                                <a href="civilian/index.php" class="text-gray-500">
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
                                            <li class="breadcrumb-item text-gray-700 fw-bold lh-1">NOC अर्ज पहा
                                            </li>
                                            <!--end::Item-->
                                        </ul>
                                        <!--end::Breadcrumb-->
                                        <!--begin::Title-->
                                        <h1
                                            class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1">
                                            NOC अर्ज पहा
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
                                    <div class="card-body">
                                        <table class="table table-rounded table-striped border gy-7 gs-7"
                                            id="datatable">
                                            <thead>
                                                <!--begin::Table row-->
                                                <tr class="text-start text-dark-900 fw-bold fs-6 text-uppercase">
                                                    <th class="min-w-70px">Sr. No.</th>
                                                    <th>NOC क्रमांक</th>
                                                    <th>NOC प्रकार निवडा</th>
                                                    <th>जन्मतारीख</th>
                                                    <th>पूर्ण नाव</th>
                                                    <th>आधार क्रमांक</th>
                                                    <th>पत्ता</th>
                                                    <th>ईमेल ID</th>
                                                    <th>मोबाईल क्र.</th>
                                                    <th>जमिनीची तपशील</th>
                                                    <th>विषय</th>
                                                    <th>तालुका</th>
                                                    <th>गाव</th>
                                                    <th>गट क्रमांक</th>
                                                    <th>आधार कार्ड अपलोड करा</th>
                                                    <th>पॅन कार्ड अपलोड करा</th>
                                                    <th>Action</th>
                                                </tr>
                                                <!--end::Table row-->
                                            </thead>
                                            <tbody class="fw-semibold text-gray-600">
                                                <?php
                                                $i = 1;
                                                $userId = $_SESSION['userId'];
                                                $sql = "SELECT * FROM nocApplications WHERE civilianId='$userId' ORDER BY createdDateTime DESC";
                                                $q = mysqli_query($con, $sql);
                                                while ($r = mysqli_fetch_assoc($q)) {
                                                    $sql0 = "SELECT type FROM nocTypes WHERE id='{$r['nocTypeId']}'";
                                                    $q0 = mysqli_query($con, $sql0);
                                                    $r0 = mysqli_fetch_assoc($q0);
                                                    $r['nocType'] = $r0['type'];

                                                    ?>
                                                    <tr class="odd">
                                                        <td><?= $i++ ?></td>
                                                        <td><?= $r['applicationId']; ?></td>
                                                        <td><?= $r['nocType']; ?></td>
                                                        <td><?= $r['dob']; ?></td>
                                                        <td><?= $r['name']; ?></td>
                                                        <td><?= $r['aadharNo']; ?></td>
                                                        <td><?= $r['address']; ?></td>
                                                        <td><?= $r['emailId']; ?></td>
                                                        <td><?= $r['mobileNo']; ?></td>
                                                        <td><?= $r['landDesc']; ?></td>
                                                        <td><?= $r['landDesc']; ?></td>
                                                        <td><?= $r['taluka']; ?></td>
                                                        <td><?= $r['village']; ?></td>
                                                        <td><?= $r['gatNo']; ?></td>
                                                        <td><?= $r['aadharCard'] ? '<a href="' . $r['aadharCard'] . '" target="_blank">View</a>' : 'फाईल निवडलेली नाही'; ?>
                                                        </td>
                                                        <td><?= $r['panCard'] ? '<a href="' . $r['panCard'] . '" target="_blank">View</a>' : 'फाईल निवडलेली नाही'; ?>
                                                        </td>
                                                        <td>
                                                            <a
                                                                href="civilian/trackNoc.php?applicationId=<?= $r['applicationId'] ?>"><button
                                                                    type="button"
                                                                    class="btn btn-primary btn-sm">Track</button></a>
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