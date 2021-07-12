<!-- Footer Container
================================================== -->
<footer id="colophon" class="site-footer custom_footer dark_footer">
    <div class="container">
        <div class="row footer_widget">

        <?php $footer =  get_footer_settings(); ?>

        <?php foreach($footer as $col):  ?>
            <div class="col-md-<?= $col['grid_column'] ?>">
                <div class="footer_widget_box">
                    <h2 data-aos="fade-up" data-aos-delay="400"><?= $col['title'] ?></h2>
                    <?= $col['content'] ?>
                </div>
            </div>
        <?php endforeach; ?>
            <!-- <div class="col-md-3">
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
            </div> -->
            <!-- <div class="col-md-3">
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
            </div> -->
            <!-- <div class="col-md-3">
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
            </div> -->
                    <div class="col-md-9">
                    </div>
					<div class="col-md-3">
						<div class="footer_widget_box">
							<form id="subscriber" method="post" class='newsletter'>
								<h2 data-aos="fade-up" data-aos-delay="400">Newsletter</h2>
								<div data-aos="fade-in" data-aos-delay="200" class="d-flex">
									<input class="form-control" name='subscriber_email' type="email" placeholder="Enter your email ">
									<button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i></button>
								</div>
							</form>
						</div> 
				 	</div> <!--col-md-3 end -->
            <div class="col-md-12">
                <div class="footer_widget_box">
                    <p class="copyright-text">© <?= get_g_setting_val('copyright') ?></p>
                </div>
            </div>
        </div>
        <!-- .site-info -->
    </div>
</footer>
<!-- End Footer Container
================================================== -->

<!-- Scripts
================================================== -->
<script src="<?= base_url(); ?>/public/users/js/jquery-3.4.1.min.js"></script>
<script src="<?= base_url(); ?>/public/users/toastr/toastr.min.js"></script>
<script src="<?= base_url(); ?>/public/users/js/popper.min.js"></script>
<script src="<?= base_url(); ?>/public/users/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/public/users/js/aos.js"></script>
<script src="<?= base_url(); ?>/public/users/js/custom.js"></script>
<script src="<?= base_url(); ?>/public/users/js/datatables/datatables.min.js"></script>
<script src="<?= base_url(); ?>/public/users/js/select2.min.js"></script>

<script>
    <?= (session()->getFlashdata('success')) ? "toastr.success('" . session()->getFlashdata('success') . "')" : '' ?>
    <?= (session()->getFlashdata('error')) ? "toastr.error('" . session()->getFlashdata('error') . "')" : '' ?>
    <?= (session()->getFlashdata('denied')) ? "toastr.warning('" . session()->getFlashdata('denied') . "')" : '' ?>
</script>
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
</body>

</html>