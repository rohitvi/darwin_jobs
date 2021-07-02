<?php include(VIEWPATH.'users/include/header.php'); ?>
<div class='header_inner '>
    <div class="header_btm">
      <h2>Password Recovery</h2>
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
            <form method="post" id="reset">
              <div class="com_class_form">
                <div class="form-group">
                  <input class="form-control" type="email" name="email" size="40" placeholder="Email address * ">
                </div>
                <div class="form-group">
                  <input class="btn btn-primary reset-pass" type="submit" value="Reset Password">
                </div>
              </div>
            </form>
           </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include(VIEWPATH.'users/include/footer.php'); ?>

<script>
  $('.reset-pass').click(function(e){
    event.preventDefault();
    var _form = $("#reset").serialize();
    $.ajax({
        data: _form,
        type: 'POST',
        url: '<?= base_url("home/password_reset"); ?>',
        success: function(response){
            $("#reset").trigger('reset');
            var response = response.split('~');
            if ($.trim(response[0]) == 0) {
              toastr.error(response[1]);
            }else if ($.trim(response[0]) == 1) {
              toastr.success(response[1]);
            }
        }
    });
});
</script>