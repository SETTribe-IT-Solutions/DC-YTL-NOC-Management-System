<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting();
if (isset($_REQUEST['logIn'])) {
    include('include/conn.php');
    include('include/sweetAlert.php');
    $mobileNo = $_POST['mobileNo'];
    $password = $_POST['password'];

    $query = mysqli_query($con, "SELECT * FROM civilianRegistrations WHERE `mobileNo` = '$mobileNo' AND `password` = '$password'");

    if (mysqli_num_rows($query) > 0) {
        $result = mysqli_fetch_assoc($query);

        if ($result['mobileNo'] == $mobileNo && $result['password'] == $password) {
            $_SESSION['userId'] = $result['civilianId'];
            $_SESSION['designation'] = "civilian";
            if (isset($_POST['signed'])) {
                setcookie('userId', $result['civilianId'], time() + (86400 * 30), '/');
                setcookie('designation', "civilian", time() + (86400 * 30), '/');
            }
            echo $_SESSION['userI'];
            header('location:civilian/index.php');
        } else {
            $_SESSION['status'] = false;
            $_SESSION['msg'] = "Invalid Mobile No. & Password";
            header('location:login.php');
        }
    } else {
        $_SESSION['status'] = false;
        $_SESSION['msg'] = "Invalid Mobile No. & Password";
        header('location:login.php');
    }

}
?>