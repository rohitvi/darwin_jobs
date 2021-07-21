<?php include(VIEWPATH . 'employer/include/header.php'); ?>

<div class='header_inner '>
  <div class="header_btm">
    <h2>Job Applicant Details</h2>
  </div>
</div>
</header>

<main>
  <div class="job_container">
    <div class="container">
    <?php include(VIEWPATH . 'employer/include/profile_info.php'); ?>
      <div class="row job_main">
      <?php include(VIEWPATH . 'employer/include/sidebar.php'); ?>
<div class=" job_main_right">
  <div class="row job_section">
    <div class="col-sm-12">
      <div class="jm_headings">
        <h5>Applicant List</h5>
      </div>
      <div class="section-divider">
      </div>
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
                        <a title="email"  onclick="interview(<?= $applicant['id'] ?>)" id="inter<?= $applicant['id'] ?>" class="btn btn-sm btn-primary pull-right mb-3" href="#" data-toggle="modal" data-target="#myModal" data-message="<?= $applicant['email'] ?>"> Email Candidate</a>
                        <a title="Shortlist" class="btn btn-sm btn-success pull-right" href="<?= base_url('employer/make_shortlist/' . $applicant['id'] . '/' . $applicant['job_id']); ?>">Shortlist Candidate</a>
                    </td>
                </tr>
            <?php endforeach; ?>
    </tbody>
    </table>
    </div>
  </div>


</div>
</div>
</div>
</div>
</main>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title md-title">New Message</h4>
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
            <span class="sr-only">close</span>
        </button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <?php echo form_open('/', 'class="email-form"') ?>
	        <input type="hidden" name="email" class="form-control" value="<?= isset($applicant['email']) ?>" id="email">
	        <div class="form-group">
	            <label class="form-control-label">Subject:</label>
	            <input class="form-control" type="text" name="subject" id="subject">
	        </div>
	        <div class="form-group">
	            <label class="form-control-label">Message:</label>
	            <textarea name="message" class="form-control" id="message"></textarea>
	        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-shadow" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary send_email">Save</button>
        <?php form_close(); ?>
      </div>

    </div>
  </div>
</div>


<?php include(VIEWPATH . 'employer/include/footer.php'); ?>

<script>
	/* ----------------- Email ------------------*/
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