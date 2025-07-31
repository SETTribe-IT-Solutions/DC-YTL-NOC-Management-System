<?php 
include('../include/conn.php');
if (isset($_POST['forwardNOC'])) {
    $applicationId = $_POST['applicationId'];
    $inspectionOfficer = $_POST['inspectionOfficer'];
    $HODremark = mysqli_real_escape_string($conn, $_POST['HODremark']);

    $query = "UPDATE nocApplications
              SET inspectionOfficer = '$inspectionOfficer', HODremark = '$HODremark'
              WHERE applicationId = '$applicationId'";

    if (mysqli_query($conn, $query)) {
        // ✅ Redirect with success status
        header("Location: ../department/nocReport.php?status=success");
        exit();
    } else {
        // ✅ Redirect with error status and error message
        $error = urlencode(mysqli_error($conn));
        header("Location: ../department/nocReport.php?status=error&msg=$error");
        exit();
    }
}
?>
