<?php
include('../include/conn.php');

if (isset($_POST['forwardNOC'])) {
    $departmentId = mysqli_real_escape_string($conn, $_POST['departmentId']);
    $applicationId = mysqli_real_escape_string($conn, $_POST['applicationId']);
    $inspectionOfficer = mysqli_real_escape_string($conn, $_POST['inspectionOfficer']);
    $HODremark = mysqli_real_escape_string($conn, string: $_POST['HODremark']);

    $uploadDir = "../documents/"; // folder to store files

    // Allowed MIME types and extensions
    $allowedTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png'];
    $allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png'];

    // Final DSC Document
    if (!empty($_FILES['toInspectionOfficer']['name'])) {
        $toInspectionOfficerName = $_FILES['toInspectionOfficer']['name'];
        $toInspectionOfficerTmp = $_FILES['toInspectionOfficer']['tmp_name'];
        $toInspectionOfficerType = mime_content_type($toInspectionOfficerTmp);
        $toInspectionOfficerExt = strtolower(pathinfo($toInspectionOfficerName, PATHINFO_EXTENSION));

        if (in_array($toInspectionOfficerType, $allowedTypes) && in_array($toInspectionOfficerExt, $allowedExtensions)) {
            $toInspectionOfficerPath = $uploadDir . time() . "_toInspectionOfficer_" . basename($toInspectionOfficerName);
            move_uploaded_file($toInspectionOfficerTmp, $toInspectionOfficerPath);
        } else {
            $toInspectionOfficerPath = "";
            echo "
            <script>
            window.location = '../department/nocReport.php?status=error&msg=Invalid report file type. Only PDF, JPEG, JPG, PNG allowed.'
            </script>
            ";
            exit;
        }
    } else {
        $toInspectionOfficerPath = "";
    }



    // Step 1: Check if record exists
    $checkQuery = "SELECT forwardEmployee FROM nocApplicationReviews WHERE applicationId = '$applicationId' AND departmentId = '$departmentId'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (!$checkResult || mysqli_num_rows($checkResult) == 0) {
        // No such application
        echo "
        <script>
        window.location = '../department/nocReport.php?status=not_found'
        </script>
        ";
        // header("Location: ../department/nocReport.php?status=not_found");
        // exit();
    }


    $row = mysqli_fetch_assoc($checkResult);

    // Step 2: If already forwarded
    if (!is_null($row['forwardEmployee']) && trim($row['forwardEmployee']) !== '') {
        echo "
        <script>
        window.location = '../department/nocReport.php?status=already_forwarded'
        </script>
        ";
        // header("Location: ../department/nocReport.php?status=already_forwarded");
        // exit();
    }

    // Step 3: Update if not already forwarded
    $updateQuery = "UPDATE nocApplicationReviews 
                    SET forwardEmployee = '$inspectionOfficer',
                        forwardEmployeeDoc = '$toInspectionOfficerPath',
                        remarks = '$HODremark'
                    WHERE applicationId = '$applicationId' AND departmentId = '$departmentId'";

    if (mysqli_query($conn, $updateQuery)) {
        echo "
        <script>
        window.location = '../department/nocReport.php?status=success'
        </script>
        ";
        // header("Location: ../department/nocReport.php?status=success");
        exit();
    } else {
        $error = urlencode(mysqli_error($conn));
        echo "
        <script>
        window.location = '../department/nocReport.php?status=" . $error . "'
        </script>
        ";
        // header("Location: ../department/nocReport.php?status=error&msg=$error");
        exit();
    }
}
?>
<?php
$con->close();
?>