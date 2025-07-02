<?php
// session_start();
echo 'sdfjsdlf';
include('../include/conn.php'); 
include('../include/sweetAlert.php'); 
date_default_timezone_set('Asia/Kolkata');

if(isset($_POST['submit'])) {



$nocType = $_POST['nocType'];



$emailId = $_POST['emailId'];
$mobileNumber = $_POST['mobileNumber'];
$jaminichaTapshil = $_POST['jaminichaTapshil'];
$vishay = $_POST['vishay'];
$taluka = $_POST['taluka'];
$village = $_POST['village'];
$gatVibhag = $_POST['gatVibhag'];
$department = "2";
$userId = "userId_001";
$createdDate = date('Y-m-d H:i:s');



mysqli_autocommit($conn, false);

// Step 1: Get the latest applicationId
$queryGet = mysqli_query($conn, "SELECT COUNT(*) as applicationId FROM `nocApplicationIds` ") or die($conn->error);
$fetchGet = mysqli_fetch_assoc($queryGet);
$count = $fetchGet['applicationId'] + 1;
$formatted_count = sprintf('%03d', $count);

$applicationId = "NOC-2025-"."".$formatted_count;


$insertIdLog = mysqli_query($conn, "INSERT INTO nocApplicationIds (applicationId, type) VALUES ('$applicationId', 'Department')") or die($conn->error);

$queryReview = mysqli_query($conn,"SELECT departmentId FROM nocTypes WHERE id='$nocType'");
$fetchReview = mysqli_fetch_assoc($queryReview);
$depts = $fetchReview['departmentId'];

$departments = explode(',', $depts);
foreach ($departments as $departmentId) {
    // Insert into nocApplicationReviews
$query1 = $conn->prepare("INSERT INTO nocApplicationReviews (applicationId, departmentId, createdDateTime) VALUES (?, ?, ?)");

$query1->bind_param("sss", $applicationId, $departmentId, $createdDate); // assuming both are strings; use "ii" if integers

if ($query1->execute()) {
} else {
}
    $query1->close();
}


// Step 2: Insert into departmentNocApplications
$query = mysqli_query($conn, "INSERT INTO `departmentNocApplications` (
    `applicationId`, `departmentId`, `nocSubject`, `landDesc`, `taluka`, `village`, `gatNo`, `mobileNo`, `emailId`, `nocTypeId`,`userId`, `createdDateTime`
) VALUES (
    '$applicationId', '$department', '$vishay', '$jaminichaTapshil', '$taluka', '$village', '$gatVibhag', 
    '$mobileNumber', '$emailId', '$nocType','$userId', '$createdDate'
)") or die($conn->error);

$insert = mysqli_query($conn, "INSERT INTO `nocApplicationReviews`(`applicationId`, `departmentId`,`createdDateTime`) VALUES ('$applicationId','$department','$createdDate')") or die($conn->error);


// Step 3: Insert into nocApplicationIds (log the generated application ID)


// Step 4: Commit transaction if all queries succeeded
if ($query && $insertIdLog) {
    mysqli_commit($conn);
       $_SESSION['status'] = true;
            $_SESSION['msg'] = "Application Inserted Successfully";
            header('location:nocApplicationDept.php');
} else {
    mysqli_rollback($conn);
      $_SESSION['status'] = false;
            $_SESSION['msg'] = "Application Not Inserted";
            header('location:nocApplicationDept.php');
}

// End transaction
mysqli_autocommit($conn, true);

}


?>