<?php
session_start();
include('../include/conn.php');

if (isset($_POST['ChangeFinalStatus'])) {
  $final_status = "Approved";
  $applicationId = mysqli_real_escape_string($conn, $_POST['applicationId'] ?? '');
  $reportRemark = mysqli_real_escape_string($conn, $_POST['reportRemark'] ?? '');

  $uploadDir = "../documents/"; // folder to store files

  // Allowed MIME types and extensions
  $allowedTypes = ['application/pdf'];
  $allowedExtensions = ['pdf'];

  // Final DSC Document
  if (!empty($_FILES['final_dsc_document']['name'])) {
    $final_dsc_documentName = $_FILES['final_dsc_document']['name'];
    $final_dsc_documentTmp = $_FILES['final_dsc_document']['tmp_name'];
    $final_dsc_documentType = mime_content_type($final_dsc_documentTmp);
    $final_dsc_documentExt = strtolower(pathinfo($final_dsc_documentName, PATHINFO_EXTENSION));

    if (in_array($final_dsc_documentType, $allowedTypes) && in_array($final_dsc_documentExt, $allowedExtensions)) {
      $final_dsc_documentPath = $uploadDir . time() . "_final_dsc_document_" . basename($final_dsc_documentName);
      move_uploaded_file($final_dsc_documentTmp, $final_dsc_documentPath);
    } else {
      $final_dsc_documentPath = "";
      echo "Invalid PAN card file type. Only PDF allowed.";
    }
  } else {
    $final_dsc_documentPath = "";
  }




  // Helper to show SweetAlert and redirect/back
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

  if ($applicationId && $final_status) {
    $sql = "
            UPDATE nocApplications 
            SET final_status = '$final_status', final_dsc_document = '{$final_dsc_documentPath}'
            WHERE applicationId = '{$applicationId}'
        ";
    $update = mysqli_query($conn, $sql);

    if ($update) {
      swal('success', 'Success!', 'Noc updated successfully.', 'NocReport_FAuthFinal.php');
    } else {
      swal('error', 'Database Error', 'Database update failed.', 'NocReport_FAuthFinal.php');
    }
  } else {
    swal('warning', 'Missing Data', 'No Noc Updated or application ID missing.', 'NocReport_FAuthFinal.php');
  }
}



?>
<?php
$con->close();
?>