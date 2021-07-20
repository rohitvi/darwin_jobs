<!-- Footer Container
================================================== -->
<footer id="colophon" class="site-footer custom_footer dark_footer">
	<div class="container">
		<div class="row footer_widget">

						<div class="col-md-12">
							<form id="subscriber" method="post">
								<div data-aos="fade-in" data-aos-delay="200" class="d-flex">
									<input class="form-control" name='subscriber_email' type="email" placeholder="Enter your email ">
									<button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i></button>
								</div>
							</form>
						</div>
						
				 	

				<?php $footer =  get_footer_settings(); ?>
				<?php foreach($footer as $col):  ?>
					<div class="col-md-<?= $col['grid_column'] ?>">
						<div class="footer_widget_box text-center">
							<h2 data-aos="fade-up" data-aos-delay="400"><?= $col['title'] ?></h2>
							<?= $col['content'] ?>
						</div>
					</div>
				<?php endforeach; ?>
				
				<div class="col-md-12">
					<div class="footer_widget_box"  >
						<p class="copyright-text text-center">© <?= get_g_setting_val('copyright') ?></p>
					</div>
				</div>
				
			</div>  <!--row end -->
		<!-- .site-info -->
	</div>
</footer>
<script src="<?= base_url(); ?>/public/users/js/jquery-3.4.1.min.js"></script><!--for datepicker file require -->
<script src="<?= base_url(); ?>/public/users/js/tagin.min.js"></script>
<script src="<?= base_url(); ?>/public/users/toastr/toastr.min.js"></script>
<script src="<?= base_url(); ?>/public/users/js/jquery-ui.js"></script>  <!--for datepicker file require -->
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
$('.alert').alert();

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
