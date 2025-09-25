<?php
session_start();
include('../include/conn.php');

if (isset($_POST['ChangeFinalStatus'])) {
  $init_status_thasildar = $_POST['init_status_thasildar'];
  $applicationId = mysqli_real_escape_string($conn, $_POST['applicationId'] ?? '');
  $reportRemark = mysqli_real_escape_string($conn, $_POST['reportRemark'] ?? '');


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

  if ($applicationId && $init_status_thasildar) {
    $sql = "
            UPDATE departmentNocApplications
            SET init_status_thasildar = '$init_status_thasildar', init_remark_tahsildar = '{$reportRemark}' 
            WHERE applicationId = '{$applicationId}'
        ";
    $update = mysqli_query($conn, $sql);
    if ($update) {
      echo "
    <!DOCTYPE html>
    <html>
    <head>
      <meta charset='utf-8'>
      <title>Success</title>
      <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
    <script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: 'Noc updated successfully.',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'department_Employee_ReportFAuth.php';
        }
    });
    </script>
    </body>
    </html>
    ";
    } else {
      echo "
    <!DOCTYPE html>
    <html>
    <head>
      <meta charset='utf-8'>
      <title>Error</title>
      <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
    <script>
    Swal.fire({
        icon: 'error',
        title: 'Database Error',
        text: 'Database update failed.'
    }).then(() => {
        window.history.back();
    });
    </script>
    </body>
    </html>
    ";
    }


  }

}

?>
<?php
$con->close();
?>