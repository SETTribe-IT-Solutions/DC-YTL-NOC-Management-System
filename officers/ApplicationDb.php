<?php
session_start();
include('../include/conn.php');
include('../include/sweetAlert.php');
date_default_timezone_set('Asia/Kolkata');

if (isset($_POST['submit'])) {

    // ---------------- FORM DATA ----------------
    $nocType          = $_POST['nocType'];
    $emailId          = $_POST['emailId'];
    $mobileNumber     = $_POST['mobileNumber'];
    $jaminichaTapshil = $_POST['jaminichaTapshil'];
    $vishay           = $_POST['vishay'];
    $taluka           = $_POST['taluka'];
    $village          = $_POST['village'];
    $gatVibhag        = $_POST['gatVibhag'];

    $department  = "2";
    $userId      = "userId_001";
    $createdDate = date('Y-m-d H:i:s');

    // ---------------- FILE UPLOAD ----------------
   $noc_file = NULL;

if (isset($_FILES['noc_file'])) {

    // ---------- FILE DATA ----------
    $fileName = $_FILES['noc_file']['name'];
    $fileTmp  = $_FILES['noc_file']['tmp_name'];
    $fileSize = $_FILES['noc_file']['size'];
    $fileError= $_FILES['noc_file']['error'];
    $fileType = $_FILES['noc_file']['type'];

    // ---------- CHECK ERROR ----------
    if ($fileError != 0) {
        $_SESSION['status'] = false;
        $_SESSION['msg'] = "File select केलेली नाही";
        header("Location:nocApplicationDept.php");
        exit;
    }

    // ---------- EXTENSION VALIDATION ----------
    $allowedExt = ['jpg','jpeg','png','pdf'];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (!in_array($fileExt, $allowedExt)) {
        $_SESSION['status'] = false;
        $_SESSION['msg'] = "Only JPG, PNG, PDF files allowed";
        header("Location:nocApplicationDept.php");
        exit;
    }

    // ---------- MIME TYPE VALIDATION ----------
    $allowedMime = [
        'image/jpeg',
        'image/png',
        'application/pdf'
    ];

    if (!in_array($fileType, $allowedMime)) {
        $_SESSION['status'] = false;
        $_SESSION['msg'] = "Invalid file format";
        header("Location:nocApplicationDept.php");
        exit;
    }

    // ---------- SIZE VALIDATION (2MB) ----------
    if ($fileSize > 2 * 1024 * 1024) {
        $_SESSION['status'] = false;
        $_SESSION['msg'] = "File size must be less than 2MB";
        header("Location:nocApplicationDept.php");
        exit;
    }

    // ---------- UPLOAD FOLDER ----------
    $uploadDir = "../uploads/noc/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // ---------- NEW FILE NAME ----------
    $newFileName = "NOC_" . date("YmdHis") . "_" . rand(1000,9999) . "." . $fileExt;
    $uploadPath = $uploadDir . $newFileName;

    // ---------- MOVE FILE ----------
    if (move_uploaded_file($fileTmp, $uploadPath)) {
        $noc_file = $newFileName;   // DB मध्ये save करायला
    } else {
        $_SESSION['status'] = false;
        $_SESSION['msg'] = "File upload failed";
        header("Location:nocApplicationDept.php");
        exit;
    }

}


    // ---------------- TRANSACTION START ----------------
    mysqli_autocommit($conn, false);

    // Step 1: Generate Application ID
    $queryGet = mysqli_query($conn, "SELECT COUNT(*) AS total FROM nocApplicationIds") or die($conn->error);
    $fetchGet = mysqli_fetch_assoc($queryGet);
    $count = $fetchGet['total'] + 1;
    $formatted_count = sprintf('%03d', $count);

    $applicationId = "NOC-2025-" . $formatted_count;

    $insertIdLog = mysqli_query($conn, "
        INSERT INTO nocApplicationIds (applicationId, type)
        VALUES ('$applicationId', 'Department')
    ") or die($conn->error);

    // Step 2: Insert review departments
    $queryReview = mysqli_query($conn, "SELECT departmentId FROM nocTypes WHERE id='$nocType'");
    $fetchReview = mysqli_fetch_assoc($queryReview);
    $departments = explode(',', $fetchReview['departmentId']);

    foreach ($departments as $departmentId) {
        $stmt = $conn->prepare("
            INSERT INTO nocApplicationReviews
            (applicationId, departmentId, createdDateTime)
            VALUES (?, ?, ?)
        ");
        $stmt->bind_param("sss", $applicationId, $departmentId, $createdDate);
        $stmt->execute();
        $stmt->close();
    }

    // Step 3: Insert main application (noc_file column)
    $query = mysqli_query($conn, "
        INSERT INTO departmentNocApplications (
            applicationId,
            departmentId,
            nocSubject,
            landDesc,
            taluka,
            village,
            gatNo,
            mobileNo,
            emailId,
            nocTypeId,
            userId,
            noc_file,
            createdDateTime
        ) VALUES (
            '$applicationId',
            '$department',
            '$vishay',
            '$jaminichaTapshil',
            '$taluka',
            '$village',
            '$gatVibhag',
            '$mobileNumber',
            '$emailId',
            '$nocType',
            '$userId',
            '$noc_file',
            '$createdDate'
        )
    ") or die($conn->error);

    // ---------------- COMMIT / ROLLBACK ----------------
    if ($query && $insertIdLog) {
        mysqli_commit($conn);
        $_SESSION['status'] = true;
        $_SESSION['msg'] = "Application Submitted Successfully";
    } else {
        mysqli_rollback($conn);
        $_SESSION['status'] = false;
        $_SESSION['msg'] = "Application Not Inserted";
    }

    mysqli_autocommit($conn, true);
    header("Location:nocApplicationDept.php");
    exit;
}
?>
