<?php
include('../include/conn.php'); 
echo "<option value='' selected>गाव निवडा</option>";
if(isset($_POST['taluka'])) {
$taluka = $_POST['taluka'];

$query = mysqli_query($conn,"select village from taluka where taluka='$taluka'") or die($conn->error);
while($fetchs = mysqli_fetch_assoc($query)) { ?>
<option><?php echo $fetchs['village'] ?></option>
<?php
}
}
?>