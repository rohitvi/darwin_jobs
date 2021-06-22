<?php include(VIEWPATH.'employer/include/header.php'); ?>

<div class="content-inner">
	<div class="container-fluid">
	    <!-- Begin Page Header-->
	    <div class="row">
	        <div class="page-header">
	            <div class="d-flex align-items-center">
	                <h2 class="page-header-title">View Shortlisted Users</h2>
	                <div>
	                    <ul class="breadcrumb">
	                        <li class="breadcrumb-item"><a href="<?= base_url('employer') ?>"><i class="ti ti-home"></i></a></li>
	                        <li class="breadcrumb-item active">View Shortlisted Users</li>
	                    </ul>
	                </div>
	            </div>
	        </div>
	    </div>
	    <!-- End Page Header -->
	    <div class="row">
	        <div class="col-xl-12">
	            <!-- Sorting -->
	            <div class="widget has-shadow">
	                <div class="widget-header bordered no-actions d-flex align-items-center">
	                    <h4>Shortlisted Users List</h4>
	                </div>
	                <div class="widget-body">
	                    <div class="table-responsive">
	                        <table id="sorting-table" class="table mb-0 mv_datatable">
	                            <thead>
	                                <tr>
	                                    <th>#</th>
	                                    <th>Name</th>
	                                    <th>Industry</th>
	                                    <th>Location</th>
	                                    <th>Email</th>
	                                    <th>Actions</th>
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
													<a title="resume" class="btn btn-sm btn-info pull-right mb-3" href="<?= $resume; ?>"> Preview CV</a>
													<a title="email" class="btn btn-sm btn-primary pull-right  mb-3" href="#" data-toggle="modal" data-target="#emailModal" data-whatever="<?= $applicant['email']; ?>"> Email Candidate</a>
													<a title="Shortlist" onclick="interview(<?= $applicant['id'] ?>)" id="inter<?= $applicant['id'] ?>" class="btn btn-sm btn-success pull-right" href="#" data-toggle="modal" data-target="#modal-centered" data-message="<?= $applicant['email'] ?>">Interview Message</a>
												</td>
											</tr>
										<?php endforeach; ?>
	                            </tbody>
	                        </table>
	                    </div>
	                </div>
	            </div>
	            <!-- End Sorting -->
	        </div>
	    </div>
	    <!-- End Row -->
	</div>
	<!-- End Container -->

	<!-- Begin Centered Modal -->
        <div id="modal-centered" class="modal fade">
		    <div class="modal-dialog modal-dialog-centered">
		        <div class="modal-content">
		            <div class="modal-header">
		                <h4 class="modal-title md-title">New Message</h4>
		                <button type="button" class="close" data-dismiss="modal">
		                    <span aria-hidden="true">×</span>
		                    <span class="sr-only">close</span>
		                </button>
		            </div>
		            <div class="modal-body" id="interview-modal">
		                <?php echo form_open('/', 'class="email-form"') ?>
		                <input type="hidden" name="email" class="form-control" value="<?= $applicant['email'] ?>" id="email">
		                <div class="form-group">
		                    <label class="form-control-label">Subject:</label>
		                    <input class="form-control" type="text" name="subject" id="subject">
		                </div>
		                <div class="form-group">
		                    <label class="form-control-label">Message:</label>
		                    <textarea name="message" class="form-control" id="message"></textarea>
		                </div>
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-shadow" data-dismiss="modal">Close</button>
		                <button type="submit" class="btn btn-primary send_email">Save</button>
		                <?php form_close(); ?>
		            </div>
		        </div>
		    </div>
		</div>
        <!-- End Centered Modal -->

<?php include(VIEWPATH.'employer/include/footer.php'); ?>

<script>
	function interview(id){
        event.preventDefault();
        var id = id;
        var button = document.getElementById('inter'+id); // Button that triggered the modal
        var recipient = button.getAttribute('data-message') // Extract info from data-* attributes
        var modaltitle = document.getElementsByClassName('md-title')[0].innerHTML = "New Message to " + recipient;
        $('.send_email').click(function(e) {
            event.preventDefault();
            var _form = $(".email-form").serialize();
            $.ajax({
                data: _form,
                type: 'POST',
                url: '<?= base_url(''); ?>/employer/interview/'+id,
                success: function(response) {
                    $(".email-from").trigger('reset');
                    var response = response.split('~');
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
                    else if ($.trim(response[0]) == 1) {
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

                    $('.close').trigger('click');
                }
            });
        });
    }
</script>