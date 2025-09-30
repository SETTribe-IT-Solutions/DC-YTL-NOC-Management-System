<?php
include("include/conn.php");
header('Content-Type: application/json');

if (isset($_GET['taluka'])) {
    $taluka = mysqli_real_escape_string($con, $_GET['taluka']);
    $result = mysqli_query($con, "SELECT DISTINCT village FROM taluka WHERE taluka = '$taluka'");

    $villages = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $villages[] = $row['village'];
    }

    echo json_encode($villages);
}
?>
