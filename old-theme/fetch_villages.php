<?php
include('include/conn.php');

if (isset($_POST['taluka'])) {
    $taluka = mysqli_real_escape_string($conn, $_POST['taluka']);

    $query = mysqli_query($conn, "SELECT DISTINCT village FROM taluka WHERE taluka = '$taluka' ORDER BY village ASC");

    echo '<option value="">-- गाव निवडा --</option>';
    while ($row = mysqli_fetch_assoc($query)) {
        echo '<option value="' . htmlspecialchars($row['village']) . '">' . htmlspecialchars($row['village']) . '</option>';
    }
}
?>
