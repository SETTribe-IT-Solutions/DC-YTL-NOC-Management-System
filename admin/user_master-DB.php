<?php
include('../include/conn.php');

date_default_timezone_set('Asia/Kolkata');

if (isset($_POST['submit'])) {
    // Handle possible array and undefined keys
    $departmentId  = isset($_POST['departmentId']) ? (is_array($_POST['departmentId']) ? implode(',', $_POST['departmentId']) : $_POST['departmentId']) : '';
    $name = $_POST['name'] ?? '';
    $mobileNo = $_POST['mobileNo'] ?? '';
    $password = $_POST['password'] ?? '';
  $designation = $_POST['designation'] ?? '';

    // Generate unique userId
    $userId = uniqid('user_');

    $DateTime = date('Y-m-d H:i:s');

    $query = mysqli_query($conn, "INSERT INTO users (`departmentId`, `name`, `mobileNo`, `password`, `designation`, `userId`, `dateTime`) 
        VALUES ('$departmentId','$name','$mobileNo', '$password','$designation', '$userId', '$DateTime')
    ");
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script></head>
    <body>
    <script>
        Swal.fire({
            icon: '<?php echo $query ? "success" : "error"; ?>',
            title: '<?php echo $query ? "Success!" : "Oops..."; ?>',
            text: '<?php echo $query ? "User created successfully." : "Something went wrong! Please try again."; ?>',
        }).then(() => {
            window.location.href = '<?php echo $query ? "user_master.php" : "javascript:history.back()"; ?>';
        });
    </script>
    </body>
    </html>
    <?php
}

if (isset($_POST['update'])) {
    $id = $_POST['id'] ?? '';
    $departmentId = $_POST['departmentId'] ?? '';
    $name = $_POST['name'] ?? '';
    $mobileNo = $_POST['mobileNo'] ?? '';
    $password = $_POST['password'] ?? '';
    $designation = $_POST['designation'] ?? '';
    $userId = 'userId_001'; // Could be changed if needed
    $updateDateTime = date('Y-m-d H:i:s');

    $query = mysqli_query($conn, "
        UPDATE users 
        SET departmentId = '$departmentId', 
            name = '$name', 
            mobileNo = '$mobileNo', 
            password = '$password', 
            designation = '$designation', 
            userId = '$userId', 
            updateDateTime = '$updateDateTime' 
        WHERE id = '$id'
    ");
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script></head>
    <body>
    <script>
        Swal.fire({
            icon: '<?php echo $query ? "success" : "error"; ?>',
            title: '<?php echo $query ? "Updated!" : "Oops..."; ?>',
            text: '<?php echo $query ? "User updated successfully." : "Something went wrong!"; ?>',
        }).then(() => {
            window.location.href = '<?php echo $query ? "department_master.php" : "javascript:history.back()"; ?>';
        });
    </script>
    </body>
    </html>
    <?php
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = mysqli_query($conn, "UPDATE users SET status = 'Inactive' WHERE id = '$id'");
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script></head>
    <body>
    <script>
        Swal.fire({
            icon: '<?php echo $query ? "success" : "error"; ?>',
            title: '<?php echo $query ? "Deleted!" : "Oops..."; ?>',
            text: '<?php echo $query ? "User marked as Inactive." : "Something went wrong!"; ?>',
        }).then(() => {
            window.location.href = 'user_master.php';
        });
    </script>
    </body>
    </html>
    <?php
}
?>
