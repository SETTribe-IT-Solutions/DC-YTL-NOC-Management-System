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
    $landDesc = $_POST['landDesc'] ?? NULl;
    $nocSubject = $_POST['nocSubject'];
    $taluka = $_POST['taluka'];
    $village = $_POST['village'];
    // $departmentId  = $_POST['departmentId'];
    $gatNo = $_POST['gatNo'];
    $landType = $_POST['landType'];
    $status = $_POST['status'] ?? 'Pending'; // default status
    $createdDateTime = date("Y-m-d H:i:s");
    // $updateDateTime  = date("Y-m-d H:i:s");
    $civilianId = $_SESSION['userId'];
    // die();
    $uploadDir = "../documents/"; // folder to store files

    // Allowed MIME types and extensions
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];

    // PAN Card
    if (!empty($_FILES['penCard']['name'])) {
        $panCardName = $_FILES['penCard']['name'];
        $panCardTmp = $_FILES['penCard']['tmp_name'];
        $panCardType = mime_content_type($panCardTmp);
        $panCardExt = strtolower(pathinfo($panCardName, PATHINFO_EXTENSION));

        if (in_array($panCardType, $allowedTypes) && in_array($panCardExt, $allowedExtensions)) {
            $panCardPath = $uploadDir . time() . "_pan_" . basename($panCardName);
            move_uploaded_file($panCardTmp, $panCardPath);
        } else {
            $panCardPath = "";
            echo "Invalid PAN card file type. Only JPG, PNG, and PDF allowed.";
        }
    } else {
        $panCardPath = "";
    }

    // Aadhar Card
    if (!empty($_FILES['aadharCard']['name'])) {
        $aadharCardName = $_FILES['aadharCard']['name'];
        $aadharCardTmp = $_FILES['aadharCard']['tmp_name'];
        $aadharCardType = mime_content_type($aadharCardTmp);
        $aadharCardExt = strtolower(pathinfo($aadharCardName, PATHINFO_EXTENSION));

        if (in_array($aadharCardType, $allowedTypes) && in_array($aadharCardExt, $allowedExtensions)) {
            $aadharCardPath = $uploadDir . time() . "_aadhar_" . basename($aadharCardName);
            move_uploaded_file($aadharCardTmp, $aadharCardPath);
        } else {
            $aadharCardPath = "";
            echo "Invalid Aadhar card file type. Only JPG, PNG, and PDF allowed.";
        }
    } else {
        $aadharCardPath = "";
    }


    // Phyical NOC
    if (!empty($_FILES['nocApplicationFile']['name'])) {
        $nocApplicationFileName = $_FILES['nocApplicationFile']['name'];
        $nocApplicationFileTmp = $_FILES['nocApplicationFile']['tmp_name'];
        $nocApplicationFileType = mime_content_type($nocApplicationFileTmp);
        $nocApplicationFileExt = strtolower(pathinfo($nocApplicationFileName, PATHINFO_EXTENSION));

        if (in_array($nocApplicationFileType, $allowedTypes) && in_array($nocApplicationFileExt, $allowedExtensions)) {
            $nocApplicationFilePath = $uploadDir . time() . "_noc_" . basename($nocApplicationFileName);
            move_uploaded_file($nocApplicationFileTmp, $nocApplicationFilePath);
        } else {
            $nocApplicationFilePath = "";
            echo "Invalid NOC application file type. Only JPG, PNG, and PDF allowed.";
        }
    } else {
        $nocApplicationFilePath = "";
    }

    // Step 1: Get the latest applicationId
    $queryGet = mysqli_query($conn, "SELECT COUNT(*) as applicationId FROM `nocApplicationIds` ") or die($conn->error);
    $fetchGet = mysqli_fetch_assoc($queryGet);
    $count = $fetchGet['applicationId'] + 1;
    $formatted_count = sprintf('%03d', $count);

    $applicationId = "NOC-2025-" . "" . $formatted_count;

    $insert_applicationId = mysqli_query($conn, "INSERT INTO nocApplicationIds (applicationId,type, nocTypeId, taluka, village, dateTime) VALUES('$applicationId','Civilian','$nocType','$taluka','$village', '$createdDateTime')");

    $update_civilianRegistrations = mysqli_query($con, "UPDATE civilianRegistrations SET dob = '$dob' WHERE civilianId = '$civilianId'");

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
//     $stmt = $conn->prepare("INSERT INTO nocApplications (
//     applicationId, civilianId, nocSubject, nocTypeId, name, address, emailId, mobileNo, aadharNo, landDesc, taluka, village, gatNo, landType, panCard, aadharCard, nocApplicationFile, createdDateTime, userId
// ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    //     $stmt->bind_param(
//         "sssssssssssssssssss",  // 19 characters
//         $applicationId,
//         $civilianId,
//         $nocSubject,
//         $nocType,           // i (integer)
//         $fullName,
//         $address,
//         $email,
//         $mobileNo,
//         $aadharNo,
//         $landDesc,
//         $taluka,
//         $village,
//         $gatNo,
//         $landType,
//         $panCardPath,
//         $aadharCardPath,
//         $nocApplicationFile,
//         $createdDateTime,
//         $userId             // i if numeric, s if varchar
//     );
    // try {
    //     $stmt->execute();
    // } catch (PDOException $e) {
    //     echo "❌ PDO Error: " . $e->getMessage();
    // }

    $sql = "
        INSERT INTO nocApplications (
            applicationId, civilianId, nocSubject, nocTypeId, name, address, emailId, mobileNo, aadharNo, 
            landDesc, taluka, village, gatNo, landType, panCard, aadharCard, nocApplicationFile, createdDateTime
        ) VALUES (
            '$applicationId',
            '$civilianId',
            '$nocSubject',
            '$nocType',
            '$fullName',
            '$address',
            '$email',
            '$mobileNo',
            '$aadharNo',
            '$landDesc',
            '$taluka',
            '$village',
            '$gatNo',
            '$landType',
            '$panCardPath',
            '$aadharCardPath',
            '$nocApplicationFile',
            '$createdDateTime'
        )";







    // Step 4: Execute and check
    if (mysqli_query($conn, $sql)) {
        $_SESSION['status'] = true;
        $_SESSION['msg'] = "Application Submitted successfully.";


    } else {
        $_SESSION['status'] = false;
        $_SESSION['msg'] = "Something went wrong";


        //  echo "Error: " . $stmt->error;
    }

    echo "
    <script>
    window.location = 'nocApplication.php'
    </script>
    ";


    // header('location:nocApplication.php');
    $stmt->close();
}

?>
