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
          <form class="row" id="newUserForm">
            <div class="col-md-6">
                <label for="form-label">First Name</label>
                <input type="text" id="firstName" name="firstname" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="form-label">Last Name</label>
                <input type="text" id="lastName" name="lastname" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="form-label">Phone Number</label>
                <input type="tel" id="phone" name="phone" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="form-label">Username</label>
                <input type="text" id="username" name="usernames" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="form-label">Password</label>
                <input type="text" id="password" name="password" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="form-label">Role</label>
                <select name="user-role" id="user-role" class="form-select">
                  <option value="">--select--</option>
                  <option value="User">User</option>
                </select>
            </div>
            <div class="col-md-6 mt-2">
                  <div>
                  <label for="form-label">Status</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="status1" value="1" checked>
                    <label class="form-check-label" for="inlineRadio1">Active</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="status2" value="0">
                    <label class="form-check-label" for="inlineRadio2">InActive</label>
                  </div>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="ud-btn btn-light" data-bs-dismiss="modal">Close</button>
        <button type="button" class="ud-btn btn-dark" onclick="addUser()">Save changes</button>
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
        
                                        <table id="datatable-users" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Phone Number</th>
                                                <th>status</th>
                                                <th>Role</th>                                                
                                            </tr>
                                            </thead>
              
                                            <tbody>
                                            </tbody>
                                        </table>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        <script>
                           function getTableData(tableName , tableType) {        
        if ($.fn.DataTable.isDataTable("#" + tableName)) {
            $("#" + tableName).DataTable().destroy();
        }
        $("#" + tableName).DataTable({
            ajax: {
                url: '/fetchUsers', 
                type: 'GET',
                dataSrc: 'data',
                data: function(d) {
                    d.tableType = tableType; 
                }
            },
            "ordering": true,
            order: [],
            columns: [
                { data: 'name', responsivePriority: 2 },        
                { data: 'username', responsivePriority: 0 }, 
                { data: 'email', responsivePriority: 2 },    
                { data: 'phone_number', responsivePriority: 2 },
                { data: 'status', responsivePriority: 1 },  
                { data: 'role', responsivePriority: 0 },    
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
                console.log(tableType);

            }
        });

        $('#' + tableName + ' tbody').on('click', 'tr', function() {
        $('#' + tableName + ' tr').removeClass('highlight');
        
        $(this).addClass('highlight');
    });
        
    }

getTableData('datatable-users','pending');

const addUser = ()=>{

  let firstName = $('#firstName').val();
let lastName = $('#lastName').val();
let username = $('#username').val();
let phone = $('#phone').val();
let email = $('#email').val();
let password = $('#password').val();
let role = $('#user-role').val();
let status = $('input[name="status"]:checked').val();

  $.ajax({
    url:'/addUser',
    data:{firstName:firstName , lastName:lastName , username:username,  email:email , password:password , role:role , status:status , phone:phone },
    type:'post',
    success:function(data){
      if(data.status=='success'){
        $('.toast-success').css('left','unset');   
        $('.toast-success').css('right','2rem');
        $('.toast-success .toast-body').html(data.message);
        getTableData('datatable-users','pending');
        $('#createUserModal').modal('hide');
        $('#newUserForm')[0].reset();
      setTimeout(() => {
          $('.toast-success').css('left','100%');   
          $('.toast-success').css('right','unset');   
      }, 2000);
      }else{
        console.log('error')
      }
      
    }
  })
}

                        </script>

<?= $this->endSection() ?>
