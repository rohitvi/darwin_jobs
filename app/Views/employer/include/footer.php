<!-- Footer Container
================================================== -->
<footer id="colophon" class="site-footer custom_footer dark_footer">
    <div class="row footer_borrom_brd">
							<form id="subscriber" method="post">
								<div data-aos="fade-in" data-aos-delay="200" class="d-flex">
									<input class="form-control" name='subscriber_email' type="email" placeholder="Enter your email ">
									<button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i></button>
								</div>
							</form>
						</div>
	<div class="container footer_mt">
		<div class="row footer_widget">

						
				 	

				<?php $footer =  get_footer_settings(); ?>

				<?php foreach($footer as $col):  ?>
					<div class="col-md-<?= $col['grid_column'] ?>">
						<div class="footer_widget_box text-center">
							<h2><?= $col['title'] ?></h2>
							<?= $col['content'] ?>
						</div>
					</div>
				<?php endforeach; ?>
				
				
				
			</div>  <!--row end -->
		<!-- .site-info -->
	</div>
	<div class="">
					<div class="footer_widget_box"  >
						<p class="copyright-text text-center">© <?= get_g_setting_val('copyright') ?></p>
					</div>
				</div>
</footer>
<script src="<?= base_url(); ?>/public/users/js/jquery-3.4.1.min.js"></script>
<script src="<?= base_url(); ?>/public/users/js/tagin.min.js"></script>
<script src="<?= base_url(); ?>/public/users/toastr/toastr.min.js"></script>
<script src="<?= base_url(); ?>/public/users/js/datatables/datatables.min.js"></script>
<script src="<?= base_url(); ?>/public/users/js/tagin.min.js"></script>
<script src="<?= base_url(); ?>/public/users/js/ckeditor.js"></script>
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
<script>
$(document).ready(function() {
	
	setTimeout(function(){
		$('body').addClass('loaded');
		$('h1').css('color','#222222');
	}, 500);
	
});
</script>	
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
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
