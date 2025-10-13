<?php
session_start();
include('../include/conn.php');

if (isset($_POST['ChangeForward'])) {
  $finalTahildarStatus = mysqli_real_escape_string($conn, $_POST['finalTahildarStatus'] ?? '');
  $applicationId = mysqli_real_escape_string($conn, $_POST['applicationId'] ?? '');
  $finalTahildarRemark = mysqli_real_escape_string($conn, $_POST['finalTahildarRemark'] ?? '');

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

  // Final DSC Document (only for Forwarded)
  $finalTahildarFilePath = "";
  if ($finalTahildarStatus === 'Forwarded' && !empty($_FILES['finalTahildarFile']['name'])) {
    $fileName = $_FILES['finalTahildarFile']['name'];
    $fileTmp = $_FILES['finalTahildarFile']['tmp_name'];
    $fileType = mime_content_type($fileTmp);
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (in_array($fileType, $allowedTypes) && in_array($fileExt, $allowedExtensions)) {
      $finalTahildarFilePath = $uploadDir . time() . "_finalTahildarFile_" . basename($fileName);
      if (!move_uploaded_file($fileTmp, $finalTahildarFilePath)) {
        swal('error', 'File Upload Error', 'Failed to upload the file.', 'tashildar_noc_civilian.php');
        exit;
      }
    } else {
      swal('warning', 'Invalid file type', 'Invalid file type. Only PDF, JPEG, JPG, PNG allowed.', 'tashildar_noc_civilian.php');
      exit;
    }
  } elseif ($finalTahildarStatus === 'Forwarded' && empty($_FILES['finalTahildarFile']['name'])) {
    swal('warning', 'Missing File', 'DSC Signed Document is required for forwarding.', 'tashildar_noc_civilian.php');
    exit;
  }

  if ($applicationId && $finalTahildarStatus) {
    $sql = "
            UPDATE nocApplications 
            SET finalTahildarStatus = '$finalTahildarStatus', 
                finalTahildarRemark = '$finalTahildarRemark',
                finalTahildarFile = '$finalTahildarFilePath' 
            WHERE applicationId = '$applicationId'
        ";
    $update = mysqli_query($conn, $sql);

    if ($update) {
      swal('success', 'Success!', 'NOC updated successfully.', 'tashildar_noc_civilian.php');
    } else {
      swal('error', 'Database Error', 'Database update failed.', 'tashildar_noc_civilian.php');
    }
  } else {
    swal('warning', 'Missing Data', 'No NOC Updated or application ID missing.', 'tashildar_noc_civilian.php');
  }
}

$conn->close();
?>