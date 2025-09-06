<?php
include('../include/conn.php');

if (isset($_POST['forwardNOC'])) {
    $applicationId = mysqli_real_escape_string($conn, $_POST['applicationId']);
    $inspectionOfficer = mysqli_real_escape_string($conn, $_POST['inspectionOfficer']);
    $HODremark = mysqli_real_escape_string($conn, $_POST['HODremark']);

    // Step 1: Check if record exists
    $checkQuery = "SELECT inspectionOfficer FROM nocApplications WHERE applicationId = '$applicationId'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (!$checkResult || mysqli_num_rows($checkResult) == 0) {
        // No such application
        header("Location: ../department/nocReport.php?status=not_found");
        exit();
    }

    $row = mysqli_fetch_assoc($checkResult);

    // Step 2: If already forwarded
    if (!is_null($row['inspectionOfficer']) && trim($row['inspectionOfficer']) !== '') {
        header("Location: ../department/nocReport.php?status=already_forwarded");
        exit();
    }

    // Step 3: Update if not already forwarded
    $updateQuery = "UPDATE nocApplications 
                    SET inspectionOfficer = '$inspectionOfficer',
                        HODremark = '$HODremark'
                    WHERE applicationId = '$applicationId'";

    if (mysqli_query($conn, $updateQuery)) {
        header("Location: ../department/nocReport.php?status=success");
        exit();
    } else {
        $error = urlencode(mysqli_error($conn));
        header("Location: ../department/nocReport.php?status=error&msg=$error");
        exit();
    }
}
?>
<?php
$con->close();
?>