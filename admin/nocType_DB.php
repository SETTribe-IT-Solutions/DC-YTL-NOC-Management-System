<?php
include('../include/conn.php');
date_default_timezone_set('Asia/Kolkata');

// ---------------- INSERT ----------------
if (isset($_POST['submit'])) {
    $type = $_POST['type'];
    $departmentIdArray = $_POST['departmentId'];
    $departmentIdString = implode(',', $departmentIdArray);
    $finalAuthority = $_POST['finalAuthority'];
    $userId = $_SESSION['userId'] ?? 'userId_001';  // session se user id lo
    $createdDateTime = date('Y-m-d H:i:s');

    $query = mysqli_query($conn, "INSERT INTO nocTypes (`type`, `departmentId`, `finalAuthority`, `userId`, `createdDateTime`) 
        VALUES ('$type', '$departmentIdString', '$finalAuthority', '$userId', '$createdDateTime')");
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script></head>
    <body>
    <script>
        Swal.fire({
            icon: '<?php echo $query ? "success" : "error"; ?>',
            title: '<?php echo $query ? "Success!" : "Oops..."; ?>',
            text: '<?php echo $query ? "NOC Type created successfully" : "Something went wrong! Please try again."; ?>',
        }).then(() => {
            window.location.href = 'nocType.php';
        });
    </script>
    </body>
    </html>
    <?php
    exit;
}

// ---------------- UPDATE ----------------
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $type = $_POST['type'];
    $departmentIdArray = $_POST['departmentId'];
    $departmentIdString = implode(',', $departmentIdArray);
    $finalAuthority = $_POST['finalAuthority'];
    $updatedDateTime = date('Y-m-d H:i:s');

    $query = mysqli_query($conn, "UPDATE nocTypes 
        SET type = '$type', 
            departmentId = '$departmentIdString', 
            finalAuthority = '$finalAuthority',
            updatedDateTime = '$updatedDateTime' 
        WHERE id = '$id'");
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script></head>
    <body>
    <script>
        Swal.fire({
            icon: '<?php echo $query ? "success" : "error"; ?>',
            title: '<?php echo $query ? "Updated!" : "Oops..."; ?>',
            text: '<?php echo $query ? "NOC Type updated successfully" : "Update failed! Please try again."; ?>',
        }).then(() => {
            window.location.href = 'nocType.php';
        });
    </script>
    </body>
    </html>
    <?php
    exit;
}

// ---------------- DELETE ----------------
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = mysqli_query($conn, "DELETE FROM nocTypes WHERE id = '$id'");
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script></head>
    <body>
    <script>
        Swal.fire({
            icon: '<?php echo $query ? "success" : "error"; ?>',
            title: '<?php echo $query ? "Deleted!" : "Oops..."; ?>',
            text: '<?php echo $query ? "NOC Type deleted successfully" : "Delete failed! Please try again."; ?>',
        }).then(() => {
            window.location.href = 'nocType.php';
        });
    </script>
    </body>
    </html>
    <?php
    exit;
}
?>
