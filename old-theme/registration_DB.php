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

     $check = mysqli_query($conn, "SELECT * FROM users WHERE aadhaarNumber = '$aadhaarNumber' OR mobileNumber = '$mobileNumber'");
    if (mysqli_num_rows($check) > 0) {
        $duplicate = true;
    } else {
        $query = mysqli_query($conn, "INSERT INTO users (`fullname`, `address`, `taluka`, `village`, `aadhaarNumber`, `email`, `mobileNumber`, `password`, `date_time`) 
        VALUES ('$fullname', '$address', '$taluka', '$village', '$aadhaarNumber', '$email', '$mobileNumber', '$password', '$date_time')");
        $isSuccess = $query;
    }
    $isSuccess = $query;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<?php if (isset($duplicate) && $duplicate): ?>
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Duplicate Entry',
            text: 'Mobile number or Aadhaar number is already registered!',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location = 'registration.php'; // change to your form page if different
        });
    </script>

<?php elseif (isset($isSuccess) && $isSuccess): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'User Created Successfully!',
            text: 'Click OK to go to login page.',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location = 'login.php';
        });
    </script>

<?php elseif (isset($isSuccess) && !$isSuccess): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Something went wrong!',
            text: '<?= mysqli_error($conn); ?>',
            confirmButtonText: 'OK'
        });
    </script>
<?php endif; ?>
</body>
</html>
