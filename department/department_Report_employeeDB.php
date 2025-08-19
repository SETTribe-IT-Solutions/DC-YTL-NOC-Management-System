<?php
session_start();
include('../include/conn.php');

if (isset($_POST['update'])) {
    $applicationId = mysqli_real_escape_string($conn, $_POST['applicationId'] ?? '');
    $reportRemark = mysqli_real_escape_string($conn, $_POST['reportRemark'] ?? '');

    $uploadDir = __DIR__ . '/reportDoc/'; // absolute path
    $webUploadDir = 'reportDoc/'; // for storing in DB/URL

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

    $reportFile = implode(' -Next file, ', $uploadedFiles);

    // Helper to output SweetAlert and redirect/back
    function swal_and_exit($icon, $title, $text, $redirect = null) {
        $redirect_js = '';
        if ($redirect) {
            $redirect_js = "window.location.href = '".addslashes($redirect)."';";
        } else {
            $redirect_js = "window.history.back();";
        }

        echo <<<HTML
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Processing...</title>
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
        // Using escaped values; for stronger safety switch to prepared statements.
        $sql = "
            UPDATE departmentNocApplications 
            SET reportFile = '{$reportFile}', reportRemark = '{$reportRemark}' 
            WHERE applicationId = '{$applicationId}'
        ";
        $update = mysqli_query($conn, $sql);

        if ($update) {
            swal_and_exit('success', 'Success!', 'Files uploaded and record updated successfully.');
        } else {
            // Optionally include mysqli_error($conn) during dev
            swal_and_exit('error', 'Database Error', 'Database update failed.');
        }
    } else {
        swal_and_exit('warning', 'No Files', 'No files were uploaded or application ID missing.');
    }
}
?>
