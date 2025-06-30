<?php
// session_start();
include('include/conn.php');
    include('include/sweetAlert.php');
// Step 1: Collect data from POST
$applicationId        = "NOC_002";
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
} else {
    $panCardPath = ""; // or handle as required
}
// Aadhar Card
if (!empty($_FILES['aadharCard']['name'])) {
    $aadharCardName = $_FILES['aadharCard']['name'];
    $aadharCardTmp = $_FILES['aadharCard']['tmp_name'];
    $aadharCardPath = $uploadDir . time() . "_aadhar_" . basename($aadharCardName);
} else {
    $aadharCardPath = ""; // or handle as required
}
// Upload files only if both are provided
if (!empty($panCardPath) && !empty($aadharCardPath)) {
    if (
        move_uploaded_file($panCardTmp, $panCardPath) &&
        move_uploaded_file($aadharCardTmp, $aadharCardPath)
    ) {
        // echo "Files uploaded successfully.";
        // Insert $panCardPath and $aadharCardPath into DB if needed
    } else {
        // echo "File upload failed.";
    }
} else {
    // echo "Both files are required.";
}

$query_applicationId = mysqli_query($conn,"SELECT id FROM nocApplicationIds");
$fetchRows = mysqli_num_rows($query_applicationId);
$applicationId = "NOC-".date('Y')."-".$fetchRows;

$insert_applicationId = mysqli_query($conn,"INSERT INTO nocApplicationIds (applicationId,type) VALUES('$applicationId','Civilian')");

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
         echo "Error: " . $stmt->error;
        header('location:nocApplication.php');
}

header('location:nocApplication.php');
$stmt->close();

?>
