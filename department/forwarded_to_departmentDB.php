<?php
session_start();
include('../include/conn.php');

if (isset($_POST['ChangeForward'])) {
    $init_status   = trim($_POST['init_status'] ?? '');
    $applicationId = mysqli_real_escape_string($conn, $_POST['applicationId'] ?? '');
    $tahildarRemark = mysqli_real_escape_string($conn, $_POST['tahildarRemark'] ?? '');

    // File Upload Handle
    $tahildarFileName = '';
    if (
        isset($_FILES['tahildarFile']) && 
        is_uploaded_file($_FILES['tahildarFile']['tmp_name']) && 
        $_FILES['tahildarFile']['error'] === UPLOAD_ERR_OK
    ) {
        $uploadDir = "../documents/"; // folder path
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // agar folder nahi hai to bana lo
        }

        $fileTmpPath = $_FILES['tahildarFile']['tmp_name'];
        $fileName    = basename($_FILES['tahildarFile']['name']);
        $fileExt     = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Allowed extensions (sirf PDF)
        $allowedExt = ['pdf'];
        if (in_array($fileExt, $allowedExt)) {
            // unique filename banane ke liye
            $newFileName = "tahildar_" . time() . "_" . uniqid() . "." . $fileExt;
            $destPath = $uploadDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $tahildarFileName = $newFileName; // DB me save karne ke liye
            }
        }
    }

    // SweetAlert helper
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

    if ($applicationId && $init_status) {
        // File part conditionally set
        $fileQuery = $tahildarFileName ? ", tahildarFile = '{$tahildarFileName}'" : "";
<<<<<<< HEAD
=======


        echo "
            UPDATE nocApplications
            SET 
              
                tahildarStatus = '{$init_status}',
                tahildarRemark = '{$tahildarRemark}'
                {$fileQuery}
            WHERE applicationId = '{$applicationId}'
        ";
>>>>>>> cfc37a2f35c40df462da9b774ac5b26988bba5ea
        $sql = "
            UPDATE nocApplications
            SET 
               
                tahildarStatus = '{$init_status}',
                tahildarRemark = '{$tahildarRemark}'
                {$fileQuery}
            WHERE applicationId = '{$applicationId}'
        ";

        $update = mysqli_query($conn, $sql);
        if ($update) {
            $msg = ucfirst($init_status); // Forwarded / Rejected
            swal('success', 'Success!', "NOC {$msg} successfully.", 'forworded_to_department.php');
        } else {
            swal('error', 'Database Error', 'Database update failed.');
        }
    } else {
        swal('warning', 'Missing Data', 'Application ID or status missing.');
    }
}

$conn->close();
?>
