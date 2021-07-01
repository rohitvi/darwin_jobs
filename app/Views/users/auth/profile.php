<?php include(VIEWPATH . 'users/include/header.php'); ?>

<div class='header_inner'>
  <div class="header_btm">
    <h2>Update My Profile</h2>
  </div>
</div>
</header>
<!-- Main
================================================== -->
<main>
  <div class="job_container">
    <div class="container">
    <?php include(VIEWPATH . 'users/include/profile_info.php'); ?>
      <div class="row job_main">
        <?php include(VIEWPATH . 'users/include/sidebar.php'); ?>
        <div class=" job_main_right">
          <div class="row job_section">
            <div class="col-sm-12">
              <div class="jm_headings">
                <h5>Update My Profile</h5>
                <a class="btn btn-primary mypbtn" href="compnay-profile-single.html">Company profile</a>
              </div>
              <div class="section-divider">
              </div>
              <form action="<?= base_url('home/profile'); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                <div class="big_form_group">
                  <div class="row">

                    <div class="col-md-12">
                      <div class="form-group ">
                        <label  >Profile Picture</label>
                        <input type="file" name="profile_picture" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label>First Name</label>
                        <input type="text" name="firstname" value="<?= $data[0]['firstname']; ?>" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label>Last Name</label>
                        <input type="text" name="lastname" value="<?= $data[0]['lastname']; ?>" class="form-control">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group ">
                        <label>Email</label>
                        <input type="email" name="email" value="<?= $data[0]['email']; ?>" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label>Phone </label>
                        <input type="text" name="mobile_no" value="<?= $data[0]['mobile_no']; ?>" class="form-control">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group ">
                        <label>Date of Birth:</label>
                        <input type="date" name="dob" value="<?= $data[0]['dob']; ?>" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label>Age * </label>
                        <select name="age" class="form-control">
                          <?php for ($i = 11; $i < 80; $i++) : ?>
                            <?php if ($data[0]['age'] == $i) : ?>
                              <option selected><?= $i; ?></option>
                            <?php else : ?>
                              <option><?= $i; ?></option>
                          <?php endif;
                          endfor; ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group ">
                        <label>Category</label>
                        <select class="form-control" name="category">
                          <option value="">Select Category</option>
                          <?php foreach ($categories as $category) : ?>
                            <?php if ($data[0]['category'] == $category['id']) : ?>
                              <option value="<?= $category['id']; ?>" selected> <?= $category['name']; ?> </option>
                            <?php else : ?>
                              <option value="<?= $category['id']; ?>"> <?= $category['name']; ?> </option>
                          <?php endif;
                          endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label>Your Title</label>
                        <input type="text" name="job_title" value="<?= $data[0]['job_title']; ?>" class="form-control">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group ">
                        <label>Experience</label>
                        <select name="experience" class="form-control">
                          <option value="0-1" <?php if ($data[0]['experience'] == '0-1') {
                              echo "selected";
                          } ?>>0-1 Years</option>
                          <option value="1-2" <?php if ($data[0]['experience'] == '1-2') {
                              echo "selected";
                          } ?>>1-2 Years</option>
                          <option value="2-5" <?php if ($data[0]['experience'] == '2-5') {
                              echo "selected";
                          } ?>>2-5 Years</option>
                          <option value="5-10" <?php if ($data[0]['experience'] == '5-10') {
                              echo "selected";
                          } ?>>5-10 Years</option>
                          <option value="10-15" <?php if ($data[0]['experience'] == '10-15') {
                              echo "selected";
                          } ?>>10-15 Years</option>
                          <option value="15+" <?php if ($data[0]['experience'] == '15+') {
                              echo "selected";
                          } ?>>15+ Years</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label>Skills</label>
                        <input type="text" name="skills" value="<?= $data[0]['skills']; ?>" class="form-control">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group ">
                        <label>Current Salary(INR)</label>
                        <select name="current_salary" class="form-control">
                          <?php for ($i = 500; $i < 10000; $i = $i + 500) : ?>
                            <?php if ($data[0]['current_salary'] == $i) : ?>
                              <option value="<?= $i; ?>" selected> <?= $i; ?> </option>
                            <?php else : ?>
                              <option><?= $i; ?></option>
                          <?php endif;
                          endfor; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label>Expected Salary(INR)</label>
                        <select name="expected_salary" class="form-control">
                          <?php for ($i = 500; $i < 10000; $i = $i + 500) : ?>
                            <?php if ($data[0]['expected_salary'] == $i) : ?>
                              <option value="<?= $i; ?>" selected> <?= $i; ?> </option>
                            <?php else : ?>
                              <option><?= $i; ?></option>
                          <?php endif;
                          endfor; ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group ">
                        <label>Country</label>
                        <select class="form-control" id="country" name="country">
                          <option value="">Select Country</option>
                          <?php foreach ($countries as $country) : ?>
                            <?php if ($data[0]['country'] == $country['id']) : ?>
                              <option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
                            <?php else : ?>
                              <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
                          <?php endif;
                          endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label>State</label>
                        <?php
                        $states = get_country_states($data[0]['country']);
                        $options = array('' => 'Select State') + array_column($states, 'name', 'id');
                        echo form_dropdown('state', $options, $data[0]['state'], 'class="state form-control" required');
                        ?>
                      </div>
                    </div>


                    <div class="col-md-6">
                      <div class="form-group ">
                        <label>City</label>
                        <?php
                        $cities = get_state_cities($data[0]['state']);
                        $options = array('' => 'Select City') + array_column($cities, 'name', 'id');
                        echo form_dropdown('city', $options, $data[0]['city'], 'class="city form-control" required');
                        ?>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label>Full Address</label>
                        <input type="text" name="address" value="<?= $data[0]['address']; ?>" class="form-control">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-9 ">
                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                  </div>
                </div>
              </form>
            </div>
          </div>


          <!-- experiance start -->
          <hr>
          <div class='row'>
            <div class='col-md-9'>
              <h3>Experience</h3>
            </div>
            <div class='col-md-1'>
              <h3><span class="pull-left action-circle add-experience"><i class="fa fa-plus" data-toggle="collapse" data-target="#user-experience"></i></span></h3>
            </div>
          </div>

          <div class='row'>
            <?php foreach ($experiences as $exp) : ?>
              <div class='col-md-12'>
                <h4><?= $exp['job_title'] ?> at <?= $exp['company'] ?></h4>
                <p><?= get_nth_month($exp['starting_month']) . ' ' . $exp['starting_year'] ?> - <?= (!$exp['currently_working_here']) ? get_nth_month($exp['ending_month']) . ' ' . $exp['ending_year'] : 'Present ' ?> | <?= get_country_name($exp['country']) ?></p>
                <p class="overflow-ellipsis"><?= $exp['description'] ?></p>

                <p class="overflow-ellipsis">
                  <a href="javascript:void(0)" class="edit-experience" data-exp_id="<?= $exp['id'] ?>"><i class="fa fa-trash"></i> Edit</a>&nbsp;
                  <a href="<?= base_url('home/delete_experience/' . $exp['id']) ?>" class="btn-delete"><i class="fa fa-trash"></i> Delete</a>&nbsp;
                </p>

              </div>
            <?php endforeach; ?>
          </div>
          <!-- experiance end -->

          <!-- /collapse -->
          <div id="user-experience" class="collapse">
            <form id="experience" method='post'>
              <div class="row">
                <div class="col-md-6">
                  <label>Job Title</label>
                  <input class="form-control valid" name="job_title" type="text" required>
                </div>

                <div class="col-md-6">
                  <label>Company</label>
                  <input class="form-control valid" name="company" type="text" required>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <label>Country</label>
                  <select class="form-control select" id="country" name="country" required=''>
                    <option value="">Select Country</option>
                    <?php foreach ($countries as $country) : ?>
                        <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="col-md-3">
                  <label>Start Month</label>
                  <?php
                  $options = get_months_list();
                  echo form_dropdown('starting_month', $options, '', 'class="form-control" required');
                  ?>
                </div>
                <div class="col-md-3">
                  <label>Start Year</label>
                  <?php
                  $options = get_years_list();
                  echo form_dropdown('starting_year', $options, '', 'class="form-control" required');
                  ?>
                </div>
              </div>

              <div class="row">
                <div class="col-md-3">
                  <div class=exp-end-field">
                    <label>End Month</label>
                    <?php
                    $options = get_months_list();
                    echo form_dropdown('ending_month', $options, '', 'class="form-control " required');
                    ?>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="exp-end-field">
                    <label>End Year</label>
                    <?php
                    $options = get_years_list();
                    echo form_dropdown('ending_year', $options, '', 'class="form-control " required');
                    ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Currently Working Here</label><br>
                  <input type="checkbox" name="currently_working_here" class="currently_working_here" value="1">
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <h5>Description</h5>
                  <textarea name="description" class="form-control" rows="5"></textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="submit-field">
                    <!-- <input type="submit" class="genric-btn danger circle"value="Submit"> -->
                    <button class='genric-btn danger circle'>Submit</button>
                    <button type="button" class="genric-btn danger circle close_all_collapse">Cancel</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <!-- /collapse -->




          <!-- /collapse edit-->
          <div id="user-experience-edit" class="collapse">

          </div>
          <!-- /collapse edit-->

           <!-- education start -->
           <hr>
          <div class='row'>
            <div class='col-md-9'>
              <h3>Education</h3>
            </div>
            <div class='col-md-1'>
              <h3><span class="pull-left action-circle add-experience"><i class="fa fa-plus" data-toggle="collapse" data-target="#user-education"></i></span></h3>
            </div>
          </div>

          <div class="row">
              <?php foreach($education as $edu): ?>
              <!-- education detail -->
              <div class="col-md-12 col-sm-12">
                <div class="employer-job-list">
                  <h5><?= get_education_level($edu['degree']).', '.$edu['degree_title'] ?></h5>
                  <p><?= $edu['institution'] ?><br> <?= $edu['completion_year'] ?></p>
                  <p>
                  <a href="javascript:void(0)" class="edit-education" data-edu_id="<?= $edu['id'] ?>"><i class="fa fa-pencil"></i> Edit</a>&nbsp;
                  <a href="<?= base_url('home/delete_education/'.$edu['id']) ?>" class="btn-delete"><i class="fa fa-trash"></i> Delete</a>&nbsp;
                  </p>
                </div>
              </div>
              <?php endforeach; ?>
              <!-- education detail -->
            </div>
              
            <!-- add user education collapse -->
            <div id="user-education" class="collapse">
                <form action="add_education" method='post'>
                    <div class="row">
                        <div class="col-md-6">
                          <label>Degree Level</label>
                          <?php 
                          $educations = get_education_list();
                          $options = array('' => 'Select Option') + array_column($educations,'type','id');
                          echo form_dropdown('level',$options,'','class="form-control" required');
                        ?>
                        </div>

                        <div class="col-md-6">
                          <label>Degree Title</label>
                          <input class="form-control" name="title" type="text" placeholder="e.g., Computer Science" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                          <label>Major Subjects</label>
                          <input class="form-control" name="majors" type="text" placeholder="please specify your major subjects" required>
                        </div>

                        <div class="col-md-6">
                          <label>Institution</label>
                          <input class="form-control" name="institution" type="text" placeholder="Institution" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                          <label>Country</label>
                          <select class="form-control select" name="country" required=''>
                            <option value="">Select Country</option>
                            <?php foreach ($countries as $country) : ?>
                                <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
                            <?php endforeach; ?>
                        </select>
                        </div>

                        <div class="col-md-6">
                          <label>Completion Year</label>
                          <?= year_dropdown('year', '1985', ''); ?>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class='col-md-12'>
                            <div class="submit-field">
                                <button type="submit" class="btn btn-primary" >Submit</button>
                                <button type="button" class="btn btn-primary close_all_collapse">Cancel</button>
                            </div>
                        </div>
                        </div>
                </form>
            </div>
            <!-- add user education collapse -->

          <!-- Edit education collapse -->
           <div id="user-education-edit" class="collapse"></div>
          <!-- /edit education collapse -->

          <!-- Languages start -->
          <hr>
          <div class='row'>
            <div class='col-md-9'>
              <h3>Languages</h3>
            </div>
            <div class='col-md-1'>
              <h3><span class="pull-left action-circle add-experience"><i class="fa fa-plus" data-toggle="collapse" data-target="#user-language"></i></span></h3>
            </div>
          </div>

                <div class="row">
                  <?php foreach($languages as $lang): ?>
                  <!-- education detail -->
                  <div class="col-md-12 col-sm-12">
                    <div class="employer-job-list">
                      <p><?= get_language_name($lang['language']).' ( '.get_lang_proficiency_name($lang['proficiency']).' ) ' ?></p>
                      <p>
                      <a href="javascript:void(0)" class="edit-language" data-lang_id="<?= $lang['id'] ?>"><i class="fa fa-pencil"></i> edit</a>&nbsp;
                      <a href="<?= base_url('home/delete_language/'.$lang['id']) ?>" class="btn-delete"><i class="fa fa-trash"></i>delete</a>&nbsp;
                      </p>
                    </div>
                  </div>
                  <?php endforeach; ?>
                  <!-- education detail -->
                </div>

                <!-- add user languages collapse -->
                <div id="user-language" class="collapse">
                <form action="add_language" method='post'>
                    <div class='row'>
                        <div class='col-md-6'>
                            <label for="Language">Language</label>
                            <?php
                            $educations = get_languages_list();
                            $options = array('' => 'Select Option') + array_column($educations, 'lang_name', 'lang_id');
                            echo form_dropdown('language', $options,'', 'class="form-control" required');
                            ?>
                        </div>

                        <div class='col-md-6'>
                            <label for="Language">Proficiency with this language</label>
                            <?php
                            $options = get_language_levels();
                            echo form_dropdown('lang_level', $options, '', 'class="form-control" required');
                            ?>
                        </div>

                        <div class='col-md-12'>
                            <div class="submit-field">
                                <button type="submit" class="btn btn-primary" >Submit</button>
                                <button type="button" class="btn btn-primary close_all_collapse">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
              <!-- add user languages collapse -->


          <!-- Languages end -->

           <!-- Edit collapse -->
           <div id="user-language-edit" class="collapse"></div>
          <!-- /edit collapse -->



          <hr>
          <form action="<?= base_url('home/resume'); ?>" method="post" enctype="multipart/form-data">
            <div class='row'>
              <div class='col-md-12'>
                <h3>Resume / CV</h3>
              </div>
              <div class='col-md-6'>
                <h5>Resume * <small>(Maximum file size is 1MB, pdf only)</small></h5>
                <input type="file" name="user_resume">
              </div>
              <div class='col-md-6'>
                <button type="submit" class="btn btn-primary" name='update_resume'>Update</button>
              </div>
            </div>
          </form>




        </div>
      </div>
    </div>
  </div>
</main>
<?php include(VIEWPATH . 'users/include/footer.php'); ?>

<script>
  var csfr_token_name = '<?= csrf_token() ?>';
  var csfr_token_value = '<?= csrf_hash() ?>';
  $(document).ready(function() {
    $('#country').on('change', function() {
      var data = {
        country: this.value,
      }
      data[csfr_token_name] = csfr_token_value;
      $.ajax({
        url: '<?= base_url('home/get_country_states'); ?>',
        type: 'POST',
        data: data,
        dataType: 'json',
        cached: false,
        success: function(obj) {
          $('.state').html(obj.msg);
        }
      });
    });
    $('.state').on('change', function() {
      var data = {
        state: this.value,
      }
      data[csfr_token_name] = csfr_token_value;
      $.ajax({
        url: '<?= base_url('home/get_state_cities'); ?>',
        type: 'POST',
        data: data,
        dataType: 'json',
        cached: false,
        success: function(obj) {
          $('.city').html(obj.msg);
        }
      });
    });
  });


  $('#experience').on('submit', function() {
    event.preventDefault();
    var fields = $('#experience').serialize();
    //console.log(fields);
    $.ajax({
        url: "<?=base_url('home/insert_user_experience');?>",
        method: "POST",
        data: fields,
         success:function(responses){
            var response = responses.split('~');
            $('#experience').trigger("reset");
            $('#user-experience').collapse('hide');
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


  $(document).on('click', '.edit-experience', function() {
    var data = {
      exp_id: $(this).data('exp_id'),
    }
    data[csfr_token_name] = csfr_token_value;
    $.ajax({
      type: 'POST',
      url: "<?= base_url('home/get_experience_by_id'); ?>",
      data: data,
      success: function(response) {
        console.log(response);
        $('#user-experience-edit').html(response);
        $('#user-experience-edit').collapse('show');
      }
    });
  });


// Edit user language
$(document).on('click','.edit-language',function(){
  var data = {
    lang_id : $(this).data('lang_id'),
  }
  data[csfr_token_name] = csfr_token_value;
   $.ajax({
    type: 'POST',
    url: "<?=base_url('home/get_language_by_id');?>",
    data: data,
    success: function (response) {
      $('#user-language-edit').html(response);
      $('#user-language-edit').collapse('show');
    }

  });
});

// Edit user education
$(document).on('click','.edit-education',function(){
  var data = {
    edu_id : $(this).data('edu_id'),
  }
  data[csfr_token_name] = csfr_token_value;
   $.ajax({
    type: 'POST',
    url: "<?=base_url('home/get_education_by_id');?>",
    data: data,
    success: function (response) {
      $('#user-education-edit').html(response);
      $('#user-education-edit').collapse('show');
    }

  });
});

// current working or not
$(document).on('click','.currently_working_here',function(){
  $this = $(this);
  if($this.is(':checked'))
    $('.exp-end-field').hide();
  else
    $('.exp-end-field').show();
});
</script>