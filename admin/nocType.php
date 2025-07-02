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
    <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>

    <?php
    include('../include/conn.php');
    include("../include/cssLinks.php");
     ?>
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
                <?php include("../include/admin-sidebar.php"); ?>
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
                                            <li class="breadcrumb-item text-gray-700 fw-bold lh-1">NOC प्रकार निर्मिती</li>
                                            <!--end::Item-->
                                        </ul>
                                        <!--end::Breadcrumb-->
                                        <!--begin::Title-->
                                        <h1
                                            class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">
                                            NOC प्रकार निर्मिती</h1>
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
                                <div class="card p-lg-17">
                                    <!--begin::Body-->
                                    <div class="row mb-3">
                                        <?php if (isset($_REQUEST['edit'])) {
            $id = $_REQUEST['edit'];
            $query = mysqli_query($conn,"select * from nocTypes WHERE id = $id");
            $result = mysqli_fetch_assoc($query);
              $selectedDepartments = explode(',', $result['departmentId']);
           ?>
           <?php } ?>
                                        <!--begin::Col-->
                                        <div class="col-md-12 pe-lg-10">
                                            <!--begin::Form-->
                                            <form action="admin/nocType_DB.php"  class="form mb-15 fv-plugins-bootstrap5 fv-plugins-framework" method="POST" id="kt_contact_form">
                                                <h1 class="fw-bold text-gray-900 mb-9">NOC प्रकार निर्मिती</h1>

                                                <!--begin::Input group-->
                                             
                                                
                                                <div class="row mb-5">
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row fv-plugins-icon-container">
                                                        <!--begin::Label-->
                                                        <label class="fs-5 fw-semibold mb-2">NOC Type</label>
                                                        <!--end::Label-->

                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid"
                                                            placeholder="NOC Type" value="<?php echo $result['type'];  ?>" name="type">
                                                        <!--end::Input-->
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                    <!--end::Col-->

                                                    <!--begin::Col-->
                                                    
<div class="col-md-6 fv-row fv-plugins-icon-container">
    <label class="fs-5 fw-semibold mb-2">Department</label>

    <select class="form-select form-select-solid rounded-start-0 border-start"
            data-control="select2"
            data-placeholder="Select an option"
            name="departmentId[]" multiple="multiple" required>
        <option></option>

         <?php
    // Fetch all active departments
    $deptResult = mysqli_query($conn, "SELECT id, departmentName FROM departments WHERE status = 'Active'");
    while ($rows = mysqli_fetch_assoc($deptResult)) {
        // Check if this department ID is in the selected list
                                                         if (isset($_REQUEST['edit'])) { 
        $selected = in_array($rows['id'], $selectedDepartments) ? 'selected' : '';

                                                         }

        echo '<option value="' . $rows['id'] . '" ' . $selected . '>' . $rows['departmentName'] . '</option>';
    }
    ?>
    </select>
</div>
                                                    <!--end::Col-->
                                                    
                                                </div>
                                                <?php if (isset($_REQUEST['edit'])) { ?>
        <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
         <button href="#" type="submit" name="update" class="btn btn-warning">Update</button>
         <?php } else { ?>
        <button href="#" class="btn btn-success" type="submit" name="submit">Submit</button>
        <?php } ?>
                                               
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                          
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                             
                                                <!--end::Input group-->

                                                <!--begin::Submit-->
                                              
                                                <!--end::Submit-->
                                            </form>
                                            <!--end::Form-->

                                            
                                        </div>
                                        <!--end::Col-->
                                        <div class="card card-p-0 card-flush">
	<div class="card-header align-items-center py-5 gap-2 gap-md-5">
		<div class="card-title">
			<!--begin::Search-->
			<div class="d-flex align-items-center position-relative my-1">
				<span class="svg-icon fs-1 position-absolute ms-4"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
</svg></span>
				<input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Report" />
			</div>
			<!--end::Search-->
			<!--begin::Export buttons-->
			<div id="kt_datatable_example_1_export" class="d-none"></div>
			<!--end::Export buttons-->
		</div>
		
	</div>
	<div class="card-body">
		<table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="kt_datatable_example">
			<thead>
				<!--begin::Table row-->
				<tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
					<th class="min-w-100px">SR . NO</th>
					<th class="min-w-100px">NOC Type</th>
					<th class="min-w-100px">Deprtment</th>
					<th class="min-w-100px">Action</th>
					
				</tr>
				<!--end::Table row-->
			</thead>
			<tbody class="fw-semibold text-gray-600">
                  <?php
       $result = mysqli_query($conn, "
    SELECT n.id, n.type, n.departmentId, 
           GROUP_CONCAT(d.departmentName SEPARATOR ', ') AS departmentNames
    FROM nocTypes n
    LEFT JOIN departments d ON FIND_IN_SET(d.id, n.departmentId)
    WHERE n.status = 'Active'
    GROUP BY n.id
");

          $i = 1;
          while($row = mysqli_fetch_assoc($result)){


          
          ?>
				<tr class="odd">
					<td><?php echo $i++ ?></td>
					<td><?php echo $row['type'] ?></td>
					<td><?php echo $row['departmentNames'] ?></td>
					<td data-order="2022-03-10T14:40:00+05:00">
                        <a href="admin/nocType.php?edit=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning me-1">
                    <i class="fas fa-edit"></i>
                  </a>
                <a href="#" 
   class="btn btn-sm btn-danger delete-btn" 
   data-href="admin/nocType_DB.php?delete=<?php echo $row['id']; ?>">
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

        <script>
            "use strict";

// Class definition
var KTDatatablesExample = function () {
    // Shared variables
    var table;
    var datatable;

    // Private functions
    var initDatatable = function () {
        // Set date data order
        const tableRows = table.querySelectorAll('tbody tr');

        tableRows.forEach(row => {
            const dateRow = row.querySelectorAll('td');
            const realDate = moment(dateRow[3].innerHTML, "DD MMM YYYY, LT").format(); // select date from 4th column in table
            dateRow[3].setAttribute('data-order', realDate);
        });

        // Init datatable --- more info on datatables: https://datatables.net/manual/
        datatable = $(table).DataTable({
            "info": false,
            'order': [],
            'pageLength': 10,
        });
    }

    // Hook export buttons
    var exportButtons = () => {
        const documentTitle = 'Customer Orders Report';
        var buttons = new $.fn.dataTable.Buttons(table, {
            buttons: [
                {
                    extend: 'copyHtml5',
                    title: documentTitle
                },
                {
                    extend: 'excelHtml5',
                    title: documentTitle
                },
                {
                    extend: 'csvHtml5',
                    title: documentTitle
                },
                {
                    extend: 'pdfHtml5',
                    title: documentTitle
                }
            ]
        }).container().appendTo($('#kt_datatable_example_buttons'));

        // Hook dropdown menu click event to datatable export buttons
        const exportButtons = document.querySelectorAll('#kt_datatable_example_export_menu [data-kt-export]');
        exportButtons.forEach(exportButton => {
            exportButton.addEventListener('click', e => {
                e.preventDefault();

                // Get clicked export value
                const exportValue = e.target.getAttribute('data-kt-export');
                const target = document.querySelector('.dt-buttons .buttons-' + exportValue);

                // Trigger click event on hidden datatable export buttons
                target.click();
            });
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }

    // Public methods
    return {
        init: function () {
            table = document.querySelector('#kt_datatable_example');

            if ( !table ) {
                return;
            }

            initDatatable();
            exportButtons();
            handleSearchDatatable();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTDatatablesExample.init();
});
        </script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(btn => {
      btn.addEventListener('click', function (e) {
        e.preventDefault(); // prevent default <a> behavior
        const href = this.getAttribute('data-href');

        Swal.fire({
          title: "Are you sure?",
          text: "you want to delete NOC Type?",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = href;
          }
        });
      });
    });
  });
</script>

</body>
<!--end::Body-->


</html>