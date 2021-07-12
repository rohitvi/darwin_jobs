<?php include(VIEWPATH.'users/include/header.php'); ?>
<div class='header_inner '>
    <div class="header_btm">
      <h2>Register</h2>
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
            <div class="welcome-text text-center mb-5">
              <h5 class="mb-0">Create an account!</h5>
              <span>Already have an account? <a href="<?= base_url('login'); ?>">Log In!</a></span>
            </div>
				<form id="register">
					<div class="com_class_form">
						<div class="form-group user_type_cont">
              <label class="user_type" for="usertype-1">
                <span><i class="far fa-user"></i> Job Seeker</span>
              </label>
            </div>
            <div class="form-group">
							<input class="form-control" name="firstname" type="text" size="40" placeholder="Firstname * " >
						</div>
            <div class="form-group">
              <input class="form-control" name="lastname" type="text"  size="40" placeholder="Lastname * " >
            </div>
						<div class="form-group">
							<input class="form-control" name="email" type="email" placeholder="Email * " >
						</div>
            <div class="form-group">
              <input class="form-control" name="password" type="password" placeholder="Password * " >
            </div>
            <div class="form-group">
              <input class="form-control" name="cpassword" type="password" placeholder="Re-enter Password * " >
            </div>
            <div class="form-group form-check">
              <label class="form-check-label">
                <input class="form-check-input" name="termsncondition" type="checkbox"> Terms & Conditions
              </label>
            </div>

						
						<div class="form-group">
							<input class="btn btn-primary" type="submit" value="Register">
						</div>
            
					</div>
				</form>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include(VIEWPATH.'users/include/footer.php'); ?>

<script>
  $('#register').on('submit',function(){
    event.preventDefault();
    var fields = $('#register').serialize();
    $.ajax({
      url: "<?= base_url('home/register') ?>",
      method: "POST",
      data: fields,
      success: function(responses){
        console.log(responses);
        //return false;
        var response = responses.split('~');
        if ($.trim(response[0]) == 0) {
          $('#register').trigger("reset");
          toastr.error(response[1]);
          }
          if ($.trim(response[0]) == 1) {
            $('#register').trigger("reset");
            toastr.success(response[1]);
            setTimeout(function() {
              window.location.href = "/darwin_jobs";
            }, 500);
        }
      }
    });
  });
</script>