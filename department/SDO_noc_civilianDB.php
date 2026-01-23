<?php
session_start();
include('../include/conn.php');

if (!isset($_SESSION['userId'])) {
    header("Location: ../index.html");
    exit();
}

// SweetAlert helper function
function swal($icon, $title, $text, $redirect = null) {
    $redirect_js = $redirect ? "window.location.href = '" . addslashes($redirect) . "';" : "window.history.back();";
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

// Check if form submitted
if (isset($_POST['ChangeForward'])) {
    $SDO_final_status = trim($_POST['SDO_final_status'] ?? '');
    $applicationId = mysqli_real_escape_string($conn, $_POST['applicationId'] ?? '');
    $SDO_final_remark = mysqli_real_escape_string($conn, $_POST['SDO_final_remark'] ?? '');

    // Validate required fields
    if (empty($applicationId) || empty($SDO_final_status)) {
        swal('warning', 'Missing Data', 'Application ID or status missing.', '../department/SDO_noc_civilian.php');
    }

    // Handle file upload if Forwarded
    $SDO_final_document = null;
    if ($SDO_final_status == 'Forwarded') {
        if (isset($_FILES['SDO_final_document']) && is_uploaded_file($_FILES['SDO_final_document']['tmp_name']) && $_FILES['SDO_final_document']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = "../Uploads/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileTmpPath = $_FILES['SDO_final_document']['tmp_name'];
            $fileName = basename($_FILES['SDO_final_document']['name']);
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            // Allowed extensions (only PDF)
            $allowedExt = ['pdf'];
            if (!in_array($fileExt, $allowedExt)) {
                swal('error', 'Invalid File Type', 'Only PDF files are allowed.', '../department/SDO_noc_civilian.php');
            }

            // Unique filename
            $newFileName = "SDO_" . time() . "_" . uniqid() . "." . $fileExt;
            $destPath = $uploadDir . $newFileName;

            if (!move_uploaded_file($fileTmpPath, $destPath)) {
                swal('error', 'File Upload Failed', 'Failed to upload the file.', '../department/SDO_noc_civilian.php');
            }
            $SDO_final_document = $destPath; // Store full path for DB
        } else {
            swal('error', 'Missing File', 'Please upload the signed PDF document.', '../department/SDO_noc_civilian.php');
        }
    }

    // Update NOC application
    $fileQuery = $SDO_final_document ? ", SDO_final_document = '{$SDO_final_document}'" : "";
    $sql = "
        UPDATE nocApplications
        SET 
            SDO_final_status = '{$SDO_final_status}',
            SDO_final_remark = '{$SDO_final_remark}'
            {$fileQuery}
        WHERE applicationId = '{$applicationId}'
    ";

    $update = mysqli_query($conn, $sql);
    if ($update) {
        $msg = ucfirst($SDO_final_status); // Forwarded / Rejected
        swal('success', 'Success!', "NOC {$msg} successfully.", '../department/SDO_noc_civilian.php');
    } else {
        swal('error', 'Database Error', 'Database update failed.', '../department/SDO_noc_civilian.php');
    }
}

$conn->close();
?>