<?php
include('../include/conn.php');
// echo $taluka = $_POST['taluka'];
if (isset($_POST['taluka']) && !empty($_POST['taluka'])) {
    $taluka = $_POST['taluka'];

    $stmt = $conn->prepare("SELECT DISTINCT village FROM taluka WHERE taluka = ?");
    $stmt->bind_param("s", $taluka);
    $stmt->execute();
    $result = $stmt->get_result();

    echo '<option value="">गाव निवडा</option>';
    while ($row = $result->fetch_assoc()) {
        echo '<option >' . $row['village'] . '</option>';
    }

    $stmt->close();
}
?>
