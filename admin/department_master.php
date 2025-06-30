<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->


<head>
    <base href="../">
    <title>Saul Theme by Keenthemes</title>
    <meta charset="utf-8" />
    <meta name="description" content="Saul HTML Free - Bootstrap 5 HTML Multipurpose Admin Dashboard Theme" />
    <meta name="keywords"
        content="Saul, bootstrap, bootstrap 5, dmin themes, free admin themes, bootstrap admin, bootstrap dashboard" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <?php include('../include/conn.php');
     include("../include/cssLinks.php"); ?>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_app_body" data-kt-app-header-fixed="true" data-kt-app-header-fixed-mobile="true"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
    data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true"
    data-kt-app-aside-enabled="true" data-kt-app-aside-fixed="true" data-kt-app-aside-push-toolbar="true"
    data-kt-app-aside-push-footer="true" class="app-default">
    <!--end::Theme mode setup on page load-->
    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!--begin::Header-->
            <?php
            include("../include/header.php");
            ?>
            <!--end::Header-->
            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <!--begin::Sidebar-->
                <?php include("../include/sidebar.php"); ?>
                <!--end::Sidebar-->
                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">
                        <!--begin::Toolbar-->
                        <div id="kt_app_toolbar" class="app-toolbar pt-5">
                            <!--begin::Toolbar container-->
                            <div id="kt_app_toolbar_container"
                                class="app-container container-fluid d-flex align-items-stretch">
                                <!--begin::Toolbar wrapper-->
                                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                                    <!--begin::Page title-->
                                    <div class="page-title d-flex flex-column gap-1 me-3 mb-2">
                                        <!--begin::Breadcrumb-->
                                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold mb-6">
                                            <!--begin::Item-->
                                            <li class="breadcrumb-item text-gray-700 fw-bold lh-1">
                                                <a href="../dist/index.html" class="text-gray-500">
                                                    <i class="ki-duotone ki-home fs-3 text-gray-400 me-n1"></i>
                                                </a>
                                            </li>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <li class="breadcrumb-item">
                                                <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
                                            </li>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <li class="breadcrumb-item text-gray-700 fw-bold lh-1">Blank</li>
                                            <!--end::Item-->
                                        </ul>
                                        <!--end::Breadcrumb-->
                                        <!--begin::Title-->
                                        <h1
                                            class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">
                                            Blank</h1>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Page title-->
                                </div>
                                <!--end::Toolbar wrapper-->
                            </div>
                            <!--end::Toolbar container-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Content-->
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <!--begin::Content container-->
                            <div id="kt_app_content_container" class="app-container container-fluid">
                                <!--begin::Contact-->
                                <div class="card">
                                    <!--begin::Body-->
 <div class="row">
            
          <?php if (isset($_REQUEST['edit'])) {
            $id = $_REQUEST['edit'];
            $query = mysqli_query($conn,"select * from departments WHERE id = $id");
            $result = mysqli_fetch_assoc($query);
           ?>
           <?php } ?>

                   <div class="col-md-12 col-sm-12 p-4">
  <h3 class="mb-4 text-center">विभाग निर्मिती</h3>
  <form action="admin/department_master_DB.php" method="POST">
    <div class="row">
      <!-- department Name -->

      <div class="mb-10">
    <label for="exampleFormControlInput1" class="required form-label">Symbol in label</label>
    <input type="email" class="form-control form-control-solid" placeholder="Example input"/>
</div>
      <div class="col-md-4 mb-3">
        <label for="fullname" class="form-label">Department</label>
        <input type="text" value="<?php echo $result['departmentName'];  ?>" name="departmentName" id="Department" class="form-control" required placeholder="Department">
      </div>


    </div>
  <?php if (isset($_REQUEST['edit'])) { ?>
        <input type="hidden" name="id" value="<?php echo $result['id']; ?>">

  <button type="submit" name="update" class="btn btn-warning w-100 mt-3">Update</button>
<?php } else { ?>
  <button type="submit" name="submit" class="btn btn-primary w-100 mt-3">Submit</button>
<?php } ?>
  </form>

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
          $result = mysqli_query($conn,"select * from departments WHERE status = 'Active'") or die($conn->error);
          $i = 1;
          while($row = mysqli_fetch_assoc($result)){

          
          ?>
       <tr>
        <td><?php echo $i++ ?></td>
        <td><?php echo $row['departmentName'] ?></td>
        <td>
          <a href="admin/department_master.php?edit=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning me-1">
                    <i class="fas fa-edit"></i>
                  </a>
                 <a href="admin/department_master_DB.php?delete=<?php echo $row['id']; ?>" 
   class="btn btn-sm btn-danger" 
   onclick="return confirm('Are you sure you want to mark this department as Inactive?');">
   <i class="fas fa-trash-alt"></i>
</a>

        </td>
       </tr>
       <?php } ?>
        
      </tbody>
    </table>
  </div>
            
            
          </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Contact-->
                            </div>
                            <!--end::Content container-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Content wrapper-->
                    <!--begin::Footer-->
                    <?php
                    include('../include/footer.php')
                        ?>
                    <!--end::Footer-->
                </div>
                <!--end:::Main-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::App-->
    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-duotone ki-arrow-up">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </div>
    <!--end::Scrolltop-->

    <?php
    include('../include/jsLinks.php')
        ?>
</body>
<!--end::Body-->

</html>


