<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>

    <!-- Our LogIn Area -->
    <section class="our-login">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 m-auto wow fadeInUp" data-wow-delay="300ms">
            <div class="main-title text-center">
              <h2 class="title">Log In</h2>
              <!-- <p class="paragraph">Give your visitor a smooth online experience with a solid UX design</p> -->
            </div>
          </div>
        </div>
        <div class="row wow fadeInRight" data-wow-delay="300ms">
          <div class="col-xl-6 mx-auto">
            <div class="log-reg-form search-modal form-style1 bgc-white p50 p30-sm default-box-shadow1 bdrs12">
              <div class="mb30">
                <h4>We're glad to see you again!</h4>
                <!-- <p class="text">Don't have an account? <a href="/register" class="text-thm">Sign Up!</a></p> -->
              </div>
              <div class="mb20">
                <label class="form-label fw600 dark-color">Email Address</label>
                <input type="email" class="form-control" id="email" placeholder="..... @gmail.com" value="<?= isset($rememberedEmail) ? esc($rememberedEmail) : '' ?>">
                <div class="error-message" id="emailError">Invalid Email Address</div>                
              </div>
              <div class="mb15">
                <label class="form-label fw600 dark-color">Password</label>
                <input type="text" class="form-control" id="password" placeholder="*******" >
                <div class="error-message" id="passwordError">Invalid Email Address</div>      
              </div>
              <div class="checkbox-style1 d-block d-sm-flex align-items-center justify-content-between mb20">
                <label class="custom_checkbox fz14 ff-heading">Remember me
                  <input type="checkbox" <?= isset($rememberedEmail) ? 'checked' : '' ?>>
                  <span class="checkmark"></span>
                </label>
                <a class="fz14 ff-heading" href="#">Lost your password?</a>
              </div>
              <div class="d-grid mb20">
                <div class="error-message" id="login_error">error</div>
                <button class="ud-btn btn-thm" id="login" type="button">Log In <i class="fal fa-arrow-right-long"></i></button>
              </div>
              <div class="hr_content mb20"><hr><span class="hr_top_text">OR</span></div>
              <div class="d-md-flex justify-content-between">
                <button class="ud-btn btn-fb fz14 fw400 mb-2 mb-md-0" type="button"><i class="fab fa-facebook-f pr10"></i> Continue Facebook</button>
                <button class="ud-btn btn-google fz14 fw400 mb-2 mb-md-0" type="button"><i class="fab fa-google"></i> Continue Google</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?= $this->section('scripts') ?>

    <script>

    $('#login').click(function(){
        let email = $('#email').val();
        var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        let password = $('#password').val();
        var rememberMe = $('#rememberMe').is(':checked');

        if(email=='' || !emailPattern.test(email) || password == '' ){

          if(email==''){
            $('#email').addClass('invalid-feed');
            $('#email').removeClass('valid-feed');
          } else if(!emailPattern.test(email)){
            $('#email').addClass('invalid-feed');
            $('#email').removeClass('valid-feed');
            $('#emailError').show();
          }else{
            $('#email').removeClass('invalid-feed');
            $('#email').addClass('valid-feed');
            $('#emailError').hide();
          }

          if(password==''){
            $('#password').addClass('invalid-feed');
            $('#password').removeClass('valid-feed');
            // $('#passwordError').show();
          }else{
            $('#password').removeClass('invalid-feed');
            $('#password').addClass('valid-feed');
            // $('#passwordError').hide();
          }

        }else{

          $.ajax({
            type:'post',
            data:{email:email , password:password ,  rememberMe: rememberMe},
            url:'/login_validate',
            success:function(data){
              console.log(data.status)
              if(data.status=='error_email'){
                $('#email').addClass('invalid-feed');
                $('#email').removeClass('valid-feed');
                $('#password').removeClass('invalid-feed');
                $('#password').addClass('valid-feed');
                $('#passwordError').hide();
                 $('#emailError').show();
                 $('#emailError').html(data.message);
              }else if(data.status=='error_password'){
                $('#email').removeClass('invalid-feed');
                $('#email').addClass('valid-feed');
                $('#password').addClass('invalid-feed');
                $('#password').removeClass('valid-feed');
                $('#passwordError').show();
                $('#passwordError').html(data.message);       
              }else{
                
                  $('#email').removeClass('invalid-feed');
                  $('#password').removeClass('invalid-feed');
                  $('#email').addClass('valid-feed');
                  $('#password').addClass('valid-feed');
                  $('#emailError').hide();

                  window.location.href = '/admin/dashboard';

              }
            }
          })

        }

    })


    </script>

<?= $this->endSection() ?>

<?= $this->endSection() ?>
