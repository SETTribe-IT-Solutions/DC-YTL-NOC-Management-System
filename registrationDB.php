<?php
include("include/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $name     = mysqli_real_escape_string($con, $_POST['name']);
    $address  = mysqli_real_escape_string($con, $_POST['address']);
    $taluka   = mysqli_real_escape_string($con, $_POST['taluka']);
    $village  = mysqli_real_escape_string($con, $_POST['village']);
    $aadharNo = mysqli_real_escape_string($con, $_POST['aadharNo']);
    $emailId  = mysqli_real_escape_string($con, $_POST['emailId']);
    $mobileNo = mysqli_real_escape_string($con, $_POST['mobileNo']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Generate civilianId
    $res = mysqli_query($con, "SELECT COUNT(*) AS total FROM civilianRegistrations");
    $row = mysqli_fetch_assoc($res);
    $nextIdNumber = $row['total'] + 1;
    $civilianId = "civilianId_" . str_pad($nextIdNumber, 3, '0', STR_PAD_LEFT);

    // File Upload
    if (isset($_FILES['identificationCertificate']) && $_FILES['identificationCertificate']['error'] === 0) {
        $file_name = $_FILES['identificationCertificate']['name'];
        $file_tmp  = $_FILES['identificationCertificate']['tmp_name'];
        $file_type = mime_content_type($file_tmp);
        $file_ext  = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        $allowed_mime = ['image/jpeg', 'image/png', 'application/pdf'];
        $allowed_ext  = ['jpg', 'jpeg', 'png', 'pdf'];

        if (in_array($file_type, $allowed_mime) && in_array($file_ext, $allowed_ext)) {

            $upload_dir = "uploads/";
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            $file_path = $upload_dir . time() . "_" . basename($file_name);

            if (move_uploaded_file($file_tmp, $file_path)) {

                // Insert into DB
                $query = "INSERT INTO civilianRegistrations 
                    (`civilianId`, `name`, `address`, `taluka`, `village`, `aadharNo`, `emailId`, `identificationCertificate`, `mobileNo`,`password`) 
                    VALUES 
                    ('$civilianId', '$name', '$address', '$taluka', '$village', '$aadharNo', '$emailId', '$file_path', '$mobileNo','$password')";

                if (mysqli_query($con, $query)) {
                    echo "<script>alert('नोंदणी यशस्वी झाली'); window.location.href='registration.php';</script>";
                } else {
                    echo "<script>alert('डेटाबेस त्रुटी: " . mysqli_error($con) . "');</script>";
                }

            } else {
                echo "<script>alert('फाईल अपलोड करण्यात अयशस्वी.');</script>";
            }

        } else {
           echo "<script>alert('फक्त JPG, PNG किंवा PDF फाईल्स स्वीकारल्या जातील.'); window.location.href='registration.php';</script>";

        }

    } else {
        echo "<script>alert('कृपया वैध फाईल निवडा.');</script>";
    }

} else {
    echo "<script>alert('Invalid Request');</script>";
}
?>
