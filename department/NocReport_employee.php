<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
session_start();

if (!isset($_SESSION['userId'])) {

  header("Location: ../index.html");
  exit();
}
include('../include/conn.php');
echo $userId = $_SESSION['userId'];
$departmentId = $_SESSION['departmentId'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <base href="../">
  <title>NOC Portal</title>
  <meta charset="utf-8" />
  <meta name="description" content="Saul HTML Free - Bootstrap 5 HTML Multipurpose Admin Dashboard Theme" />
  <meta name="keywords"
    content="Saul, bootstrap, bootstrap 5, admin themes, free admin themes, bootstrap admin, bootstrap dashboard" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
  <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
  <style>
    #datatable th {
      border: 1px solid #F4F4F4;
    }

    #datatable td {
      border: 1px solid #F4F4F4;
    }
  </style>
  <?php include("../include/cssLinks.php"); ?>
</head>
>

<body id="kt_app_body" data-kt-app-header-fixed="true" data-kt-app-header-fixed-mobile="true"
  data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
  data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true"
  data-kt-app-aside-enabled="true" data-kt-app-aside-fixed="true" data-kt-app-aside-push-toolbar="true"
  data-kt-app-aside-push-footer="true" class="app-default">
  <!--begin::App-->
  <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
      <!--begin::Header-->
      <?php include("../include/header.php"); ?>
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
                      <li class="breadcrumb-item text-gray-700 fw-bold lh-1">
                        <a href="../dist/index.html" class="text-gray-500">
                          <i class="ki-duotone ki-home fs-3 text-gray-400 me-n1"></i>
                        </a>
                      </li>
                      <li class="breadcrumb-item">
                        <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
                      </li>
                      <li class="breadcrumb-item text-gray-700 fw-bold lh-1">NOC अर्ज पहा (Civilian)</li>
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
                <div class="row mb-3">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-rounded table-striped border gy-7 gs-7" id="datatable">
                        <thead>
                          <tr class="text-start text-dark-900 fw-bold fs-6 text-uppercase">
                            <th class="min-w-70px">Sr. No.</th>
                            <th class="min-w-100px">NOC क्रमंक</th>
                            <th class="min-w-100px">Civilian</th>
                            <th class="min-w-100px">NOC विषय</th>
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
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                          <?php
                          $departmentId = $_SESSION['departmentId'];
                          $stmt = "
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
                                  a.inspectionOfficer,
                                  c.name,
                                  c.address,
                                  c.aadharNo,
                                  c.emailId,
                                  c.dob,
                                  c.mobileNo
                              FROM nocApplications a
                              INNER JOIN nocApplicationReviews r ON a.applicationId = r.applicationId
                              LEFT JOIN civilianRegistrations c ON a.civilianId = c.civilianId
                              WHERE  a.inspectionOfficer= '$userId'
                              ORDER BY a.createdDateTime DESC
                          ";
                          $result = mysqli_query($conn, $stmt);
                          $i = 1;
                          while ($row = $result->fetch_assoc()) {
                            $civilianId = $row['civilianId'];
                            $q = $conn->prepare("SELECT name FROM civilianRegistrations WHERE civilianId = ?");
                            $q->bind_param("s", $civilianId);
                            $q->execute();
                            $r = $q->get_result()->fetch_assoc();

                            $nocType = $row['nocTypeId'];
                            $q1 = $conn->prepare("SELECT type FROM nocTypes WHERE id = ?");
                            $q1->bind_param("i", $nocType);
                            $q1->execute();
                            $r1 = $q1->get_result()->fetch_assoc();
                            ?>
                            <tr class="odd">
                              <td><?= $i++ ?></td>
                              <td><?php echo htmlspecialchars($row['applicationId']); ?></td>
                              <td><?php echo isset($r['name']) ? htmlspecialchars($r['name']) : '-'; ?></td>
                              <td><?php echo htmlspecialchars($row['nocSubject']); ?></td>
                              <td><?php echo isset($r1['type']) ? htmlspecialchars($r1['type']) : '-'; ?></td>
                              <td><?php echo htmlspecialchars($row['landDesc']); ?></td>
                              <td><?php echo htmlspecialchars($row['gatNo']); ?></td>
                              <td><?php echo htmlspecialchars($row['name']); ?></td>
                              <td><?php echo htmlspecialchars($row['mobileNo']); ?></td>
                              <td><?php echo htmlspecialchars($row['address']); ?></td>
                              <td><?php echo htmlspecialchars($row['aadharNo']); ?></td>
                              <td><?php echo htmlspecialchars($row['emailId']); ?></td>
                              <td><?php echo date('d-m-Y', strtotime($row['dob'])); ?></td>
                              <td>
                                <?php if ($row['panCard']) { ?>
                                  <a target="_blank"
                                    href="Uploads/<?php echo htmlspecialchars($row['panCard']); ?>">View</a>
                                <?php } else { ?>
                                  -
                                <?php } ?>
                              </td>
                              <td>
                                <?php if ($row['aadharCard']) { ?>
                                  <a target="_blank"
                                    href="Uploads/<?php echo htmlspecialchars($row['aadharCard']); ?>">View</a>
                                <?php } else { ?>
                                  -
                                <?php } ?>
                              </td>
                              <td><?php echo date('d-m-Y', strtotime($row['createdDateTime'])); ?></td>
                              <td>
                                <?php
                                $status = $row['status'];
                                $color = $status == 'Approved' ? 'text-success' : ($status == 'Rejected' ? 'text-danger' : 'text-warning');
                                ?>
                                <span class="<?php echo $color; ?>"><?php echo htmlspecialchars($status); ?></span>
                              </td>
                              <td style="white-space: nowrap;">
                                <div class="d-flex flex-wrap gap-1">
                                  <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#updateStatusModal<?php echo $row['applicationId']; ?>">
                                    Submit Report
                                  </button>
                                  <?php if (!isset($row['inspectionOfficer']) || trim($row['inspectionOfficer']) === ''): ?>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                      data-bs-target="#forwardNOCModal<?php echo $row['applicationId']; ?>"
                                      data-applicationid="<?php echo $row['applicationId']; ?>">
                                      Forward NOC
                                    </button>
                                  <?php else: ?>
                                  <?php endif; ?>
                                </div>
                                <!-- Change Status / Report Modal -->
                                <div class="modal fade" id="updateStatusModal<?= $row['applicationId']; ?>" tabindex="-1"
                                  aria-labelledby="updateStatusModalLabel<?= $row['applicationId']; ?>"
                                  aria-hidden="true">
                                  <div class="modal-dialog">
                                    <form method="POST" action="department/NOC_Report_employeeDB.php"
                                      enctype="multipart/form-data">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title"
                                            id="updateStatusModalLabel<?= $row['applicationId']; ?>">Submit Report</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">

                                          <input type="hidden" name="applicationId"
                                            value="<?= htmlspecialchars($row['applicationId']); ?>">
                                          <input type="hidden" name="departmentId"
                                            value="<?= htmlspecialchars($departmentId); ?>">
                                          <div class="mb-3">
                                            <label class="form-label">Report Remark (optional)</label>
                                            <textarea name="reportRemark" class="form-control" rows="2"
                                              placeholder="Enter report remark..."></textarea>
                                          </div>

                                          <div class="mb-3">
                                            <label class="form-label">Upload Report Files (optional)</label>
                                            <input type="file" name="reportFile[]" class="form-control reportFileInput"
                                              accept=".pdf,.jpg,.jpeg,.png" multiple>
                                            <div class="form-text">Allowed: PDF, JPG, PNG. Max each: 5MB.</div>
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="submit" name="update" class="btn btn-success">Submit</button>
                                        </div>
                                      </div>
                                    </form>
                                  </div>
                                </div>

                                <script>
                                  document.addEventListener('change', function (e) {
                                    if (!e.target.matches('.reportFileInput')) return;
                                    const input = e.target;
                                    const allowedExt = ['pdf', 'jpg', 'jpeg', 'png'];
                                    const maxSize = 5 * 1024 * 1024;
                                    const files = Array.from(input.files);
                                    const invalid = files.find(f => !allowedExt.includes(f.name.split('.').pop().toLowerCase()));
                                    if (invalid) {
                                      Swal.fire({
                                        icon: 'error',
                                        title: 'Invalid file type',
                                        text: `File "${invalid.name}" is not allowed.`,
                                        confirmButtonText: 'OK'
                                      });
                                      input.value = '';
                                      return;
                                    }
                                    const tooLarge = files.find(f => f.size > maxSize);
                                    if (tooLarge) {
                                      Swal.fire({
                                        icon: 'error',
                                        title: 'Too large',
                                        text: `File "${tooLarge.name}" exceeds 5MB.`,
                                        confirmButtonText: 'OK'
                                      });
                                      input.value = '';
                                    }
                                  });
                                </script>

                                <!-- Forward NOC Modal -->
                                <div class="modal fade" id="forwardNOCModal<?php echo $row['applicationId']; ?>"
                                  tabindex="-1" aria-labelledby="forwardNOCModalLabel<?php echo $row['applicationId']; ?>"
                                  aria-hidden="true">
                                  <div class="modal-dialog">
                                    <form method="POST" action="department/forwordNOC_db.php">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title"
                                            id="forwardNOCModalLabel<?php echo $row['applicationId']; ?>">Forward NOC</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                          <input type="hidden" name="applicationId"
                                            value="<?php echo $row['applicationId']; ?>">
                                          <input type="hidden" name="departmentId" value="<?php echo $departmentId; ?>">
                                          <div class="mb-3">
                                            <label for="employeeId" class="form-label">Forward to Employee</label>
                                            <select name="inspectionOfficer" class="form-select" required>
                                              <option value="">Select Employee</option>
                                              <?php
                                              $empStmt = $conn->prepare("
                                                  SELECT userId, name 
                                                  FROM users 
                                                  WHERE status = 'Active' 
                                                  AND designation NOT IN ('Tahsildar', 'SDO', 'Department')
                                              ");
                                              $empStmt->execute();
                                              $empResult = $empStmt->get_result();
                                              while ($emp = $empResult->fetch_assoc()) {
                                                echo '<option value="' . $emp['userId'] . '">' . htmlspecialchars($emp['name']) . '</option>';
                                              }
                                              ?>
                                            </select>
                                          </div>
                                          <div class="mb-3">
                                            <label for="remarks" class="form-label">Remark</label>
                                            <textarea name="HODremark" class="form-control" placeholder="Enter remark..."
                                              required></textarea>
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="submit" name="forwardNOC" class="btn btn-success">Submit</button>
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
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const allModals = document.querySelectorAll('[id^="updateStatusModal"]');
        allModals.forEach(modal => {
          modal.addEventListener('show.bs.modal', function () {
            const statusSelect = modal.querySelector('#statusSelect' + modal.id.replace('updateStatusModal', ''));
            const remarkDiv = modal.querySelector('#remarkDiv' + modal.id.replace('updateStatusModal', ''));
            if (statusSelect) {
              statusSelect.addEventListener('change', function () {
                remarkDiv.classList.toggle('d-none', this.value !== 'Rejected');
              });
            }
          });
        });

        const allForwardModals = document.querySelectorAll('[id^="forwardNOCModal"]');
        allForwardModals.forEach(modal => {
          modal.addEventListener('show.bs.modal', function () {
            const remarkTextarea = modal.querySelector('textarea[name="HODremark"]');
            if (remarkTextarea) remarkTextarea.value = '';
            const employeeSelect = modal.querySelector('select[name="inspectionOfficer"]');
            if (employeeSelect) employeeSelect.selectedIndex = 0;
          });
        });
      });
    </script>
    <?php include('../include/jsLinks.php'); ?>
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

      var KTDatatablesExample = function () {
        var table;
        var datatable;
        var initDatatable = function () {
          const tableRows = table.querySelectorAll('tbody tr');
          tableRows.forEach(row => {
            const dateRow = row.querySelectorAll('td');
            const realDate = moment(dateRow[15].innerHTML, "DD-MM-YYYY").format();
            dateRow[15].setAttribute('data-order', realDate);
          });
          datatable = $(table).DataTable({
            "info": false,
            'order': [],
            'pageLength': 10,
          });
        };
        var exportButtons = () => {
          const documentTitle = 'Customer Orders Report';
          var buttons = new $.fn.dataTable.Buttons(table, {
            buttons: [
              { extend: 'copyHtml5', title: documentTitle },
              { extend: 'excelHtml5', title: documentTitle },
              { extend: 'csvHtml5', title: documentTitle },
              { extend: 'pdfHtml5', title: documentTitle }
            ]
          }).container().appendTo($('#kt_datatable_example_buttons'));
          const exportButtons = document.querySelectorAll('#kt_datatable_example_export_menu [data-kt-export]');
          exportButtons.forEach(exportButton => {
            exportButton.addEventListener('click', e => {
              e.preventDefault();
              const exportValue = e.target.getAttribute('data-kt-export');
              const target = document.querySelector('.dt-buttons .buttons-' + exportValue);
              target.click();
            });
          });
        };
        var handleSearchDatatable = () => {
          const filterSearch = document.querySelector('[data-kt-filter="search"]');
          filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
          });
        };
        return {
          init: function () {
            table = document.querySelector('#kt_datatable_example');
            if (!table) return;
            initDatatable();
            exportButtons();
            handleSearchDatatable();
          }
        };
      }();
      KTUtil.onDOMContentLoaded(function () {
        KTDatatablesExample.init();
      });
    </script>
    <script>
      $("#kt_datepicker_1").flatpickr();
      $("#kt_datepicker_2").flatpickr();
    </script>
    <?php if (isset($_GET['status'])): ?>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script>
        <?php if ($_GET['status'] === 'success'): ?>
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'NOC forwarded successfully.',
            confirmButtonText: 'OK'
          });
        <?php elseif ($_GET['status'] === 'error'): ?>
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '<?php echo urldecode($_GET["msg"]); ?>',
            confirmButtonText: 'OK'
          });
        <?php endif; ?>
      </script>
    <?php endif; ?>
</body>
<!--end::Body-->

</html>
<?php
$con->close();
?>