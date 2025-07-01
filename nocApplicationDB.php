<?php
// session_start();
include('include/conn.php');
    include('include/sweetAlert.php');
// Step 1: Collect data from POST
$applicationType = $_POST['applicationType'];
$nocNumber     = $_POST['nocNumber'];
$nocType       = $_POST['nocType'];
$dob           = $_POST['dob'];
$fullName      = $_POST['fullName'];
$aadharNo      = $_POST['aadharNo'];
$address       = $_POST['address'];
$email         = $_POST['email'];
$mobileNo      = $_POST['mobileNo'];
$landDesc      = $_POST['landDesc'];
$nocSubject    = $_POST['nocSubject'];
$taluka        = $_POST['taluka'];
$village       = $_POST['village'];
// $departmentId  = $_POST['departmentId'];
$gatNo         = $_POST['gatNo'];
$status        = $_POST['status'] ?? 'Pending'; // default status
$createdDateTime = date("Y-m-d H:i:s");
// $updateDateTime  = date("Y-m-d H:i:s");
$civilianId        = $_SESSION['userId'];
// die();
$uploadDir = "documents/"; // folder to store files

// PAN Card
if (!empty($_FILES['panCard']['name'])) {
    $panCardName = $_FILES['panCard']['name'];
    $panCardTmp = $_FILES['panCard']['tmp_name'];
    $panCardPath = $uploadDir . time() . "_pan_" . basename($panCardName);
    move_uploaded_file($panCardTmp, $panCardPath) ;

} else {
    $panCardPath = ""; // or handle as required
}
// Aadhar Card
if (!empty($_FILES['aadharCard']['name'])) {
    $aadharCardName = $_FILES['aadharCard']['name'];
    $aadharCardTmp = $_FILES['aadharCard']['tmp_name'];
    $aadharCardPath = $uploadDir . time() . "_aadhar_" . basename($aadharCardName);
    move_uploaded_file($aadharCardTmp, $aadharCardPath);
} else {
    $aadharCardPath = ""; // or handle as required
}


$query_applicationId = mysqli_query($conn,"SELECT id FROM nocApplicationIds");
$fetchRows = mysqli_num_rows($query_applicationId);
$applicationId = "NOC-".date('Y')."-".$fetchRows;

$insert_applicationId = mysqli_query($conn,"INSERT INTO nocApplicationIds (applicationId,type) VALUES('$applicationId','Civilian')");

$queryReview = mysqli_query($conn,"SELECT departmentId FROM nocTypes WHERE id='$nocType'");
$fetchReview = mysqli_fetch_assoc($queryReview);
$depts = $fetchReview['departmentId'];

$departments = explode(',', $depts);
foreach ($departments as $departmentId) {
    // Insert into nocApplicationReviews
$query = $conn->prepare("INSERT INTO nocApplicationReviews (applicationId, departmentId, createdDateTime) VALUES (?, ?, ?)");

$query->bind_param("sss", $applicationId, $departmentId, $createdDateTime); // assuming both are strings; use "ii" if integers

if ($query->execute()) {
} else {
}
    $query->close();
}

// Step 2: Prepare the statement
$stmt = $conn->prepare("INSERT INTO nocApplications (
    applicationId, civilianId, nocNumber, nocSubject, nocTypeId, landDesc, taluka, village, gatNo, panCard, aadharCard, status, createdDateTime, updateDateTime, userId
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Step 3: Bind parameters
$stmt->bind_param("sssssssssssssss", 
    $applicationId, $civilianId, $nocNumber, $nocSubject, $nocType, $landDesc, $taluka, $village, $gatNo, $panCardPath, $aadharCardPath, $status, $createdDateTime, $updateDateTime, $userId
);

// Step 4: Execute and check
if ($stmt->execute()) {
     $_SESSION['status'] = true;
        $_SESSION['msg'] = "Application Submeitted successfully";
        header('location:nocApplication.php');
} else {
    $_SESSION['status'] = false;
        $_SESSION['msg'] = "Something went wrong";
        //  echo "Error: " . $stmt->error;
        header('location:nocApplication.php');
}

header('location:nocApplication.php');
$stmt->close();

?>
