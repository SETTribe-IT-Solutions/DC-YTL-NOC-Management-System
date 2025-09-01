<?php
session_start();
include('../include/conn.php');

if (isset($_POST['ChangeFinalStatus'])) {
    $final_status = $_POST['init_status'];
    $applicationId = mysqli_real_escape_string($conn, $_POST['applicationId'] ?? '');
    $reportRemark = mysqli_real_escape_string($conn, $_POST['reportRemark'] ?? '');

    
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

    if ($applicationId && $final_status) {
        $sql = "
            UPDATE nocApplications 
            SET final_status = '$final_status', final_remark = '{$reportRemark}' 
            WHERE applicationId = '{$applicationId}'
        ";
        $update = mysqli_query($conn, $sql);

        if ($update) {
            swal('success', 'Success!', 'Noc updated successfully.');
        } else {
            swal('error', 'Database Error', 'Database update failed.');
        }
    } else {
        swal('warning', 'Missing Data', 'No Noc Updated or application ID missing.');
    }
}



?>
