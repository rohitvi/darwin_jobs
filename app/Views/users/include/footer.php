<!-- Footer Container
================================================== -->
<footer id="colophon" class="site-footer custom_footer dark_footer">
	<div class="container">
		<div class="row footer_widget">
				<div class="col-md-3">
					<div class="footer_widget_box">
						<h2 data-aos="fade-up" data-aos-delay="400">Job seekers</h2>
						<ul data-aos="fade-in" data-aos-delay="200">
							<li>
								<a href="browse-jobs.html">Browse jobs</a>
							</li>
							<li>
								<a href="job-single.html">Job single</a>
							</li>
							<li>
								<a href="my-stared-jobs.html">My stared jobs</a>
							</li>
							<li>
								<a href="edit-profile.html">Update my profile</a>
							</li>
							<li>
								<a href="edit-password.html">Change password</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer_widget_box">
						<h2 data-aos="fade-up" data-aos-delay="400">Employers</h2>
						<ul data-aos="fade-in" data-aos-delay="200">
							<li>
								<a href="emp-registration.html">Get a FREE Employer Account</a> 
							</li>
							<li>
								<a href="post-a-job.html">Post a job</a>
							</li>
							<li>
								<a href="find-staff.html">Find staff</a>
							</li>
							<li>
								<a href="job-dashboard.html">Job dashboard</a>
							</li>
							<li>
								<a href="emp-edit-profile.html">Update profile</a>
							</li>
							<li>
								<a href="emp-edit-password.html">Change password</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer_widget_box">
						<h2 data-aos="fade-up" data-aos-delay="400">Community</h2>
						<ul data-aos="fade-in" data-aos-delay="200">
							<li> <a href="contact-us.html">Help / Contact Us</a> 
				            </li>
				            <li> <a href="content-page.html">Guidelines</a> 
				            </li>
				            <li> <a href="content-page.html">Terms of Use</a> 
				            </li>
				            <li> <a href="content-page.html">Privacy &amp; Cookies </a> 
				            </li>
						</ul>
						
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer_widget_box">
						<h2 data-aos="fade-up" data-aos-delay="400">Get In Touch</h2>
						<ul data-aos="fade-in" data-aos-delay="200" class="social_list">
							<li> <a href="#"><i class="fab fa-twitter"></i></a> 
							</li>
							<li> <a href="#"><i class="fab fa-facebook"></i></a> 
							</li>
							<li> <a href="#"><i class="fab fa-linkedin"></i></a> 
							</li>
							<li> <a href="#"><i class="fab fa-youtube"></i></a> 
							</li>
						</ul>

					</div>
					
          <div class="footer_widget_box">
		  				<form action="" id="subscriber" method="post" class='newsletter'>
			                  <h2 data-aos="fade-up" data-aos-delay="400">Newsletter</h2>
			                  <div data-aos="fade-in" data-aos-delay="200" class="d-flex">
							  	<form action="" id="subscriber" method="post">
			                    <input class="form-control" name='subscriber_email' type="email" placeholder="Enter your email ">
			                    <button class="btn btn-primary"><i class="fa fa-paper-plane"></i></button>
			                  </div>
		                   
		                </form>
		            </div> 
				</div>
				<div class="col-md-12">
					<div class="footer_widget_box"  >
						<p class="copyright-text">© Copyright 2020 by JoDice. All rights reserved.
						</p>
					</div>
				</div>
			</div>
		<!-- .site-info -->
	</div>
</footer>
<script src="<?= base_url(); ?>/public/users/js/jquery-3.4.1.min.js"></script>
<script src="<?= base_url(); ?>/public/users/toastr/toastr.min.js"></script>
<script>
	<?= (session()->getFlashdata('success')) ? "toastr.success('" . session()->getFlashdata('success') . "')" : '' ?>
    <?= (session()->getFlashdata('error')) ? "toastr.error('" . session()->getFlashdata('error') . "')" : '' ?>
    <?= (session()->getFlashdata('denied')) ? "toastr.warning('" . session()->getFlashdata('denied') . "')" : '' ?>
</script>
<script>
$('.alert').alert();
$('#subscriber').on('submit',function(){
    event.preventDefault();
    var fields = $('#subscriber').serialize();
    $.ajax({
        url: "<?= base_url('home/add_subscriber'); ?>",
        method: "POST",
        data: fields,
         success:function(responses){
            var response = responses.split('~');
            $('#subscriber').trigger("reset");
              if ($.trim(response[0]) == 0) {
                new Noty({
                    type: "error",
                    layout: "topRight",
                    text: response[1],
                    progressBar: true,
                    timeout: 2500,
                    animation: {
                        open: "animated bounceInRight",
                        close: "animated bounceOutRight"
                    }
                }).show();
              }
              if ($.trim(response[0]) == 1) {
                new Noty({
                    type: "success",
                    layout: "topRight",
                    text: response[1],
                    progressBar: true,
                    timeout: 2500,
                    animation: {
                        open: "animated bounceInRight",
                        close: "animated bounceOutRight"
                    }
                }).show();
              }
         }
    });

});
</script>
<!-- End Footer Container
================================================== -->
<!-- Scripts
================================================== -->
<script src="<?= base_url(); ?>/public/users/js/select2.min.js"></script>
<script src="<?= base_url(); ?>/public/users/js/popper.min.js"></script>
<script src="<?= base_url(); ?>/public/users/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/public/users/js/owl.carousel.min.js"></script>
<script src="<?= base_url(); ?>/public/users/js/aos.js"></script>
<script src="<?= base_url(); ?>/public/users/js/custom.js"></script>
</body>
</html>
