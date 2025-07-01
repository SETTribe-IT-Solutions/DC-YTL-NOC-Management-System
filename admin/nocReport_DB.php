<?php
include('../include/conn.php');

if (isset($_POST['update'])) {
  echo  $applicationId = $_POST['applicationId'];
    $status = $_POST['status'];
    $remark = isset($_POST['remark']) ? $_POST['remark'] : '';
    
    // If departmentId is not sent, default to 3
    $departmentId = isset($_POST['departmentId']) ? $_POST['departmentId'] : 2;

    $userId = 'userId_001';
   

    // ✅ Update nocApplications
    $updateNocApp = mysqli_query($conn, "
        UPDATE nocApplications 
        SET status = '$status', 
            updatedBy = '$userId', 
           
        WHERE applicationId = '$applicationId'
    ");

    // ✅ Update nocApplicationReviews
    $updateReview = mysqli_query($conn, "
        UPDATE nocApplicationReviews 
        SET status = '$status', 
            remark = '$remark', 
            reviewedBy = '$userId', 
        WHERE applicationId = '$applicationId' AND departmentId = '$departmentId'
    ");

    // ✅ Confirmation
    if ($updateNocApp && $updateReview) {
        echo "<script>
            alert('Status updated successfully.');
            window.location.href = '../nocReport.php';
        </script>";
    } else {
        echo "<script>
            alert('Something went wrong!');
            window.history.back();
        </script>";
    }
}
?>
