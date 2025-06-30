<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header('location:../login.php');
    exit;
    die();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>

<body>
    Hi, <?php echo $_SESSION['userId']; ?>
</body>

</html>