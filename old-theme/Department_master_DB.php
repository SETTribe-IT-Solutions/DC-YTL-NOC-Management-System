<?php
include('include/conn.php');

if (isset($_POST['submit'])) {
    date_default_timezone_set('Asia/Kolkata');
    $departmentName = $_POST['departmentName'];
    $dateTime = date('Y-m-d H:i:s');

    $query = mysqli_query($conn, "INSERT INTO department(`departmentName`, `dateTime`) VALUES ('$departmentName', '$dateTime')");


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
            window.location.href = '<?php echo $query ? "Department_master.php" : "javascript:history.back()"; ?>';
        });
    </script>
    </body>
    </html>
    <?php
}
?>
