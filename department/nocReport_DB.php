<?php
session_start();
include('../include/conn.php');

if (isset($_POST['update'])) {
    $applicationId = $_POST['applicationId'] ?? '';
    $status = $_POST['status'] ?? '';
    $remarks = $_POST['remarks'] ?? '';
    $departmentId = $_POST['departmentId'];
    $applicationId = $_POST['applicationId'];  // Default 2
    $userId = $_SESSION['userId'];
    $dateTime = date('Y-m-d H:i:s');


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
                reviewedBy = '$userId',
                reviewedDateTime = '$dateTime'
            WHERE applicationId = '$applicationId' AND departmentId = '$departmentId'
        ");

    }

    if ($updateNocApp && $updateReview) {
        echo "
    <!DOCTYPE html>
    <html>
    <head>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
        <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Status updated successfully.',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '../department/nocReport.php';
        });
        </script>
    </body>
    </html>
    ";
        exit;
    } else {
        echo "
    <!DOCTYPE html>
    <html>
    <head>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Something went wrong during update.',
            confirmButtonText: 'Back'
        }).then(() => {
            window.history.back();
        });
        </script>
    </body>
    </html>";
        exit;
    }
} else {
    echo "
    <!DOCTYPE html>
    <html>
    <head>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
        <script>
        Swal.fire({
            icon: 'warning',
            title: 'Missing Data!',
            text: 'applicationId or status is missing.',
            confirmButtonText: 'Back'
        }).then(() => {
            window.history.back();
        });
        </script>
    </body>
    </html>";
    exit;
}



?>