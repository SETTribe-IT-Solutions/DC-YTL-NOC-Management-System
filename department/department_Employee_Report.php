<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
session_start();
include('../include/conn.php');
$userId = $_SESSION['userId'];
 $departmentId = $_SESSION['departmentId'];
 
if (!isset($_SESSION['userId'])) {
   
    header("Location: ../index.html");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <base href="../">
    <title>NOC Portal</title>
    <meta charset="utf-8" />
    <meta name="description" content="Saul HTML Free - Bootstrap 5 HTML Multipurpose Admin Dashboard Theme" />
    <meta name="keywords" content="Saul, bootstrap, bootstrap 5, admin themes, free admin themes, bootstrap admin, bootstrap dashboard" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <style>
        #datatable th, #datatable td { border: 1px solid #F4F4F4; }
    </style>
    <?php include("../include/cssLinks.php"); ?>
</head>
<body id="kt_app_body" data-kt-app-header-fixed="true" data-kt-app-header-fixed-mobile="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" data-kt-app-aside-enabled="true" data-kt-app-aside-fixed="true" data-kt-app-aside-push-toolbar="true" data-kt-app-aside-push-footer="true" class="app-default">
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <?php include("../include/header.php"); ?>
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <?php include("../include/sidebar.php"); ?>
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <div class="d-flex flex-column flex-column-fluid">
                        <div id="kt_app_toolbar" class="app-toolbar pt-5">
                            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
                                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                                    <div class="page-title d-flex flex-column gap-1 me-3 mb-2">
                                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold mb-6">
                                            <li class="breadcrumb-item text-gray-700 fw-bold lh-1">
                                                <a href="department/department-dashboard.php" class="text-gray-500">
                                                    <i class="ki-duotone ki-home fs-3 text-gray-400 me-n1"></i>
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
                                            </li>
                                            <li class="breadcrumb-item text-gray-700 fw-bold lh-1">NOC अर्ज पहा (Department)</li>
                                        </ul>
                                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">NOC अर्ज पहा (Department)</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <div id="kt_app_content_container" class="app-container container-fluid">
                                <div class="row mb-3">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-rounded table-striped border gy-7 gs-7" id="datatable">
                                                <thead>
                                                    <tr class="text-start text-dark-900 fw-bold fs-6 text-uppercase">
                                                        <th class="min-w-70px">Sr. No.</th>
                                                        <th class="min-w-100px">NOC क्रमंक</th>
                                                        <th class="min-w-100px">NOC प्रकार</th>
                                                        <th class="min-w-100px">Department</th>
                                                        <th class="min-w-100px">विषय</th>
                                                        <th class="min-w-100px">जमिनीची माहेती</th>
                                                        <th class="min-w-100px">तालुका</th>
                                                        <th class="min-w-100px">गाव</th>
                                                        <th class="min-w-100px">गट विकास</th>
                                                        <th class="min-w-100px">संपर्क अधिकार्याचा मोबाईल क्रमंक</th>
                                                        <th class="min-w-100px">संपर्क अधिकार्याचा ईमेल ID</th>
                                                        <th class="min-w-100px">NOC प्रकार निवडा</th>
                                                        <th class="min-w-100px">स्थिती</th>
                                                        <th class="min-w-100px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="fw-semibold text-gray-600">
                                                    <?php
                                                    // echo "SELECT a.nocTypeId, a.departmentId, d.departmentName, a.applicationId, a.nocSubject,
                                                    //         a.landDesc, a.taluka, a.village, a.gatNo, a.mobileNo, a.emailId, a.status,
                                                    //         a.createdDateTime, a.inspectionOfficer
                                                    //     FROM departmentNocApplications a
                                                    //     INNER JOIN nocApplicationReviews r ON a.applicationId = r.applicationId
                                                    //     INNER JOIN departments d ON a.departmentId = d.id
                                                    //     WHERE a.inspectionOfficer = '$userId'    
                                                    //     ORDER BY a.createdDateTime DESC";
                                                    $stmt = $conn->prepare("
                                                        SELECT 
                                                            a.nocTypeId, a.departmentId, d.departmentName, a.applicationId, a.nocSubject,
                                                            a.landDesc, a.taluka, a.village, a.gatNo, a.mobileNo, a.emailId, a.status,
                                                            a.createdDateTime, a.inspectionOfficer
                                                        FROM departmentNocApplications a
                                                        INNER JOIN nocApplicationReviews r ON a.applicationId = r.applicationId
                                                        INNER JOIN departments d ON a.departmentId = d.id
                                                        WHERE a.inspectionOfficer = ?    
                                                        ORDER BY a.createdDateTime DESC
                                                    ");
                                                    $stmt->bind_param("s", $userId);
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();
                                                    $i = 1;
                                                    while ($row = $result->fetch_assoc()) {
                                                        $nocType = $row['nocTypeId'];
                                                        $q1 = $conn->prepare("SELECT type FROM nocTypes WHERE id = ?");
                                                        $q1->bind_param("i", $nocType);
                                                        $q1->execute();
                                                        $r1 = $q1->get_result()->fetch_assoc();
                                                    ?>
                                                        <tr>
                                                            <td><?= $i++ ?></td>
                                                            <td><?= htmlspecialchars($row['applicationId']) ?></td>
                                                            <td><?= isset($r1['type']) ? htmlspecialchars($r1['type']) : '-' ?></td>
                                                            <td><?= htmlspecialchars($row['departmentName']) ?></td>
                                                            <td><?= htmlspecialchars($row['nocSubject']) ?></td>
                                                            <td><?= htmlspecialchars($row['landDesc']) ?></td>
                                                            <td><?= htmlspecialchars($row['taluka']) ?></td>
                                                            <td><?= htmlspecialchars($row['village']) ?></td>
                                                            <td><?= htmlspecialchars($row['gatNo']) ?></td>
                                                            <td><?= htmlspecialchars($row['mobileNo']) ?></td>
                                                            <td><?= htmlspecialchars($row['emailId']) ?></td>
                                                            <td><?= htmlspecialchars($row['nocTypeId']) ?></td>
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
                                                            
                                                                <!-- Change Status Modal -->
                                                                  <!-- Change Status / Report Modal -->
<div class="modal fade" id="updateStatusModal<?= $row['applicationId']; ?>" tabindex="-1"
     aria-labelledby="updateStatusModalLabel<?= $row['applicationId']; ?>" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="department/department_Report_employeeDB.php" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateStatusModalLabel<?= $row['applicationId']; ?>">Submit Report</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          
<input type="hidden" name="applicationId" value="<?= htmlspecialchars($row['applicationId']); ?>">
          <input type="hidden" name="departmentId" value="<?= htmlspecialchars($departmentId); ?>">
          <div class="mb-3">
            <label class="form-label">Report Remark (optional)</label>
            <textarea name="reportRemark" class="form-control" rows="2" placeholder="Enter report remark..."></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Upload Report Files (optional)</label>
            <input type="file" name="reportFile[]" class="form-control reportFileInput" accept=".pdf,.jpg,.jpeg,.png" multiple>
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
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include('../include/footer.php'); ?>
                </div>
            </div>
        </div>
    </div>
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-duotone ki-arrow-up"><span class="path1"></span><span class="path2"></span></i>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('[id^="updateStatusModal"]').forEach(modal => {
                modal.addEventListener('show.bs.modal', function () {
                    const statusSelect = modal.querySelector('#statusSelect' + modal.id.replace('updateStatusModal', ''));
                    const remarkDiv = modal.querySelector('#remarkDiv' + modal.id.replace('updateStatusModal', ''));
                    statusSelect.addEventListener('change', function () {
                        remarkDiv.classList.toggle('d-none', this.value !== 'Rejected');
                    });
                });
            });
        });
    </script>
    <?php include('../include/jsLinks.php'); ?>
    <script>
        $("#datatable").DataTable({
            "scrollCollapse": true,
            "language": { "lengthMenu": "Show _MENU_" },
            "dom": "<'row mb-2'<'col-sm-6 d-flex align-items-center justify-conten-start dt-toolbar'l><'col-sm-6 d-flex align-items-center justify-content-end dt-toolbar'f>>" +
                   "<'table-responsive'tr>" +
                   "<'row'<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i><'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>>"
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
                Swal.fire({ icon: 'success', title: 'Success!', text: 'NOC forwarded successfully.', confirmButtonText: 'OK' });
            <?php elseif ($_GET['status'] === 'error'): ?>
                Swal.fire({ icon: 'error', title: 'Error!', text: '<?php echo urldecode($_GET["msg"]); ?>', confirmButtonText: 'OK' });
            <?php endif; ?>
        </script>
    <?php endif; ?>

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
</body>
</html>