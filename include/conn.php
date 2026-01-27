<?php
$conn = mysqli_connect(
    "103.160.107.18",                
    "nmrmlatur_dcytlnoc",          
    "ST@NOCYavatmal1",                
    "nmrmlatur_dcytlnoc"            
);

if (!$conn) {
    die("DB Connection Failed: " . mysqli_connect_error());
}
 
$con = $conn;
date_default_timezone_set('Asia/Kolkata');
?>