<?php
session_start();
include('../include/conn.php');

if (isset($_POST['ChangeForward'])) {
  $SDO_final_status = mysqli_real_escape_string($conn, $_POST['SDO_final_status'] ?? '');
  $applicationId = mysqli_real_escape_string($conn, $_POST['applicationId'] ?? '');
  $SDO_final_remark = mysqli_real_escape_string($conn, $_POST['SDO_final_remark'] ?? '');

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
  $SDO_final_document = "";
  if ($SDO_final_status === 'Forwarded' && !empty($_FILES['SDO_final_document']['name'])) {
    $fileName = $_FILES['SDO_final_document']['name'];
    $fileTmp = $_FILES['SDO_final_document']['tmp_name'];
    $fileType = mime_content_type($fileTmp);
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (in_array($fileType, $allowedTypes) && in_array($fileExt, $allowedExtensions)) {
      $SDO_final_document = $uploadDir . time() . "SDO_final_document" . basename($fileName);
      if (!move_uploaded_file($fileTmp, $SDO_final_document)) {
        swal('error', 'File Upload Error', 'Failed to upload the file.', 'SDO_noc_civilian.php');
        exit;
      }
    } else {
      swal('warning', 'Invalid file type', 'Invalid file type. Only PDF, JPEG, JPG, PNG allowed.', 'SDO_noc_civilian.php');
      exit;
    }
  } elseif ($SDO_final_status === 'Forwarded' && empty($_FILES['SDO_final_status']['name'])) {
    swal('warning', 'Missing File', 'DSC Signed Document is required for forwarding.', 'SDO_noc_civilian.php');
    exit;
  }

  if ($applicationId && $SDO_final_status) {
    $sql = "
            UPDATE nocApplications 
            SET SDO_final_status = '$SDO_final_status', 
                finalTahildarRemark = '$finalTahildarRemark',
                finalTahildarFile = '$SDO_final_document' 
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