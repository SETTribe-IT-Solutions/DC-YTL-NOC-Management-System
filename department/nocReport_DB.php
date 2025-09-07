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

    $uploadDir = "../documents/"; // folder to store files

    // Allowed MIME types and extensions
    $allowedTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png'];
    $allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png'];

    // Final DSC Document
    if (!empty($_FILES['departmentReport']['name'])) {
        $departmentReportName = $_FILES['departmentReport']['name'];
        $departmentReportTmp = $_FILES['departmentReport']['tmp_name'];
        $departmentReportType = mime_content_type($departmentReportTmp);
        $departmentReportExt = strtolower(pathinfo($departmentReportName, PATHINFO_EXTENSION));

        if (in_array($departmentReportType, $allowedTypes) && in_array($departmentReportExt, $allowedExtensions)) {
            $departmentReportPath = $uploadDir . time() . "_departmentReport_" . basename($departmentReportName);
            move_uploaded_file($departmentReportTmp, $departmentReportPath);
        } else {
            $departmentReportPath = "";
            echo "
            <script>
            window.location = '../department/nocReport.php?status=error&msg=Invalid report file type. Only PDF, JPEG, JPG, PNG allowed.'
            </script>
            ";
            exit;
        }
    } else {
        $departmentReportPath = "";
    }
    $departmentReportPath;


    if ($applicationId && $status) {
        // ✅ Update nocApplications (check actual column names)
        // $updateNocApp = mysqli_query($conn, "
        //     UPDATE nocApplications 
        //     SET status = '$status'
        //     WHERE applicationId = '$applicationId'
        // ");



        // ✅ Update nocApplicationReviews (check column 'remarks' or 'remark')
        $updateReview = mysqli_query($conn, "
            UPDATE nocApplicationReviews 
            SET 
                status = '$status', 
                dscDocumentPath = '$departmentReportPath',
                reviewedDateTime = '$dateTime'
            WHERE applicationId = '$applicationId' AND departmentId = '$departmentId'
        ");

    }

    if ($updateReview) {
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
<?php
$con->close();
?>