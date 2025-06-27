<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

 <?php
  include('include/conn.php');
  include('include/title.php');
    include('include/cssLinks.php');
  ?>
   
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php include('include/header.php'); ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">      
      
      <?php include('include/sidebar.php'); ?>
      
      <!-- partial -->
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            
          <?php if (isset($_REQUEST['edit'])) {
            $id = $_REQUEST['edit'];
            $query = mysqli_query($conn,"select * from department WHERE id = $id");
            $result = mysqli_fetch_assoc($query);
           ?>
           <?php } ?>

                   <div class="col-md-12 col-sm-12 p-4">
  <h3 class="mb-4 text-center">विभाग निर्मिती</h3>
  <form action="Department_master_DB.php" method="POST">
    <div class="row">
      <!-- department Name -->
      <div class="col-md-4 mb-3">
        <label for="fullname" class="form-label">Department</label>
        <input type="text" value="<?php echo $result['departmentName'];  ?>" name="departmentName" id="Department" class="form-control" required placeholder="Department">
      </div>


    </div>
  <?php if (isset($_REQUEST['edit'])) { ?>
  <button type="submit" name="update" class="btn btn-warning w-100 mt-3">Update</button>
<?php } else { ?>
  <button type="submit" name="submit" class="btn btn-primary w-100 mt-3">Submit</button>
<?php } ?>

</div> 
<!-- Table -->
  <div class="table-responsive mt-5">
    <table class="table table-bordered text-center">
      <thead class="table-dark">
        <tr>
          <th>Sr. No.</th>
          <th>Department</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $result = mysqli_query($conn,"select * from department") or die($conn->error);
          $i = 1;
          while($row = mysqli_fetch_assoc($result)){

          
          ?>
       <tr>
        <td><?php echo $i++ ?></td>
        <td><?php echo $row['departmentName'] ?></td>
        <td>
          <a href="Department_master.php?edit=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning me-1">
                    <i class="fas fa-edit"></i>
                  </a>
                  <a href="Department_master_DB.php<?php echo $row['id']; ?>" class="btn btn-sm btn-danger">
                    <i class="fas fa-trash-alt"></i>
                  </a>
        </td>
       </tr>
       <?php } ?>
        
      </tbody>
    </table>
  </div>
            
            
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php include('include/footer.php'); ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
 <?php include('include/jsLinks.php'); ?>
  <!-- End custom js for this page-->
</body>
</html>
