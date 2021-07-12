<?php include(VIEWPATH . 'users/include/header.php'); ?>
<div class='header_inner'>
  <div class="header_btm">
  <h2>Contact us</h2>
  </div>
</div>
</header>


<!-- Main 
================================================== -->
<main>
  <div class="only-form-pages">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
        	<div class=" contact_us" >	
          <div class="row "   >
            
            <div class="col-md-12 col-lg-6 ">
              <div class="newslatter_outer">
                
                <div>
                    <h5>Address:</h5>
                    <ul>
                      <li><i class="fas fa-map-marker-alt"></i>
                        Keas 69 Str. 15234, Chalandri <br>
                        Athens, <b>Greece</b>
                      </li>
                      <li><a href="tel:#"><i class="fas fa-phone"></i> +30-2106019311 (landline)</a></li>
                      <li><a href="tel:#"><i class="fas fa-phone"></i> +30-6977664062 (mobile phone)</a></li>
                      <li><a href="tel:#"><i class="fas fa-fax"></i> +30-2106398905 (fax)</a></li>
                    </ul>
                    
                  </div>
              </div>
              <form class="newsletter">
                  <h5>Newsletter</h5>
                  <div class="d-flex">
                    <form id="subscriber" method="post" class='newsletter'>
                      <input class="form-control" name='subscriber_email' type="email">
                      <input class="btn btn-primary" type="submit" value="Subscribe">
                    </form>
                  </div>
                   
                </form>
            </div>
            <div class="col-md-12 col-lg-6">
              <div class="only-form-box">
                <form action='' method='post'>
                  <div class="com_class_form">
                    <div class="form-group">
                  
                      <input class="form-control" type="text" name="name" size="40" placeholder="Name">
                    </div>
                    <div class="form-group">
                      
                      <input class="form-control" type="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                      
                      <select class="form-control" name="user_type">
                        <option value="">Are you a job seeker or an employer ?</option >
                        <option value="JobSeeker">Job Seeker</option>
                        <option value="Employer">Employer</option>
                      </select>
                    </div>
                    <div class="form-group">
                      
                      <input class="form-control" type="text" name="subject" placeholder="Subject">
                    </div>
                    <div class="form-group">
                      
                      <textarea class="form-control" name="message" cols="40" rows="3" placeholder="Message"></textarea>
                    </div>
                    <div class="form-group">
                      <input class="btn btn-primary" type="submit" value="Send">
                    </div>
                  </div>
                </form>
               </div>
            </div>
          </div>	
				
			</div>
        </div>
      </div>
    </div>
  </div>
</main>


<?php include(VIEWPATH . 'users/include/footer.php'); ?>
<script>
$('#subscriber').on('submit',function(){
    event.preventDefault();
    var fields = $('#subscriber').serialize();
    $.ajax({
        url: "<?= base_url('home/add_subscriber'); ?>",
        method: "POST",
        data: fields,
         success:function(responses){
			console.log(responses);
            var response = responses.split('~');
            $('#subscriber').trigger("reset");
          
          
            if ($.trim(response[0]) == 0) {
                toastr.error(response[1]);
              }
              if ($.trim(response[0]) == 1) {
				toastr.success(response[1]);
              }
         }
    });

});
</script>	