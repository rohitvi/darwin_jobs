<?php include(VIEWPATH.'employer/include/header.php'); ?>
<div class='header_inner '>
  <div class="header_btm">
    <h2>Shortlisted Resume</h2>
  </div>
</div>
</header>


<main>
  <div class="job_container">
    <div class="container">
      <div class="row job_main">
            <!-- side bar start -->
         <?php include(VIEWPATH . 'employer/include/sidebar.php'); ?>
        <!-- side bar end -->

        <div class=" job_main_right">
            <div class="jm_headings">
                <h5>Shortlisted Resume</h5>
            </div>
          <div class="row findstaf_section ">
          <?php foreach ($data as $value): ?>
            <div class="col-sm-6">
              <div class="staffBox">
                <div class="staff_img">
                  <img alt="" src="assets/images/profile-4.png">
                </div>
                <div class="staff_detail">
                  <h3><?= $value['firstname'].' '.$value['lastname'] ?> <img alt="" src="<?= $value['profile_picture'] ?>"></h3>
                  <p><?= $value['job_title'] ?></p>
                  <ul>
                    <li>
                      <h6>Location</h6>
                      <i class="fas fa-map-marker-alt"></i>
                      <span><?= get_city_name($value['city']) ?></span>
                    </li>
                    <li>
                      <h6>Experience</h6>
                      <i class="fas fa-calendar-check"></i>
                      <span><?= $row['experience']; ?></span>
                    </li>
                    <li>
                      <h6>Age</h6>
                      <i class="fas fa-user"></i>
                      <span>26</span>
                    </li>
                  </ul>
                  <div class="staffBox_action">
                    <a  class="btn btn-third" href="staff-profile-single.html">View profile</a>
                  </div>
                </div>
              </div>
            </div>
            <?php endforeach ?>
          </div>      
        </div>



        <!-- roght bar start -->
        <div class=" job_main_right">
          <div class="row findstaf_section">
          <div class="col-sm-12">
                <div class="jm_headings">
                <h5>Shortlisted Resume</h5>
              </div>
              <div class="section-divider">
              </div>
               <!-- start -->
            <?php if ($data !== null) : ?>
            <div class="job_container ">
                <div class="container">
                    <div class="row two_col featured_box_outer">
                        <?php foreach ($data as $value): ?>
                        <div class="col-sm-6">
                            <div class="featured_box ">
                                <div class="fb_image">
                                    <a href="compnay-profile-single.html">
                                        <img alt="brand logo" src="<?= base_url('public/employer/assets/img/avatar/user.png')?>">
                                    </a>
                                </div>
                                <div class="fb_content">
                                    <h4>
                                        <a href="#"><?= $value['firstname'].' '.$value['lastname'] ?></a>
                                    </h4>
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <i class="fas fa-landmark"></i>
                                                <?= get_city_name($value['city']) ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fas fa-map-marker-alt"></i>   <?= get_state_name($value['state']).', '.get_country_name($value['country']) ?></a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fas fa-money-bill"></i>
                                                Current Salary : INR <?= $value['current_salary'] ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fas fa-list"></i>
                                                Category : <?= $value['job_title'] ?>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="fb_action text-center">
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <button class="btn-sm btn-primary" onclick="userdetails(<?= $value['user_id'] ?>)" data-toggle="modal" data-target="#modal-large" data-message="<?= $value['email'] ?>">User Profile</button>&nbsp;&nbsp;
                                    <button class="btn-sm btn-primary" id="inter<?= $value['user_id'] ?>" onclick="interview(<?= $value['user_id'] ?>)" data-toggle="modal" data-target="#modal-centered" data-message="<?= $value['email'] ?>">Interview</button>&nbsp;&nbsp;
                                    <a  href="<?= base_url($value['resume']) ?>" ><button class="btn-sm btn-primary">Download CV</button></a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                        <div class="col-md-12 text-right"> 
                            <a data-aos="fade-down" data-aos-delay="400" class="btn btn-primary aos-init" href="<?= base_url('employer/search') ?>">Find Candidates <i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end -->
            <?php else: ?>
            <div class="section dark-section featured_section">
                <p>No ShortListed Candidates</p>
            </div>
            <?php endif; ?>
          </div>
          </div>  
        </div>
         <!-- right bar start -->
         
      </div>
    </div>
  </div>
</main>


<!-- Begin User Modal -->
<div id="modal-large" class="modal fade">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">User Details</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">close</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-shadow" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End User Modal -->



<!-- Begin Interview Modal -->
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
                <input type="hidden" name="email" class="form-control" value="<?= (isset($value['email'])) ? $value['email'] : '' ?>" id="email">
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
<!-- End Interview Modal -->


<?php include(VIEWPATH.'employer/include/footer.php'); ?>

<script>
    function userdetails(id){
        event.preventDefault();
        var id = id;
        $.ajax({
            type: "GET",
            url: '<?= base_url();?>/employer/userdetails/'+id,
            cached: false,
            success: function(data) {
                $('#modal-body').html(data);
            }
        });
    }
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