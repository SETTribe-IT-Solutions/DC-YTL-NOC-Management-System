<?php
include('../include/conn.php');

if (isset($_POST['nocType'])) {
    $nocType = $_POST['nocType'];

    $query = mysqli_query($conn, "SELECT nocTypes.type, users.name FROM `nocTypes` JOIN users ON nocTypes.finalAuthority = users.userId WHERE nocTypes.id='$nocType'") or die($conn->error);
    $fetchs = mysqli_fetch_assoc($query);
    echo $fetchs['name'];
}

$con->close();
?>