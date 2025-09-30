<?php
include('../include/conn.php');
date_default_timezone_set('Asia/Kolkata');

// ---------- INSERT NEW USER ----------
if (isset($_POST['submit'])) {
    $departmentId = isset($_POST['departmentId']) ? (is_array($_POST['departmentId']) ? implode(',', $_POST['departmentId']) : $_POST['departmentId']) : '';
    $name = $_POST['name'] ?? '';
    $mobileNo = $_POST['mobileNo'] ?? '';
    $password = $_POST['password'] ?? '';
    $designation = $_POST['designation'] ?? '';

    $userId = uniqid('user_');
    $DateTime = date('Y-m-d H:i:s');

    echo $systemRole = $_POST['systemRole'];


    // If Final Authority → clear designation
    if ($systemRole === "Final Authority") {
        $designation = '';
    }

    $query = mysqli_query($conn, "INSERT INTO users 
    (`departmentId`, `name`, `mobileNo`, `password`, `designation`, `systemRole`, `userId`, `dateTime`, `status`) 
    VALUES ('$departmentId','$name','$mobileNo', '$password','$designation','$systemRole', '$userId', '$DateTime', 'Active')");


    echo "<!DOCTYPE html><html><head><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script></head><body>
        <script>
            Swal.fire({
                icon: '" . ($query ? "success" : "error") . "',
                title: '" . ($query ? "Created!" : "Oops...") . "',
                text: '" . ($query ? "User created successfully." : "Something went wrong! Please try again.") . "',
            }).then(() => {
                window.location.href = 'user_master.php';
            });
        </script>
    </body></html>";
    exit;
}

// ---------- UPDATE USER ----------
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $mobileNo = mysqli_real_escape_string($conn, $_POST['mobileNo']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);
    $departmentId = $_POST['departmentId'];

    $updateQuery = "
        UPDATE users SET 
            name = '$name',
            mobileNo = '$mobileNo',
            password = '$password',
            designation = '$designation',
            departmentId = '$departmentId'
        WHERE id = $id
    ";

    $query = mysqli_query($conn, $updateQuery);

    echo "<!DOCTYPE html><html><head><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script></head><body>
        <script>
            Swal.fire({
                icon: '" . ($query ? "success" : "error") . "',
                title: '" . ($query ? "Updated!" : "Oops...") . "',
                text: '" . ($query ? "User updated successfully." : "Update failed. Please try again.") . "',
            }).then(() => {
                window.location.href = 'user_master.php';
            });
        </script>
    </body></html>";
    exit;
}

// ---------- DELETE USER (Soft Delete) ----------
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = mysqli_query($conn, "UPDATE users SET status = 'Inactive' WHERE id = '$id'");

    echo "<!DOCTYPE html><html><head><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script></head><body>
        <script>
            Swal.fire({
                icon: '" . ($query ? "success" : "error") . "',
                title: '" . ($query ? "Deleted!" : "Oops...") . "',
                text: '" . ($query ? "User marked as Inactive." : "Something went wrong while deleting.") . "',
            }).then(() => {
                window.location.href = 'user_master.php';
            });
        </script>
    </body></html>";
    exit;
}
?>

<?php
$con->close();
?>