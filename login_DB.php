<?php
include('include/conn.php');
if(isset($_POST['login'])){
    $mobileNumber = $_POST['mobileNumber'];
    $password = $_POST['password'];
    

    $sql = mysqli_query($conn,"SELECT * FROM `users` WHERE mobileNumber = '$mobileNumber' AND password = '$password'");

    If(mysqli_num_rows($sql) > 0 ){
        echo"<script>alert('login succssully')</script>";
        echo"<script>window.location = 'samplePage.php';</script>";

    }else {
         echo"<script>alert('incorrect user name or password')</script>";
        echo"<script>window.location = 'login.php';</script>";
    }
}

?>