<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
session_start();
include('../include/conn.php');

?>
<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
  <base href="../">
  <title>NOC - अर्ज पहा (Civilian)</title>
  <meta charset="utf-8" />
  <meta name="description" content="Saul HTML Free - Bootstrap 5 HTML Multipurpose Admin Dashboard Theme" />
  <meta name="keywords"
    content="Saul, bootstrap, bootstrap 5, dmin themes, free admin themes, bootstrap admin, bootstrap dashboard" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
  <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
  <style>
    #datatable th {
      border: 1px solid #F4F4F4;

    }

    /* Style for table body cells */
    #datatable td {
      border: 1px solid #F4F4F4;
    }
  </style>
  <?php
  include('../include/conn.php');
  include("../include/cssLinks.php"); ?>
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
              <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
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
                      <li class="breadcrumb-item text-gray-700 fw-bold lh-1">NOC अर्ज पहा (Civilian)</li>
                      <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">
                      NOC अर्ज पहा (Civilian)</h1>
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
                <!-- <div class="card p-lg-17"> -->
                <!--begin::Body-->
                <div class="row mb-3">
                  <?php
                  /*
                  ?>
                <!--begin::Col-->
                <div class="col-md-12 pe-lg-10">

                  <!--begin::Form-->
                  <form action="" class="form mb-15 fv-plugins-bootstrap5 fv-plugins-framework" method="post"
                    id="kt_contact_form">

                    <!--begin::Input group-->
                    <div class="row mb-5">
                      <!--begin::Col-->
                      <div class="col-md-3 fv-row fv-plugins-icon-container">
                        <label class="fs-5 fw-semibold mb-2">NOC प्रकार निवडा</label>

                        <select class="form-select form-select-solid rounded-start-0 border-start"
                          data-control="select2" data-placeholder="Select an option" name="" required>
                          <option></option>
                          <?php
                          $nocQuery = mysqli_query($conn, "SELECT id, type FROM nocTypes WHERE status = 'Active'");
                          while ($row = mysqli_fetch_assoc($nocQuery)) {
                            echo '<option value="' . $row['id'] . '">' . $row['type'] . '</option>';
                          }
                          ?>


                        </select>
                      </div>
                      <!--end::Col-->

                      <!--begin::Col-->
                      <div class="col-md-3 fv-row fv-plugins-icon-container">
                        <label class="fs-5 fw-semibold mb-2">Department</label>

                        <select class="form-select form-select-solid rounded-start-0 border-start"
                          data-control="select2" data-placeholder="Select an option" name="" required>
                          <option></option>
                          <?php
                          $deptQuery = mysqli_query($conn, "SELECT id, departmentName FROM departments WHERE status = 'Active'");
                          while ($row = mysqli_fetch_assoc($deptQuery)) {
                            echo '<option value="' . $row['id'] . '">' . $row['departmentName'] . '</option>';
                          }
                          ?>

                        </select>
                      </div>
                      <div class="col-md-3 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <div class="mb-10">
                          <label for="" class="form-label">सुरुवात तारीख</label>
                          <input class="form-control" name="startDate" placeholder="सुरुवात तारीख"
                            id="kt_datepicker_1" />
                        </div>
                      </div>
                      <!--end::Col-->

                      <!--begin::Col-->
                      <div class="col-md-3 fv-row fv-plugins-icon-container">
                        <!--end::Label-->
                        <div class="mb-0">
                          <label for="" class="form-label">अंतिम तारीख</label>
                          <input class="form-control form-control-solid" name="endDate" placeholder="अंतिम तारीख"
                            id="kt_datepicker_2" />
                        </div>
                      </div>
                      <!--end::Col-->

                    </div>
                    <!--end::Input group-->



                    <button href="#" class="btn btn-primary" type="submit" name="submit">Show</button>

                    <!--begin::Submit-->

                    <!--end::Submit-->
                  </form>
                  <!--end::Form-->
                </div>
                <!--end::Col-->
                          <?php 
                        */
                  ?>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-rounded table-striped border gy-7 gs-7" id="datatable">
                        <thead>
                          <!--begin::Table row-->
                          <tr class="text-start text-dark-900 fw-bold fs-6 text-uppercase">
                            <th class="min-w-70px">Sr. No.</th>
                            <th class="min-w-100px">NOC क्रमंक</th>
                            <th class="min-w-100px">Civilian</th>
                            <th class="min-w-100px">NOC विषय </th>
                            <th class="min-w-100px">NOC प्रकार</th>
                            <th class="min-w-100px">जामिनीची तपशील</th>
                            <th class="min-w-100px">गट क्रमांक</th>
                            <th class="min-w-100px">अर्जदारचे नाव</th>
                            <th class="min-w-100px">मोबाईल क्र</th>
                            <th class="min-w-100px">पूर्ण पत्ता</th>
                            <th class="min-w-100px">आधार क्र</th>
                            <th class="min-w-100px">इमेल</th>
                            <th class="min-w-100px">जन्मतारीख</th>
                            <th class="min-w-100px">पेन कार्ड पहा</th>
                            <th class="min-w-100px">आधार कार्ड पहा</th>
                            <th class="min-w-100px">तारीख</th>
                            <th class="min-w-100px">स्थिती</th>
                            <th class="min-w-100px">Action</th>


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
    WHERE r.departmentId = $departmentId
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
                              <td><?php echo $r['name'] ?></td>
                              <td><?php echo $row['nocSubject'] ?></td>
                              <td><?php echo $r1['type'] ?></td>
                              <td><?php echo $row['landDesc'] ?></td>
                              <td><?php echo $row['gatNo'] ?></td>
                              <td><?php echo $row['name'] ?></td>
                              <td><?php echo $row['mobileNo'] ?></td>
                              <td><?php echo $row['address'] ?></td>
                              <td><?php echo $row['aadharNo'] ?></td>
                              <td><?php echo $row['emailId'] ?></td>
                              <td><?php echo date('d-m-Y', strtotime($row['dob'])) ?></td>
                              <td><?php if ($row['panCard']) { ?><a target="_blank"
                                    href="uploads/<?php echo $row['panCard'] ?>">View</a><?php } else
                                echo '-' ?></td>
                                <td><?php if ($row['aadharCard']) { ?><a target="_blank"
                                    href="uploads/<?php echo $row['aadharCard'] ?>">View</a><?php } else
                                echo '-' ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['createdDateTime'])) ?></td>
                              <td>
                                <?php
                                $status = $row['status'];

                                if ($status == 'Approved') {
                                  $color = 'text-success';
                                } else if ($status == 'Rejected') {
                                  $color = 'text-danger';
                                } else {
                                  $color = 'text-warning';
                                }
                                ?>
                                <span class="<?php echo $color; ?>"><?php echo $status; ?></span>
                              </td>

                              <td>
                                <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal"
                                  data-bs-target="#updateStatusModal<?php echo $row['applicationId']; ?>"
                                  data-id="<?php echo $row['applicationId']; ?>"
                                  data-applicationid="<?php echo $row['applicationId']; ?>">
                                  Change Status
                                </button>

                                <!-- Modal -->

                                <div class="modal fade" id="updateStatusModal<?php echo $row['applicationId']; ?>"
                                  tabindex="-1" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <form method="POST" action="department/nocReport_DB.php">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="updateStatusModalLabel">Update Application Status
                                          </h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                          <input type="hidden" name="applicationId" id="modalAppId">
                                          <input type="hidden" value="<?php echo $row['applicationId'] ?>"
                                            name="applicationId" id="modalApplicationId">

                                          <input type="hidden" value="<?php echo $departmentId ?>" name="departmentId"
                                            id="modalDepartmentId">
                                          <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select" name="status" id="statusSelect" required>
                                              <option value="">Select</option>
                                              <option value="Under Review">Under Review</option>
                                              <option value="Approved">Approved</option>
                                              <option value="Rejected">Rejected</option>
                                            </select>
                                          </div>

                                          <div class="mb-3 d-none" id="remarkDiv">
                                            <label for="remark" class="form-label">Rejection Remark</label>
                                            <textarea class="form-control" name="remarks" id="remark"
                                              placeholder="Reason for rejection..."></textarea>
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="submit" name="update" class="btn btn-success">Submit</button>
                                        </div>
                                      </div>
                                    </form>
                                  </div>
                                </div>

                              </td>


                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <!--end::Body-->
                <!-- </div> -->
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
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const allModals = document.querySelectorAll('[id^="updateStatusModal"]');

      allModals.forEach(modal => {
        modal.addEventListener('show.bs.modal', function (event) {
          const button = event.relatedTarget;
          const appId = button.getAttribute('data-id');
          const modalAppIdField = modal.querySelector('#modalAppId');
          if (modalAppIdField) {
            modalAppIdField.value = appId;
          }

          const statusSelect = modal.querySelector('#statusSelect');
          const remarkDiv = modal.querySelector('#remarkDiv');

          if (statusSelect) {
            // Set up change event on each time modal is opened
            statusSelect.addEventListener('change', function () {
              if (this.value === 'Rejected') {
                remarkDiv.classList.remove('d-none');
              } else {
                remarkDiv.classList.add('d-none');
              }
            });
          }
        });
      });
    });
  </script>


  <?php
  include('../include/jsLinks.php')
    ?>

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
              extend: 'copyHtml5',
              title: documentTitle
            },
            {
              extend: 'excelHtml5',
              title: documentTitle
            },
            {
              extend: 'csvHtml5',
              title: documentTitle
            },
            {
              extend: 'pdfHtml5',
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
  <script>
    $("#kt_datepicker_1").flatpickr();

    $("#kt_datepicker_2").flatpickr();
  </script>
</body>

<!--end::Body-->

</html>