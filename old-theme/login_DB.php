<?php
include('include/conn.php');
session_start(); // if you're using session

if (isset($_POST['login'])) {
    $mobileNumber = $_POST['mobileNumber'];
    $password = $_POST['password'];

    $sql = mysqli_query($conn, "SELECT * FROM `users` WHERE mobileNumber = '$mobileNumber' AND password = '$password'");

    $isLogin = mysqli_num_rows($sql) > 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<?php if ($isLogin): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Login Successful!',
          
            confirmButtonText: 'OK'
        }).then(() => {
            window.location = 'samplePage.php';
        });
    </script>
<?php else: ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Login Failed!',
            text: 'Incorrect mobile number or password',
            confirmButtonText: 'Try Again'
        }).then(() => {
            window.location = 'login.php';
        });
    </script>
<?php endif; ?>


</body>
</html>
