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
$userId = $_SESSION['userId'];
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
        #datatable th { border: 1px solid #F4F4F4; }
        #datatable td { border: 1px solid #F4F4F4; }
    </style>
    <?php include("../include/cssLinks.php"); ?>
</head>
<body id="kt_app_body" data-kt-app-header-fixed="true" data-kt-app-header-fixed-mobile="true"
      data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
      data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true"
      data-kt-app-aside-enabled="true" data-kt-app-aside-fixed="true" data-kt-app-aside-push-toolbar="true"
      data-kt-app-aside-push-footer="true" class="app-default">
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
                                            <a href="../dist/index.html" class="text-gray-500">
                                                <i class="ki-duotone ki-home fs-3 text-gray-400 me-n1"></i>
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
                                        </li>
                                        <li class="breadcrumb-item text-gray-700 fw-bold lh-1">Final Approval (Civilian)</li>
                                    </ul>
                                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">
                                        Final Approval (Civilian)</h1>
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
                                                $stmt = $conn->prepare("SELECT * FROM nocApplications ORDER BY createdDateTime DESC");
                                                $stmt->execute();
                                                $result = $stmt->get_result();
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
                                                                <a target="_blank" href="Uploads/<?php echo htmlspecialchars($row['panCard']); ?>">View</a>
                                                            <?php } else { ?>
                                                                -
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($row['aadharCard']) { ?>
                                                                <a target="_blank" href="Uploads/<?php echo htmlspecialchars($row['aadharCard']); ?>">View</a>
                                                            <?php } else { ?>
                                                                -
                                                            <?php } ?>
                                                        </td>
                                                        <td><?php echo date('d-m-Y', strtotime($row['createdDateTime'])); ?></td>
                                                        <td>
                                                            <?php
                                                            if (!isset($row['SDO_final_status']) || trim($row['SDO_final_status']) == '') {
                                                                $status = $row['status'];
                                                                $color = $status == 'Approved' ? 'text-success' : ($status == 'Rejected' ? 'text-danger' : 'text-warning');
                                                                ?>
                                                                <span class="<?php echo $color; ?>"><?php echo htmlspecialchars($status); ?></span>
                                                                <?php
                                                            } else {
                                                                $statusinit_status = $row['SDO_final_status'];
                                                                $color = $statusinit_status == 'Approved' ? 'text-success' : ($statusinit_status == 'Rejected' ? 'text-danger' : 'text-warning');
                                                                ?>
                                                                <span class="<?php echo $color; ?>"><?php echo htmlspecialchars($statusinit_status); ?></span>
                                                                <?php if (!empty($row['SDO_final_document'])) { ?>
                                                                    <span>(<a href="<?php echo str_replace("../", "", $row['SDO_final_document']); ?>">View Document</a>)</span>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </td>
                                                        <td style="white-space: nowrap;">
                                                            <div class="d-flex flex-wrap gap-1">
                                                                <?php
                                                                $sdoStatus = strtolower(trim($row['SDO_final_status'] ?? ''));
                                                                if ($sdoStatus == '') {
                                                                    ?>
                                                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#updateStatusModal<?php echo $row['applicationId']; ?>">
                                                                        Forward
                                                                    </button>
                                                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectNOCModal<?php echo $row['applicationId']; ?>">
                                                                        Reject
                                                                    </button>
                                                                    <?php
                                                                } elseif ($sdoStatus == 'forwarded') {
                                                                    echo '<span class="badge bg-success">Forwarded</span>';
                                                                } elseif ($sdoStatus == 'rejected') {
                                                                    echo '<span class="badge bg-danger">Rejected</span>';
                                                                } else {
                                                                    echo '<span class="badge bg-warning text-dark">' . htmlspecialchars($row['SDO_final_status']) . '</span>';
                                                                }
                                                                ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <!-- Forward Modal -->
                                                    <div class="modal fade" id="updateStatusModal<?= $row['applicationId']; ?>" tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <form method="POST" action="department/SDO_noc_civilianDB.php" enctype="multipart/form-data">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-warning">
                                                                        <h5 class="modal-title">Forward NOC</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="applicationId" value="<?= $row['applicationId']; ?>">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Remark</label>
                                                                            <textarea name="SDO_final_remark" class="form-control" rows="2" placeholder="Enter your remark..."></textarea>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label">NOC DSC Signed Document <span class="text-danger">*</span></label>
                                                                            <input type="file" required name="SDO_final_document" class="form-control" accept=".pdf">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <input type="hidden" name="SDO_final_status" value="Forwarded">
                                                                        <button type="submit" name="ChangeForward" class="btn btn-warning">Forward</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- Reject Modal -->
                                                    <div class="modal fade" id="rejectNOCModal<?php echo $row['applicationId']; ?>" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <form method="POST" action="department/SDO_noc_civilianDB.php">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-danger text-white">
                                                                        <h5 class="modal-title">Reject Application</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="applicationId" value="<?php echo $row['applicationId']; ?>">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Remark</label>
                                                                            <textarea name="SDO_final_remark" class="form-control" rows="3" placeholder="Enter rejection reason" required></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <input type="hidden" name="SDO_final_status" value="Rejected">
                                                                        <button type="submit" name="ChangeForward" class="btn btn-danger">Reject</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </tbody>
                                        </table>
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
        <i class="ki-duotone ki-arrow-up">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </div>
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
        });
    </script>
    <?php include('../include/jsLinks.php'); ?>
    <script>
        $("#datatable").DataTable({
            "scrollCollapse": true,
            "language": { "lengthMenu": "Show _MENU_" },
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
</html>
<?php
$conn->close();
?>