<?= $this->extend('layout/dashboard-layout') ?>

<?= $this->section('content') ?>
  


<!-- Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createUserModalLabel">Create User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
                <label for="form-label">First Name</label>
                <input type="text" id="firstname" name="firstname">
            </div>
            <div class="col-md-6">
                <label for="form-label">Last Name</label>
                <input type="text" id="lastname" name="lastname">
            </div>
            <div class="col-md-6">
                <label for="form-label">Email</label>
                <input type="email" id="email" name="email">
            </div>
            <div class="col-md-6">
                <label for="form-label">Phone Number</label>
                <input type="tel" id="phone" name="phone">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="ud-btn btn-light" data-bs-dismiss="modal">Close</button>
        <button type="button" class="ud-btn btn-dark">Save changes</button>
      </div>
    </div>
  </div>
</div>

    <!-- Our LogIn Area -->
                        <div class="row align-items-center justify-content-between pb40">
                          <div class="col-lg-6">
                            <div class="dashboard_title_area">
                              <h2>Users</h2>
                              <p class="text">You can View , Edit Users</p>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="text-lg-end">
                              <button  type="button" class="ud-btn btn-dark default-box-shadow2" data-bs-toggle="modal" data-bs-target="#createUserModal" >Create User<i class="fal fa-arrow-right-long"></i></button>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        <h4 class="card-title">Users</h4>
        
                                        <table id="" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                            </thead>
        
        
                                            <tbody>
                                            <tr>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                            </tr>
                                      </tbody>
                                        </table>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        <script>
                           function getTableData(tableName , tableType) {
        // Destroy any existing DataTable instance to avoid conflicts
        if ($.fn.DataTable.isDataTable("#" + tableName)) {
            $("#" + tableName).DataTable().destroy();
        }


        // Initialize or reinitialize the DataTable
        $("#" + tableName).DataTable({
            ajax: {
                url: 'view-entry-fetch-data', // Replace with the correct path to your PHP script
                type: 'GET',
                dataSrc: 'data',
                data: function(d) {
                    d.tableType = tableType; 
                }
            },
            "ordering": true,
            order: [],
            columns: [
                { data: 'entry_id', responsivePriority: 2 },         // Lower priority for responsive view
            { data: 'received_date', responsivePriority: 2 },    // Highest priority to be always visible
            { data: 'received_by', responsivePriority: 2 },    // Highest priority to be always visible
            { data: 'customer_name', responsivePriority: 1 },    // Always visible
            { data: 'brand_model', responsivePriority: 0 },      // Make this the control column for the plus icon
            { data: 'status', responsivePriority: 1 },
            { data: 'defects', responsivePriority: 0 },          // This will also trigger the plus icon
            { data: 'contact', responsivePriority: 1 },
            { data: 'action', responsivePriority: 1 },
            ],
            language: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'></i>",
                    next: "<i class='mdi mdi-chevron-right'></i>"
                }
            },
            scrollX: true, 
            responsive: true, 
            autoWidth: false,   
            drawCallback: function() {
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded");

                $('.nav-tabs-custom').find('li a').removeClass('active');
                console.log(tableType);
                $('#'+tableType+'Table a').addClass('active');

            }
        });

        $('#' + tableName + ' tbody').on('click', 'tr', function() {
        $('#' + tableName + ' tr').removeClass('highlight');
        
        $(this).addClass('highlight');
    });
        
    }

getTableData('datatable-users','pending');
                        </script>

<?= $this->endSection() ?>
