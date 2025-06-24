<?php
include('include/conn.php');

if (isset($_POST['submit'])) {

 date_default_timezone_set('Asia/Kolkata');

    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $taluka = $_POST['taluka'];
    $village = $_POST['village'];
    $aadhaarNumber = $_POST['aadhaarNumber'];
    $email = $_POST['email'];
    $mobileNumber = $_POST['mobileNumber'];
    $password = $_POST['password'];
     $date_time = date('Y-m-d H:i:s'); 


    
    
    $query = mysqli_query($conn, "INSERT INTO users (`fullname`, `address`, `taluka`, `village`, `aadhaarNumber`, `email`, `mobileNumber`, `password`, `date_time`) 
    VALUES ('$fullname', '$address', '$taluka', '$village', '$aadhaarNumber', '$email', '$mobileNumber', '$password', '$date_time')");

    if ($query) {
        echo '<script>alert("Create user successfully"); window.location.href="login.php";</script>';
    } else {
       
        echo "Error: " . mysqli_error($conn);
    }
}
?>
