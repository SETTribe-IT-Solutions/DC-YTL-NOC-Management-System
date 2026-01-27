<?php
session_start();

if (isset($_POST['submit'])) {
    include('../include/conn.php');
    include('../include/sweetAlert.php');


    // Step 1: Collect data from POST
    $applicationType = $_POST['applicationType'];
    $nocNumber = $_POST['nocNumber'];
    $nocType = $_POST['nocType'];
    $dob = $_POST['dob'];
    $fullName = $_POST['fullName'];
    $aadharNo = $_POST['aadharNo'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $mobileNo = $_POST['mobileNo'];
    $landDesc = $_POST['landDesc'];
    $nocSubject = $_POST['nocSubject'];
    $taluka = $_POST['taluka'];
    $village = $_POST['village'];
    // $departmentId  = $_POST['departmentId'];
    $gatNo = $_POST['gatNo'];
    $status = 'Submitted';
 // default status
    $createdDateTime = date("Y-m-d H:i:s");
    // $updateDateTime  = date("Y-m-d H:i:s");
    $civilianId = $_SESSION['userId'];
    // die();
    $uploadDir = "civilian/documents/";
 // folder to store files

    // Allowed MIME types and extensions
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];

    // PAN Card
    // PAN Card
if (!empty($_FILES['penCard']['name'])) {

    $panCardName = $_FILES['penCard']['name'];
    $panCardTmp  = $_FILES['penCard']['tmp_name'];
    $panCardExt  = strtolower(pathinfo($panCardName, PATHINFO_EXTENSION));

    if (in_array($panCardExt, $allowedExtensions)) {

        $panSafeName = preg_replace("/[^a-zA-Z0-9.]/", "_", $panCardName);
        $fileName = time() . "_pan_" . $panSafeName;

        // Save path for DB (browser path)
        $panCardPath = "civilian/documents/" . $fileName;

        // Real server path (physical save)
        move_uploaded_file($panCardTmp, "../civilian/documents/" . $fileName);

    } else {
        $panCardPath = "";
        echo "Invalid PAN card file type.";
    }

} else {
    $panCardPath = "";
}

    // Aadhar Card
// Aadhar Card
if (!empty($_FILES['aadharCard']['name'])) {

    $aadharCardName = $_FILES['aadharCard']['name'];
    $aadharCardTmp  = $_FILES['aadharCard']['tmp_name'];
    $aadharCardExt  = strtolower(pathinfo($aadharCardName, PATHINFO_EXTENSION));

    if (in_array($aadharCardExt, $allowedExtensions)) {

        $aadharSafeName = preg_replace("/[^a-zA-Z0-9.]/", "_", $aadharCardName);
        $fileName = time() . "_aadhar_" . $aadharSafeName;

        // Save path for DB (browser path)
        $aadharCardPath = "civilian/documents/" . $fileName;

        // Real server path (physical save)
        move_uploaded_file($aadharCardTmp, "../civilian/documents/" . $fileName);

    } else {
        $aadharCardPath = "";
        echo "Invalid Aadhar card file type.";
    }

} else {
    $aadharCardPath = "";
}
// NOC अर्ज file upload
if (!empty($_FILES['nocArz']['name'])) {

    $nocFileName = $_FILES['nocArz']['name'];
    $nocFileTmp  = $_FILES['nocArz']['tmp_name'];
    $nocFileExt  = strtolower(pathinfo($nocFileName, PATHINFO_EXTENSION));

    if (in_array($nocFileExt, $allowedExtensions)) {

        $nocSafeName = preg_replace("/[^a-zA-Z0-9.]/", "_", $nocFileName);
        $fileName = time() . "_noc_" . $nocSafeName;

        // Save path for DB
        $nocApplicationFile = "civilian/documents/" . $fileName;

        // Save physically
        move_uploaded_file($nocFileTmp, "../civilian/documents/" . $fileName);

    } else {
        $nocApplicationFile = "";
        echo "Invalid NOC file type.";
    }

} else {
    $nocApplicationFile = "";
}



    // Step 1: Get the latest applicationId
    $queryGet = mysqli_query($conn, "SELECT COUNT(*) as applicationId FROM `nocApplicationIds` ") or die($conn->error);
    $fetchGet = mysqli_fetch_assoc($queryGet);
    $count = $fetchGet['applicationId'] + 1;
    $formatted_count = sprintf('%03d', $count);

    $applicationId = "NOC-2025-" . "" . $formatted_count;

    $insert_applicationId = mysqli_query($conn, "INSERT INTO nocApplicationIds (applicationId,type, nocTypeId, taluka, village, dateTime) VALUES('$applicationId','Civilian','$nocType','$taluka','$village', '$createdDateTime')");

    $update_civilianRegistrations = mysqli_query($conn, "UPDATE civilianRegistrations SET dob = '$dob' WHERE civilianId = '$civilianId'");

    $queryReview = mysqli_query($conn, "SELECT departmentId FROM nocTypes WHERE id='$nocType'");
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
    applicationId, civilianId, nocSubject, nocTypeId, name, address, emailId, mobileNo, aadharNo, landDesc,
    taluka, village, gatNo, landType, panCard, aadharCard, nocApplicationFile,
    status, init_status, tahildarStatus, finalTahildarStatus, departmentStatus, SDO_final_status, final_Auth_status,
    createdDateTime, userId
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Default workflow values
// Default workflow values
$landType = NULL;
// $nocApplicationFile = NULL;

$status = 'Submitted';          // ENUM allowed value ✅
$init_status = 'Pending';
$tahildarStatus = 'Pending';
$finalTahildarStatus = 'Pending';
$departmentStatus = 'Pending';
$SDO_final_status = 'Pending';
$final_Auth_status = 'Pending';


// Step 3: Bind parameters
$stmt->bind_param(
    "sssisssssssssssssssssssssi",

    $applicationId,        // s
    $civilianId,           // s
    $nocSubject,           // s
    $nocType,              // i
    $fullName,             // s
    $address,              // s
    $email,                // s
    $mobileNo,             // s
    $aadharNo,             // s
    $landDesc,             // s
    $taluka,               // s
    $village,              // s
    $gatNo,                // s
    $landType,             // s (NULL allowed)
    $panCardPath,          // s
    $aadharCardPath,       // s
    $nocApplicationFile,   // s (NULL allowed)
    $status,               // s
    $init_status,          // s
    $tahildarStatus,       // s
    $finalTahildarStatus,  // s
    $departmentStatus,     // s
    $SDO_final_status,     // s
    $final_Auth_status,    // s
    $createdDateTime,      // s
    $civilianId            // i (userId)
);

// Step 4: Execute and check
if ($stmt->execute()) {
    $_SESSION['status'] = true;
    $_SESSION['msg'] = "Application Submitted successfully.";
} else {
    $_SESSION['status'] = false;
    $_SESSION['msg'] = "Something went wrong: " . $stmt->error;
}

header('location:nocApplication.php');
$stmt->close();

}

?>