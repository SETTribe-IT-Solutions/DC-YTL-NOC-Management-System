<?php
session_start();
include('../include/conn.php');

$userId = $_SESSION['userId'];
$nocTypeId = $_POST['nocTypeId'] ?? '';
$departmentId = $_POST['departmentId'] ?? '';

$where = "WHERE dna.civilianId = '$userId'";

// Apply filters based on conditions
if (!empty($nocTypeId) && !empty($departmentId)) {
    $where .= " AND dna.nocTypeId = '$nocTypeId' AND dna.departmentId = '$departmentId'";
} elseif (!empty($nocTypeId)) {
    $where .= " AND dna.nocTypeId = '$nocTypeId'";
} elseif (!empty($departmentId)) {
    $where .= " AND dna.departmentId = '$departmentId'";
}

$sql = "SELECT dna.*, nt.type as nocType, d.departmentName 
        FROM departmentNocApplications dna 
        LEFT JOIN nocTypes nt ON nt.id = dna.nocTypeId 
        LEFT JOIN departments d ON d.id = dna.departmentId 
        $where 
        ORDER BY dna.applicationId DESC";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($r = mysqli_fetch_assoc($result)) {
        echo "<tr>
            <td>{$r['applicationId']}</td>
            <td>{$r['nocType']}</td>
            <td>{$r['dob']}</td>
            <td>{$r['name']}</td>
            <td>{$r['aadharNo']}</td>
            <td>{$r['address']}</td>
            <td>{$r['emailId']}</td>
            <td>{$r['mobileNo']}</td>
            <td>{$r['landDesc']}</td>
            <td>{$r['subject']}</td>
            <td>{$r['taluka']}</td>
            <td>{$r['village']}</td>
            <td>{$r['gatNo']}</td>
            <td>" . ($r['aadharCard'] ? "<a href='{$r['aadharCard']}' target='_blank'>View</a>" : "फाईल निवडलेली नाही") . "</td>
            <td>" . ($r['panCard'] ? "<a href='{$r['panCard']}' target='_blank'>View</a>" : "फाईल निवडलेली नाही") . "</td>
            <td>
                <a href='civilian/trackNoc.php?applicationId={$r['applicationId']}'><button class='btn btn-primary btn-sm'>Track</button></a>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='16' class='text-center text-danger'>माहिती उपलब्ध नाही</td></tr>";
}
?>
