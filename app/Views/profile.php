<?= $this->extend('layout/dashboard-layout') ?>

<?= $this->section('content') ?>
  
    <!-- Our LogIn Area -->
    <div class="row align-items-center justify-content-between pb40">
        <div class="col-lg-6">
          <div class="dashboard_title_area">
            <h2>Profile</h2>
            <p class="text">You can see and edit you account details here. testing</p>
          </div>
        </div>
      </div>
          <div class="row">
            <div class="col-sm-4 col-xxl-9 statistics_funfact">
                <div class="row">                  
                    <div class="col-sm-4 col-xxl-8 row">
                      <div class="col-sm-4 col-xxl-6">
                          <label for="firstname">First Name</label>                          
                          <input type="text" id="firstName" name="firstName" class="form-control" value="<?=$user['first_name']?>">
                      </div>                             
                      <div class="col-sm-4 col-xxl-6">
                        <label for="lastname">Last Name</label>
                        <input type="text" id="lastName" name="lastName" class="form-control" value="<?=$user['last_name']?>">
                      </div>                                  
                      <div class="col-sm-4 col-xxl-6">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?=$user['email']?>">
                      </div>
                      <div class="col-sm-4 col-xxl-6">
                        <label for="mobile">Mobile</label>
                        <input type="tel" id="mobile" name="mobile" class="form-control" value="<?=$user['phone_number']?>">
                      </div>
                      <div class="col-sm-4 col-xxl-6">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control" value="<?=$user['username']?>" readonly>
                      </div>
                      <div class="col-sm-4 col-xxl-6">
                        <label for="address">Address</label>
                        <textarea id="address" name="address" class="form-control" ><?=$user['address']?> </textarea>
                      </div>
                    </div>  
                    <div class="col-sm-4 col-xxl-4 row">
                        <div class="col-sm-4 col-xxl-12">
                          <div class="card p-4 shadow-sm">
                            <div class="profile-pic-wrapper text-center mb-3">
                              <div class="profile-pic rounded-circle overflow-hidden mx-auto">
                                <img id="profileImage" 
                                    src="<?=$user['profile_picture'] == '' ? base_url('assets/images/default_user.png') :$user['profile_picture']  ?>" 
                                    alt="Profile Picture" 
                                    class="img-fluid">
                              </div>
                            </div>
                            <div class="text-center">
                              <label class="btn btn-outline-primary btn-sm">
                                <input type="hidden" name="profile_picture_path" id="profile_picture_path" value="<?=$user['profile_picture']?>">
                                <input type="file" id="uploadImage" class="d-none" accept="image/*" onchange="uploadProfilePicture()"> 
                                Upload New Image
                              </label>
                            </div>
                          </div>
                        </div>  
                    </div>
                  </div>
                  <div class="row">
                  <div class="col-sm-4 col-xxl-4">
                    <label for="state">State</label>
                    <input type="text" id="state" name="state" class="form-control" value="<?=$user['state']?>">
                  </div>
                  <div class="col-sm-4 col-xxl-4">
                    <label for="city">City</label>
                    <input type="text" id="city" name="city" class="form-control" value="<?=$user['city']?>">
                  </div>
                  <div class="col-sm-4 col-xxl-4">
                    <label for="pincode">Picnode</label>
                    <input type="text" id="zip_code" name="zip_code" class="form-control" value="<?=$user['pincode']?>">
                  </div>
                  <div class="col-sm-4 col-xxl-12 mt-2">                    
                    <input type="button" id="update_profile" name="update_profile" class="ud-btn btn-dark" value="Update Profile" onclick="updateProfile()">
                  </div>
              </div>
            </div>     
            <div class="col-sm-6 col-xxl-3">
              <div class="d-flex align-items-center justify-content-between statistics_funfact">
                <div class="details">
                  <div class="fz15">Digital ID Card</div>
                  <div class="row" style="background-color: #1d 72ee;color: #fff;">
                    <div class="col-md-12" style="display: flex;justify-content: space-between;padding: 1.2rem;">
                        <div>
                          Company Name
                        </div>
                        <div>
                          Logo
                        </div>
                    </div>
                    <div class="col-md-12" style="padding:1rem;background-color: #0054aa;">
                        <div class="row">
                          <div class="col-md-6 id-details">
                            <div>Person Name</div>
                            <div class="id-side"><div class="id-side-title">Department</div><div>Marketing</div></div>
                            <div class="id-side"><div class="id-side-title">ID Number</div><div>TY64654</div></div>
                            <div class="id-side"><div class="id-side-title">Email</div><div>test@gmail.com</div></div>
                          </div>
                          <div class="col-md-6">
                            <img src="<?= base_url('assets/images/default_user.png') ?>" alt="" style="max-width:120px;">
                          </div>
                        </div>                      
                    </div>
                    <div class="col-md-12 p-3 text-center">
                      <img src="<?= base_url('assets/images/qr_code_dummy.png') ?>" width="165" alt="">
                    </div>
                  </div>                                    
                </div>
              </div>
            </div>                           
          </div>          

<script>
    const uploadProfilePicture = ()=>{
        const image = $('#uploadImage').prop('files')[0];
        const formData = new FormData();
        formData.append('image',image);
        $.ajax({
          type:'post',
          data:formData,
          contentType: false, 
          processData: false,
          url:'/fileUpload',
          success:function(data){
            console.log(data.status);
            if(data.status=='success'){
              console.log(data);
                $('#profileImage').attr('src',data.path);
                $('#profile_picture_path').val(data.path);
            }
          }
        })
    }

    const updateProfile = () => {
    let firstName = $('#firstName').val();
    let lastName = $('#lastName').val();
    let phone = $('#mobile').val();
    let email = $('#email').val();
    let state = $('#state').val();
    let city = $('#city').val();
    let profile_picture_path = $('#profile_picture_path').val();
    let address = $('#address').val();
    let pincode = $('#zip_code').val();

    $.ajax({
        url: '/updateProfile',
        data: {
            firstName: firstName,
            lastName: lastName,
            email: email,
            phone: phone,
            state: state,
            city: city,
            address: address,
            profile_picture_path: profile_picture_path,
            pincode: pincode
        },
        type: 'post',
        success: function(data) {
            if (data.status == 'success') {
                $('.toast-success').css('left', 'unset');   
                $('.toast-success').css('right', '2rem');
                $('.toast-success .toast-body').html(data.message);
                $('#updateProfileModal').modal('hide');
                $('#updateProfileForm')[0].reset();
                setTimeout(() => {
                    $('.toast-success').css('left', '100%');   
                    $('.toast-success').css('right', 'unset');   
                }, 2000);
            } else {
                console.log('error');
                $('.toast-error').css('left', 'unset');
                $('.toast-error').css('right', '2rem');
                $('.toast-error .toast-body').html('Error updating profile');
                setTimeout(() => {
                    $('.toast-error').css('left', '100%');
                    $('.toast-error').css('right', 'unset');
                }, 2000);
            }
        }
    });
}



</script>

<?= $this->endSection() ?>
