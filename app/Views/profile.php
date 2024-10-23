<?= $this->extend('layout/dashboard-layout') ?>

<?= $this->section('content') ?>
  
    <!-- Our LogIn Area -->
    <div class="row align-items-center justify-content-between pb40">
        <div class="col-lg-6">
          <div class="dashboard_title_area">
            <h2>Profile</h2>
            <p class="text">You can see and edit you account details here</p>
          </div>
        </div>
      </div>
          <div class="row">
            <div class="col-sm-4 col-xxl-9">
                <div class="row statistics_funfact">
                  <div class="col-sm-4 col-xxl-4">
                      <label for="firstname">First Name</label>
                      <input type="text" id="firstname" name="firstname" class="form-control">
                  </div>                             
                  <div class="col-sm-4 col-xxl-4">
                    <label for="lastname">Last Name</label>
                    <input type="text" id="lastname" name="lastname" class="form-control">
                  </div>
                  <div class="col-sm-4 col-xxl-4">
                  <div class="card p-4 shadow-sm" style="width: 300px;">
                    <div class="profile-pic-wrapper text-center mb-3">
                      <div class="profile-pic rounded-circle overflow-hidden mx-auto">
                        <img id="profileImage" 
                            src="<?= base_url('assets/images/default_user.png') ?>" 
                            alt="Profile Picture" 
                            class="img-fluid">
                      </div>
                    </div>
                    <div class="text-center">
                      <label class="btn btn-outline-primary btn-sm">
                        <input type="file" id="uploadImage" class="d-none" accept="image/*"> 
                        Upload New Image
                      </label>
                    </div>
                  </div>
                  </div>                             
                  <div class="col-sm-4 col-xxl-4">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control">
                  </div>
                  <div class="col-sm-4 col-xxl-4">
                    <label for="mobile">Mobile</label>
                    <input type="tel" id="mobile" name="mobile" class="form-control">
                  </div>
                  <div class="col-sm-4 col-xxl-4">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control">
                  </div>
                  <div class="col-sm-4 col-xxl-4">
                    <label for="address">Address</label>
                    <textarea id="address" name="address" class="form-control"> </textarea>
                  </div>
                  <div class="col-sm-4 col-xxl-4">
                    <label for="state">State</label>
                    <input type="text" id="state" name="state" class="form-control">
                  </div>
                  <div class="col-sm-4 col-xxl-4">
                    <label for="city">City</label>
                    <input type="text" id="city" name="city" class="form-control">
                  </div>
                  <div class="col-sm-4 col-xxl-4">
                    <label for="pincode">Picnode</label>
                    <input type="text" id="pincode" name="pincode" class="form-control">
                  </div>
                  <div class="col-sm-4 col-xxl-12 mt-2">                    
                    <input type="button" id="update_profile" name="update_profile" class="ud-btn btn-dark" value="Update Profile">
                  </div>
              </div>
            </div>     
            <div class="col-sm-6 col-xxl-3">
              <div class="d-flex align-items-center justify-content-between statistics_funfact">
                <div class="details">
                  <div class="fz15">Digital ID Card</div>
                  <div class="row" style="background-color: #1d72ee;color: #fff;">
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



<?= $this->endSection() ?>
