<?php
include('../include/conn.php');

if (isset($_POST['update'])) {
    $applicationId = $_POST['applicationId'] ?? '';
    $status = $_POST['status'] ?? '';
    $remarks = $_POST['remarks'] ?? '';
    $departmentId = $_POST['departmentId'] ?? 3;
    $applicationId = $_POST['applicationId'];  // Default 2
    $userId = 'userId_001';
   
    if ($applicationId && $status) {
        // ✅ Update nocApplications (check actual column names)
        $updateNocApp = mysqli_query($conn, "
            UPDATE nocApplications 
            SET status = '$status', 
                userId  = '$userId'
            WHERE applicationId = '$applicationId'
        ");



        // ✅ Update nocApplicationReviews (check column 'remarks' or 'remark')
        $updateReview = mysqli_query($conn, "
            UPDATE nocApplicationReviews 
            SET status = '$status', 
                remarks = '$remarks', 
                reviewedBy = '$userId'
            WHERE applicationId = '$applicationId' AND departmentId = '$departmentId'
        ");
        
      
    }
   
        
        if ($updateNocApp && $updateReview) {
            echo "<script>
                alert('Status updated successfully.');
                window.location.href = '../admin/nocReport.php';
            </script>";
        } else {
            echo "<script>
                alert('Something went wrong during update!');
                window.history.back();
            </script>";
        }
    } else {
        echo "<script>
            alert('Missing applicationId or status!');
            window.history.back();
        </script>";
    }
    

?>
