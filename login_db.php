<?php
session_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
if (isset($_REQUEST['logIn'])) {
    include('include/conn.php');
    include('include/sweetAlert.php');
    $mobileNo = $_POST['mobileNo'];
    $password = $_POST['password'];
    $role = $_GET['role'];


    if ($role == "civilian") {
        $sql = "SELECT * FROM civilianRegistrations WHERE `mobileNo` = '$mobileNo' AND `password` = '$password' AND status = 'Active'";
    } else if ($role == "officer") {
        $sql = "SELECT * FROM users WHERE `mobileNo` = '$mobileNo' AND `password` = '$password' AND status = 'Active'";

    }

    $query = mysqli_query($con, $sql);



    if (mysqli_num_rows($query) > 0) {
        $result = mysqli_fetch_assoc($query);

        if ($result['mobileNo'] == $mobileNo && $result['password'] == $password) {
            if ($role == "civilian") {
                $_SESSION['userId'] = $result['civilianId'];
                $_SESSION['designation'] = "Civilian";
                $_SESSION['role'] = "Civilian";

                if (isset($_POST['signed'])) {
                    setcookie('userId', $result['civilianId'], time() + (86400 * 30), '/');
                    setcookie('designation', "Civilian", time() + (86400 * 30), '/');
                }

                echo "<script>window.location = 'civilian/index.php';</script>";
            } else if ($role == "officer") {
                $_SESSION['userId'] = $result['userId'];
                $_SESSION['designation'] = $result['designation'];
                $_SESSION['role'] = "Officer";
                if (isset($_POST['signed'])) {
                    setcookie('userId', $result['userId'], time() + (86400 * 30), '/');
                    setcookie('designation', "Officer", time() + (86400 * 30), '/');
                }

                if ($result['designation'] == "SDO") {
                    echo "<script>window.location = 'officers/sdo-dashboard.php';</script>";
                } else if ($result['designation'] == "Tahsildar") {
                    echo "<script>window.location = 'officers/tahsildar-dashboard.php';</script>";
                } else if ($result['designation'] == "Department") {
                    echo "<script>window.location = 'officers/department-dashboard.php';</script>";
                    $_SESSION['departmentId'] = $result['departmentId'];

                }
            } else {
                $_SESSION['status'] = false;
                $_SESSION['msg'] = "Invalid Mobile No. & Password";
                // header('location:login.php');
                echo "<script>window.location = 'login.php?role=" . $role . "';</script>";
            }


        } else {
            $_SESSION['status'] = false;
            $_SESSION['msg'] = "Invalid Mobile No. & Password";
            // header('location:login.php');
            echo "<script>window.location = 'login.php?role=" . $role . "';</script>";
        }
    } else {
        $_SESSION['status'] = false;
        $_SESSION['msg'] = "Invalid Mobile No. & Password";
        echo "<script>window.location = 'login.php?role=" . $role . "';</script>";

    }

}
?>