<?php
require 'db_connection.php'; // adjust path if needed

// Step 1: Collect data from POST
$formId        = $_POST['formId'];
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
$departmentId  = $_POST['departmentId'];
$gatNo         = $_POST['gatNo'];
$panCard       = $_POST['panCard'];     // File name or path from uploaded file
$aadharCard    = $_POST['aadharCard'];  // File name or path from uploaded file
$status        = $_POST['status'] ?? 'Pending'; // default status
$createdDateTime = date("Y-m-d H:i:s");
// $updateDateTime  = date("Y-m-d H:i:s");
$userId        = $_POST['userId'];

// Step 2: Prepare statement
$stmt = $conn->prepare("INSERT INTO nocApplication (
    formId, applicationType, nocNumber, nocType, dob, fullName, aadharNo, address, email, mobileNo, landDesc, nocSubject, taluka, village, departmentId, panCard, aadharCard, status, createdDateTime, updateDateTime, userId
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("sssssssssssssssssssss", 
    $formId, $applicationType, $nocNumber, $nocType, $dob, $fullName, $aadharNo, $address, $email, $mobileNo, $landDesc, $nocSubject, $taluka, $village, $departmentId, $panCard, $aadharCard, $status, $createdDateTime, $updateDateTime, $userId
);

// Step 3: Execute and check
if ($stmt->execute()) {
    echo "Application inserted successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
?>
