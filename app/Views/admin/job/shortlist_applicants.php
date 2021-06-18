<?php include(VIEWPATH . 'admin/include/header.php'); ?>

<<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Shortlisted Applicant</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="<?= base_url('admin/list_job'); ?>">Job List</a></li>
							<li class="breadcrumb-item active"><a>Shortlisted Applicant</a></li>
						</ol>
					</div>
				</div>
			</div><!-- /.container-fluid -->
		</section>

		<!-- Main content -->

		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<div class="card">
							<!-- /.card-header -->
							<div class="card-body">
								<table id="basic_filter" class="table table-bordered table-striped ">
									<thead>
										<tr>
											<th>No</th>
											<th>Name</th>
											<th>Industry</th>
											<th>Location</th>
											<th>Email</th>
											<th style="width: 100px;" class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $count = 0;
										foreach ($applicants as $applicant) : ?>
											<tr>
												<td><img src="<?= $applicant['profile_picture'] ?>" alt="" height="50"></td>
												<td><?= $applicant['firstname'] . ' ' . $applicant['lastname']; ?><small> (<?= $applicant['job_title']; ?>)</small></td>
												<td><?= get_category_name($applicant['category']); ?></td>
												<td><?= get_city_name($applicant['city']); ?>, <?= get_country_name($applicant['country']); ?></td>
												<td><?= $applicant['email'] ?></td>
												<?php $resume = ($applicant['resume'] != '') ? base_url($applicant['resume']) : '#'  ?>
												<td>
													<a title="resume" class="btn btn-xs btn-info pull-right mb-3" href="<?= $resume; ?>"> Preview CV</a>
													<a title="email" class="btn btn-xs btn-primary pull-right  mb-3" href="#" data-toggle="modal" data-target="#emailModal" data-whatever="<?= $applicant['email']; ?>"> Email Candidate</a>
													<a title="Shortlist" class="btn btn-xs btn-success pull-right" href="#" data-toggle="modal" data-target="#emailModal" data-whatever="<?= $applicant['email']; ?>">Interview Message</a>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
							<!-- /.card-body -->
						</div>
					</div>
					<!-- /.card -->
				</div>
			</div>
			<!-- /.row -->
	</div><!-- /.container-fluid -->
	</section>
	<!-- Company section -->



	<!-- Email Dialogue Box -->
	<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">New message</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<?php echo form_open("/", 'class="email-form"') ?>
					<input type="hidden" name="email" class="form-control" id="email">
					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Subject:</label>
						<input type="text" name="subject" class="form-control" id="subject">
					</div>
					<div class="form-group">
						<label for="message-text" class="col-form-label">Message:</label>
						<textarea name="message" class="form-control" id="message"></textarea>
					</div>
					<div class="form-group">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<input type="submit" class="btn btn-primary send_email" name="submit" value="Send Message">
					</div>
					<?php form_close(); ?>
				</div>

			</div>
		</div>
	</div>

	<!-- /.content -->
	</div>
	<?php include(VIEWPATH . 'admin/include/footer.php'); ?>

	<script type="text/javascript">
		/* ----------------- Email ------------------*/

		$('#emailModal').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var recipient = button.data('whatever') // Extract info from data-* attributes
			var modal = $(this)
			modal.find('.modal-title').text('New message to ' + recipient)
			modal.find('.modal-body #email').val(recipient);

			$('.send_email').click(function(e) {

				var _form = $(".email-form").serialize();
				$.ajax({
					data: _form,
					type: 'POST',
					url: '<?php echo base_url(); ?>admin/applicants/email',
					success: function(response) {
						modal.find('.modal-title').text(response);
						$(".email-from").trigger('reset');
						$('.close').trigger('click');
					}
				});
				e.preventDefault();
			});
		});
	</script>

	<script>
		$("#job").addClass('active');
	</script>
	</body>

	</html>