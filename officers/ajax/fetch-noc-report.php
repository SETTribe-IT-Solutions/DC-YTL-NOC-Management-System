<?php
include('../../include/conn.php');

$draw = $_POST['draw'];
$start = $_POST['start'];
$length = $_POST['length'];

$searchValue = $_POST['search']['value'];

// Count total records
$totalQuery = "SELECT COUNT(*) as total FROM departmentNocApplications";
$totalResult = mysqli_fetch_assoc(mysqli_query($conn, $totalQuery));
$totalRecords = $totalResult['total'];

// Build search filter
$searchQuery = "";
if ($searchValue != '') {
    $searchQuery = " WHERE nocSubject LIKE '%$searchValue%' OR taluka LIKE '%$searchValue%' ";
}

// Fetch records with limit and search
$dataQuery = "SELECT * FROM departmentNocApplications $searchQuery LIMIT $start, $length";
$dataResult = mysqli_query($conn, $dataQuery);

$data = [];
while ($r = mysqli_fetch_assoc($dataResult)) {
    $nocType = mysqli_fetch_assoc(mysqli_query($conn, "SELECT type FROM nocTypes WHERE id = '{$r['nocTypeId']}'"))['type'] ?? '';
    $dept = mysqli_fetch_assoc(mysqli_query($conn, "SELECT departmentName FROM departments WHERE id = '{$r['departmentId']}'"))['departmentName'] ?? '';

    $data[] = [
        $r['applicationId'],
        $dept,
        $nocType,
        $r['taluka'],
        $r['village'],
        $r['nocSubject'],
        $r['landDesc'],
        $r['createdDateTime']
    ];
}

echo json_encode([
    "draw" => intval($draw),
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $totalRecords, // You can update this if search is applied
    "data" => $data
]);
