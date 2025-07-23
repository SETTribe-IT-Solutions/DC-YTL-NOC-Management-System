<?php
session_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
if (isset($_REQUEST['logIn'])) {
    include('../include/conn.php');
    include('../include/sweetAlert.php');
    $username = $_POST['username'];
    $password = $_POST['password'];


    echo $sql = "SELECT * FROM adminLogins WHERE `username` = '$username' AND `password` = '$password' AND status = 'Active'";

    $query = mysqli_query($con, $sql);



    if (mysqli_num_rows($query) > 0) {
        $result = mysqli_fetch_assoc($query);

        if ($result['username'] == $username && $result['password'] == $password) {
            $_SESSION['userId'] = $result['userId'];
            $_SESSION['designation'] = $result['designation'];
            $_SESSION['admin'] = "admin";
            $_SESSION['role'] = "Collector";

            if (isset($_POST['signed'])) {
                setcookie('userId', $result['userId'], time() + (86400 * 30), '/');
                setcookie('designation', "admin", time() + (86400 * 30), '/');
            }

            echo "<script>window.location = 'collector-dashboard.php';</script>";


        } else {
            $_SESSION['status'] = false;
            $_SESSION['msg'] = "Invalid Username & Password";
            // header('location:login.php');
            echo "<script>window.location = 'login.php';</script>";
        }
    } else {
        $_SESSION['status'] = false;
        $_SESSION['msg'] = "Invalid Username & Password";
        echo "<script>window.location = 'login.php';</script>";

    }

}
?>