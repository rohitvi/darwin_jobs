<?php include(VIEWPATH.'users/include/header.php'); ?>
<div class='header_inner '>
    <div class="header_btm">
      <h2>Job Seeker Login</h2>
    </div>
  </div> 
</header>


<!-- End Header 02
================================================== -->



<!-- Main 
================================================== -->
<main>
  <div class="only-form-pages">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="only-form-box">   
            <form method="post" id="login">
              <div class="com_class_form">
                <div class="form-group">
              
                  <input class="form-control" type="text" name="email" size="40" placeholder="Email address * ">
                </div>
                <div class="form-group">
                  
                  <input class="form-control" type="password" name="password" placeholder=" Password * ">
                </div>
                
                
                <div class="form-group">
                  <input class="btn btn-primary" type="submit" value="Login">
                </div>
                <div>
                    <div class="d-inline-block">
                      <a class="lost_password" href="<?= base_url('home/password_reset') ?>"> Lost your password?</a>
                    </div>
                    <div class="float-right d-inline-block">
                      <a class="lost_password" href="<?= base_url('home/register') ?>"> New User?</a>
                    </div>
                </div>
              </div>
            </form>
            <div class="social_login">
              <p class="or_span"><span>or</span></p>
              <?php
                if($fb_btn) {
                  echo "<a href='".$fb_btn."' class='btn btn-facebook'><i class='fab fa-facebook-f'></i> Login via Facebook</a>";
                } 
              ?>
              
              <?php if(isset($loginButton)):?>
              <a href="<?=$loginButton; ?>" class="btn btn-google"><i class="fab fa-google-plus-g"></i> Login via Google +</a>
              <!-- <button class="btn btn-google"><i class="fab fa-google-plus-g"></i> Register via Google+</button> -->
              <?php endif; ?>
            </div>
           </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include(VIEWPATH.'users/include/footer.php'); ?>

<script>
  $('#login').on('submit',function(){
    event.preventDefault();
    var fields = $('#login').serialize();
    $.ajax({
      url: "<?= base_url('login') ?>",
      method: "POST",
      data: fields,
      success: function(responses){
        //console.log(responses);
        var response = responses.split('~');
        if ($.trim(response[0]) == 0) {
          $('#login').trigger("reset");
          toastr.error(response[1]);
          }
        if ($.trim(response[0]) == 1) {
            $('#login').trigger("reset");
            toastr.success(response[1]);
            setTimeout(function() {
              window.location.href = 'home';
            }, 500);
          }
        }
      });
    });
</script>