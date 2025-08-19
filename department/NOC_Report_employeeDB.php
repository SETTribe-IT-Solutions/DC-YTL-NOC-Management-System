<?php
session_start();
include('../include/conn.php');

if (isset($_POST['update'])) {
    $applicationId = mysqli_real_escape_string($conn, $_POST['applicationId'] ?? '');
    $reportRemark = mysqli_real_escape_string($conn, $_POST['reportRemark'] ?? '');

    $uploadDir = __DIR__ . '/reportDoc/'; // server path
    $webUploadDir = 'reportDoc/'; // for naming
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $uploadedFiles = [];

    if (!empty($_FILES['reportFile']['name'][0])) {
        foreach ($_FILES['reportFile']['name'] as $key => $name) {
            $tmpName = $_FILES['reportFile']['tmp_name'][$key];
            $safeName = basename($name);
            $fileName = time() . '_' . preg_replace('/[^A-Za-z0-9._-]/', '_', $safeName);
            $filePath = $uploadDir . $fileName;

            if (move_uploaded_file($tmpName, $filePath)) {
                $uploadedFiles[] = $fileName;
            }
        }
    }

    $reportFile = implode(' -Next file ', $uploadedFiles);

    // Helper to show SweetAlert and redirect/back
    function swal($icon, $title, $text, $redirect = null) {
        $redirect_js = $redirect
            ? "window.location.href = '".addslashes($redirect)."';"
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

    if ($applicationId && $reportFile) {
        $sql = "
            UPDATE nocApplications 
            SET reportFile = '{$reportFile}', reportRemark = '{$reportRemark}' 
            WHERE applicationId = '{$applicationId}'
        ";
        $update = mysqli_query($conn, $sql);

        if ($update) {
            swal('success', 'Success!', 'Files uploaded and record updated successfully.');
        } else {
            swal('error', 'Database Error', 'Database update failed.');
        }
    } else {
        swal('warning', 'Missing Data', 'No files uploaded or application ID missing.');
    }
}
?>
