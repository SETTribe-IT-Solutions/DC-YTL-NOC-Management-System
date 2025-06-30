<?php
include('../include/conn.php');

if (isset($_POST['submit'])) {
    date_default_timezone_set('Asia/Kolkata');
    $departmentName = $_POST['departmentName'];
    $userId = 'userId_001';
    $createdDateTime = date('Y-m-d H:i:s');


    $query = mysqli_query($conn, "INSERT INTO departments (`departmentName`, `userId`, `createdDateTime`) VALUES ('$departmentName', '$userId', '$createdDateTime')");


    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
    <script>
        Swal.fire({
            icon: '<?php echo $query ? "success" : "error"; ?>',
            title: '<?php echo $query ? "Success!" : "Oops..."; ?>',
            text: '<?php echo $query ? "Department created successfully" : "Something went wrong! Please try again."; ?>',
        }).then(() => {
            window.location.href = '<?php echo $query ? "department_master.php" : "javascript:history.back()"; ?>';
        });
    </script>
    </body>
    </html>
    <?php
}



if (isset($_POST['update'])) {
    date_default_timezone_set('Asia/Kolkata');

        $id = $_POST['id'];

    $departmentName = $_POST['departmentName'];
    $userId = 'userId_001';
    $updateDateTime = date('Y-m-d H:i:s');
    $query = mysqli_query($conn, "UPDATE departments 
        SET departmentName = '$departmentName', userId = '$userId', updateDateTime = '$updateDateTime' WHERE id = '$id'");
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
    <script>
        Swal.fire({
            icon: '<?php echo $query ? "success" : "error"; ?>',
            title: '<?php echo $query ? "Updated!" : "Oops..."; ?>',
            text: '<?php echo $query ? "Department updated successfully" : "Something went wrong!"; ?>',
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

    $query = mysqli_query($conn, "UPDATE departments SET status = 'Inactive' WHERE id = '$id'");

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
    <script>
        Swal.fire({
            icon: '<?php echo $query ? "success" : "error"; ?>',
            title: '<?php echo $query ? "Deleted!" : "Oops..."; ?>',
            text: '<?php echo $query ? "Department marked as Inactive." : "Something went wrong!"; ?>',
        }).then(() => {
            window.location.href = 'department_master.php';
        });
    </script>
    </body>
    </html>
    <?php
}
?>




