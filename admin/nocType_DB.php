<?php
include('../include/conn.php');

if (isset($_POST['submit'])) {
        date_default_timezone_set('Asia/Kolkata');
    $type = $_POST['type'];
      $departmentIdArray = $_POST['departmentId']; // This is an array
    $departmentIdString = implode(',', $departmentIdArray); // Converts [2, 4, 5] → "2,4,5"
    $userId = 'userId_001';
    $createdDateTime = date('Y-m-d H:i:s');

          $query = mysqli_query($conn, "INSERT INTO nocTypes (`type`, `departmentId`, `userId`, `createdDateTime`) 
        VALUES ('$type', '$departmentIdString', '$userId', '$createdDateTime')");




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
            text: '<?php echo $query ? "NOC Type created successfully" : "Something went wrong! Please try again."; ?>',
        }).then(() => {
            window.location.href = '<?php echo $query ? "nocType.php" : "javascript:history.back()"; ?>';
        });
    </script>
    </body>
    </html>
    <?php
}
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $query = mysqli_query($conn, "UPDATE nocTypes SET status = 'Inactive' WHERE id = '$id'");

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
            text: '<?php echo $query ? "NOC Type marked as Inactive." : "Something went wrong!"; ?>',
        }).then(() => {
            window.location.href = 'nocType.php';
        });
    </script>
    </body>
    </html>
    <?php
}
?>