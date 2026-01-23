<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$db = mysqli_connect("103.160.107.18:3306", 'nmrmlatur_dev_idp_hingoli', 'ST_Dev_IDP@123', 'nmrmlatur_dev_idp_hingoli');

if ($db) {
    echo 'con done';
}
?>