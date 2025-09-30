<?php
session_start();
include('../include/conn.php');

if (isset($_POST['ChangeFinalStatus'])) {
  $init_status = $_POST['init_status'];
  $applicationId = mysqli_real_escape_string($conn, $_POST['applicationId'] ?? '');
  $reportRemark = mysqli_real_escape_string($conn, $_POST['reportRemark'] ?? '');

  $uploadDir = "../documents/"; // folder to store files

  // Allowed MIME types and extensions
  $allowedTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png'];
  $allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png'];

  function swal($icon, $title, $text, $redirect = null)
  {
    $redirect_js = $redirect
      ? "window.location.href = '" . addslashes($redirect) . "';"
      : "window.history.back();";
    echo <<<HTML
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Result</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<script>
  Swal.fire({
    icon: '{$icon}',
    title: '{$title}',
    text: '{$text}',
    allowOutsideClick: false
  }).then(() => {
    {$redirect_js}
  });
</script>
</body>
</html>
HTML;
    exit;
  }

  // Final DSC Document
  if (!empty($_FILES['reportFile']['name'])) {
    $reportFileName = $_FILES['reportFile']['name'];
    $reportFileTmp = $_FILES['reportFile']['tmp_name'];
    $reportFileType = mime_content_type($reportFileTmp);
    $reportFileExt = strtolower(pathinfo($reportFileName, PATHINFO_EXTENSION));

    if (in_array($reportFileType, $allowedTypes) && in_array($reportFileExt, $allowedExtensions)) {
      $reportFilePath = $uploadDir . time() . "_reportFile_" . basename($reportFileName);
      move_uploaded_file($reportFileTmp, $reportFilePath);
    } else {
      $reportFilePath = "";
      echo "";
      swal('warning', 'Invalid file type', 'Invalid report file type. Only PDF, JPEG, JPG, PNG allowed.', 'NocReport_FAuth.php');
      exit;
    }
  } else {
    $reportFilePath = "";
  }


  // Helper to show SweetAlert and redirect/back


  if ($applicationId && $init_status) {
    $sql = "
            UPDATE nocApplications 
            SET init_status = '$init_status', initReportFile = '$reportFilePath', init_remark = '{$reportRemark}' 
            WHERE applicationId = '{$applicationId}'
        ";
    $update = mysqli_query($conn, $sql);

    if ($update) {
      swal('success', 'Success!', 'Noc updated successfully.', 'NocReport_FAuth.php');
    } else {
      swal('error', 'Database Error', 'Database update failed.', 'NocReport_FAuth.php');
    }
  } else {
    swal('warning', 'Missing Data', 'No Noc Updated or application ID missing.', 'NocReport_FAuth.php');
  }
}



$con->close();
?>