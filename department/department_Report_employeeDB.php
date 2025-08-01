<?php
session_start();
include('../include/conn.php');

if (isset($_POST['update'])) {
    $applicationId = $_POST['applicationId'] ?? '';
    $reportRemark = $_POST['reportRemark'] ?? '';

    $uploadDir = 'reportDoc/'; // Folder to save files
    $uploadedFiles = [];

    if (!empty($_FILES['reportFile']['name'][0])) {
        foreach ($_FILES['reportFile']['name'] as $key => $name) {
            $tmpName = $_FILES['reportFile']['tmp_name'][$key];
            $fileName = time() . '_' . basename($name); // Prevent duplicate names
            $filePath = $uploadDir . $fileName;

            if (move_uploaded_file($tmpName, $filePath)) {
                $uploadedFiles[] = $fileName;
            }
        }
    }

    // Join filenames with -Next file
    $reportFile = implode(' -Next file, ', $uploadedFiles);

    // Now update database
    if ($applicationId && $reportFile) {
        $update = mysqli_query($conn, "
            UPDATE departmentNocApplications 
            SET reportFile = '$reportFile', reportRemark = '$reportRemark' 
            WHERE applicationId = '$applicationId'
        ");

        if ($update) {
            echo "Files uploaded and record updated successfully.";
        } else {
            echo "Database update failed.";
        }
    } else {
        echo "No files uploaded.";
    }
}
?>
