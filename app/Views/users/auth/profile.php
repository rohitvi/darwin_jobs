<?php include(VIEWPATH.'users/include/header.php'); ?>
<div class='header_inner '>
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
      <div class="row job_main">
        <div class="sidebar">

          <ul class="user_navigation">
            <li  >
              <a href="find-staff.html"><i class="fas fa-search"></i> Find Staff </a>
              <a class="filter_btn" href="#sidebar_filter_option"> 
                <i class="fas fa-filter"></i>
                <i class="fas fa-times"></i>
              </a>
            </li>
            <li>
            <form id="#sidebar_filter_option" class="filter_option">
              <div class="form-group">
                <label>Location</label>
                <div class="field">
                    <i class="fas fa-map-marker-alt"></i>
                    <select class="js-example-basic-single" name="state">
                      <option value="AL">ALABAMA</option>
                      <option value="WY">WYOMING</option>
                    </select>
                </div>
              </div>  
              <div class="form-group">
                <label>Keywords</label>
                <div class="field">
                    <i class="fas fa-briefcase"></i>
                    <select class="js-example-basic-single" name="state">
                      <option value="AL">e.g. job title</option>
                      <option value="WY">Title 1</option>
                      <option value="WY">Title 2</option>
                      <option value="WY">Title 3</option>
                    </select>
                </div>
              </div>
              
              <div class="form-group">
                <label>Category</label>
                <div class="field">
                    <i class="fas fa-briefcase"></i>
                    <select class="js-example-basic-single" name="state">
                      <option>Admin Support</option>
                      <option>Customer Service</option>
                      <option>Data Analytics</option>
                      <option>Design &amp; Creative</option>
                      <option>Legal</option>
                      <option>Software Developing</option>
                      <option>IT &amp; Networking</option>
                      <option>Writing</option>
                      <option>Translation</option>
                      <option>Sales &amp; Marketing</option>
                    </select>
                </div>
              </div>

              <div class="form-group">
                <label>Salary</label>
                <div class="field">
                  <input type="text" placeholder="e.g. 10k" class="form-control">
                </div>
              </div>

              <div class="form-group">
                <label>Tags</label>
                <div class="field">
                  <div class="form-group custom_checkboxes">
                    <label class="custom_checkbox" for="tag-1">
                      <input type="checkbox" name="usertype" id="tag-1" value="job seeker">
                      <span><i class="fas fa-check"></i>PHP</span>
                    </label>
                    <label class="custom_checkbox" for="tag-2">
                      <input type="checkbox" name="usertype" id="tag-2" value="employer">
                      <span><i class="fas fa-check"></i> MySQL</span>
                    </label>
                    <label class="custom_checkbox" for="tag-3">
                      <input type="checkbox" name="usertype" id="tag-3" value="employer">
                      <span><i class="fas fa-check"></i> API</span>
                    </label>
                    <label class="custom_checkbox" for="tag-4">
                      <input type="checkbox" name="usertype" id="tag-4" value="employer">
                      <span><i class="fas fa-check"></i> react</span>
                    </label>
                    <label class="custom_checkbox" for="tag-5">
                      <input type="checkbox" name="usertype" id="tag-5" value="employer">
                      <span><i class="fas fa-check"></i> design</span>
                    </label>
                  </div>
                </div>
              </div>

            </form>
            </li>
            <li  >
              <a href="job-dashboard.html">
                <i class="fas fa-border-all"></i> Job Dashboard </a>
              </li>
          </ul>
          <h5>Organize and Manage</h5>
          <ul class="user_navigation">
              <li >
              <a href="post-a-job.html"><i class="fas fa-paper-plane"></i> Post Job</a>
              </li>
              <li >
                <a href="my-job-listing.html"><i class="far fa-list-alt"></i> My job listings</a>
              </li>
              
              
          </ul>
          <h5>Account</h5>
          <ul class="user_navigation">
            <li class="is-active">
                <a href="<?= base_url('home/profile') ?>"><i class="fas fa-user"></i> Update My Profile</a>
              </li>
              <li >
                <a href="<?= base_url('home/change_password') ?>"><i class="fas fa-key"></i>Change Password</a>
              </li>
              <li>
                <a href="<?= base_url('home/logout') ?>"><i class="fas fa-power-off"></i> Logout</a>
              </li>
          </ul>
        </div>
        <div class=" job_main_right">
          <div class="row job_section">
          <div class="col-sm-12">
            <div class="jm_headings">
                <h5>Update My Profile</h5>
                <a class="btn btn-primary mypbtn" href="compnay-profile-single.html">Company profile</a>
              </div>
              <div class="section-divider">
              </div>
              <form action="<?= base_url('home/profile');?>" method="post" class="form-horizontal" enctype="multipart/form-data"> 
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
                        <label  >First Name</label>
                        <input type="text" name="firstname" value="<?= $data[0]['firstname'];?>" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label  >Last Name</label>
                        <input type="text" name="lastname" value="<?= $data[0]['lastname'];?>" class="form-control">
                      </div>
                    </div> 

                    <div class="col-md-6">
                      <div class="form-group ">
                        <label  >Email</label>
                        <input type="email" name="email" value="<?= $data[0]['email'];?>" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label  >Phone </label>
                        <input type="text" name="mobile_no" value="<?= $data[0]['mobile_no'];?>" class="form-control">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group ">
                        <label  >Date of Birth:</label>
                        <input type="date" name="dob" value="<?= $data[0]['dob'];?>" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label  >Age * </label>
                        <select name="age" class="form-control">
                        <?php for($i=11; $i<80; $i++): ?>
                                            <?php if($data[0]['age'] == $i): ?>
                                            <option selected><?= $i; ?></option>
                                            <?php else: ?>
                                            <option><?= $i; ?></option>
                                            <?php endif;  endfor; ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group ">
                        <label  >Category</label>
                        <select class="form-control" name="category">
                                            <option value="">Select Category</option>
                                            <?php foreach($categories as $category):?>
                                                <?php if($data[0]['category'] == $category['id']): ?>
                                                    <option value="<?= $category['id']; ?>" selected> <?= $category['name']; ?> </option>
                                                    <?php else: ?>
                                                        <option value="<?= $category['id']; ?>"> <?= $category['name']; ?> </option>
                                                    <?php endif; endforeach; ?>
                          </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label  >Your Title</label>
                        <input type="text" name="job_title" value="<?= $data[0]['job_title'];?>" class="form-control">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group ">
                        <label  >Experience</label>
                        <select name="experience" class="form-control">
                                                <option value="0-1" <?php if($data[0]['experience'] == '0-1'){ echo "selected";} ?>>0-1 Years</option>
                                                <option value="1-2" <?php if($data[0]['experience'] == '1-2'){ echo "selected";} ?>>1-2 Years</option>
                                                <option value="2-5" <?php if($data[0]['experience'] == '2-5'){ echo "selected";} ?>>2-5 Years</option>
                                                <option value="5-10" <?php if($data[0]['experience'] == '5-10'){ echo "selected";} ?>>5-10 Years</option>
                                                <option value="10-15" <?php if($data[0]['experience'] == '10-15'){ echo "selected";} ?>>10-15 Years</option>
                                                <option value="15+" <?php if($data[0]['experience'] == '15+'){ echo "selected";} ?>>15+ Years</option>
                                            </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label  >Skills</label>
                        <input type="text" name="skills" value="<?= $data[0]['skills'];?>" class="form-control">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group ">
                        <label  >Current Salary(INR)</label>
                        <select name="current_salary" class="form-control">
                                                <?php for($i=500; $i<10000; $i=$i+500): ?>
                                                <?php if($data[0]['current_salary'] == $i): ?>
                                                <option value="<?= $i; ?>" selected> <?= $i; ?> </option>
                                                <?php else: ?>
                                                <option><?= $i; ?></option>
                                                <?php endif; endfor; ?>
                                            </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label  >Expected Salary(INR)</label>
                        <select name="expected_salary" class="form-control">
                                                <?php for($i=500; $i<10000; $i=$i+500): ?>
                                                <?php if($data[0]['expected_salary'] == $i): ?>
                                                <option value="<?= $i; ?>" selected> <?= $i; ?> </option>
                                                <?php else: ?>
                                                <option><?= $i; ?></option>
                                                <?php endif; endfor; ?>
                                            </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group ">
                        <label  >Country</label>
                        <select class="form-control" id="country" name="country">
                                            <option value="">Select Country</option>
                                            <?php foreach($countries as $country):?>
                                                <?php if($data[0]['country'] == $country['id']): ?>
                                                <option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
                                                <?php else: ?>
                                                <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
                                                <?php endif; endforeach; ?>
                                            </select> 
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label  >State</label>
                        <?php
                                                $states = get_country_states($data[0]['country']);
                                                $options = array('' => 'Select State') + array_column($states, 'name', 'id');
                                                echo form_dropdown('state', $options, $data[0]['state'], 'class="state form-control" required');
                                            ?>
                      </div>
                    </div>

                    
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label  >City</label>
                                      <?php
                                            $cities = get_state_cities($data[0]['state']);
                                            $options = array('' => 'Select City') + array_column($cities, 'name', 'id');
                                            echo form_dropdown('city', $options, $data[0]['city'], 'class="city form-control" required');
                                        ?>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label  >Full Address</label>
                        <input type="text" name="address" value="<?= $data[0]['address'];?>" class="form-control">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <div class="big_form_group">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label  >Skills</label>
                        <select class="form-control">
                          <option>
                            PHP
                          </option>
                          <option>
                            MySQL
                          </option>
                          <option>
                            API Development
                          </option>

                        </select>
                      </div>
                    </div>
                  </div>
                </div> -->
                <div class="form-group row">
                  <div  class="col-md-9 ">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </div>
              </form>   
          </div>
          </div>   


          <!-- experiance start -->
          <hr>
                        <div class='row'>
                            <div class='col-md-9'> <h3>Experience</h3></div>      
                            <div class='col-md-1'><h3><span class="pull-left action-circle add-experience"><i class="fa fa-plus" data-toggle="collapse" data-target="#user-experience"></i></span></h3></div>                       
                        </div>

                      <div class='row'>
                        <?php foreach($experiences as $exp): ?>
                            <div class='col-md-12'>
                            <h4><?= $exp['job_title'] ?> at <?= $exp['company'] ?></h4>
                            <p><?= get_nth_month($exp['starting_month']) .' '.$exp['starting_year']?> - <?= (!$exp['currently_working_here']) ? get_nth_month($exp['ending_month']) .' '.$exp['ending_year'] : 'Present ' ?> | <?= get_country_name($exp['country']) ?></p>
                            <p class="overflow-ellipsis"><?= $exp['description'] ?></p>

                            <p class="overflow-ellipsis">
                            <a href="javascript:void(0)" class="edit-experience"  data-exp_id="<?= $exp['id'] ?>"><i class="fa fa-trash"></i> Edit</a>&nbsp;
                            <a href="<?= base_url('home/delete_experience/'.$exp['id']) ?>" class="btn-delete"><i class="fa fa-trash"></i> Delete</a>&nbsp;
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
                                            <?php foreach($countries as $country):?>
                                                <?php if($data[0]['country'] == $country['id']): ?>
                                                <option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
                                                <?php else: ?>
                                                <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
                                                <?php endif; endforeach; ?>
                                            </select>
                                </div>

                                <div class="col-md-3">
                                    <label>Start Month</label>         
                                    <?php 
                                    $options = get_months_list();
                                    echo form_dropdown('starting_month',$options,'','class="form-control" required');
                                    ?>    
                                </div>
                                <div class="col-md-3">
                                    <label>Start Year</label>         
                                    <?php 
                                    $options = get_years_list();
                                    echo form_dropdown('starting_year',$options,'','class="form-control" required');
                                    ?> 
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                  <div class="exp-end-field">
                                    <label>End  Month</label>         
                                    <?php 
                                    $options = get_months_list();
                                    echo form_dropdown('ending_month',$options,'','class="form-control " required');
                                    ?>  
                                    </div>        
                                </div>
                                <div class="col-md-3">
                                    <div class="exp-end-field">
                                      <label>End  Year</label>         
                                      <?php 
                                      $options = get_years_list();
                                      echo form_dropdown('ending_year',$options,'','class="form-control " required');
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

                      <!-- Languages start -->
                        <hr>
                        <div class='row'>
                            <div class='col-md-9'> <h3>Languages</h3></div>      
                            <div class='col-md-1'><h3><span class="pull-left action-circle add-experience"><i class="fa fa-plus" data-toggle="collapse" data-target="#user-language"></i></span></h3></div>                       
                        </div>

                        <!-- add user languages collapse -->
                        <div class='row'>
                            <div class='col-md-6'>
                                <label for="Language">Language</label>
                              
                            </div>

                            <div class='col-md-6'>
                            </div>
                        </div>
                        <!-- add user languages collapse -->

                        
                      <!-- Languages end -->



                        <hr>
                        <form action="<?= base_url('home/resume');?>" method="post" enctype="multipart/form-data">
                        <div class='row'>
                            <div class='col-md-12'> <h3>Resume / CV</h3></div>  
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
<?php include(VIEWPATH.'users/include/footer.php'); ?>

<script>
    var csfr_token_name = '<?= csrf_token() ?>';
    var csfr_token_value = '<?= csrf_hash() ?>';
    $(document).ready(function(){
      $('#country').on('change',function(){
        var data = {country: this.value,}
        data[csfr_token_name] = csfr_token_value;
        $.ajax({
          url: '<?= base_url('home/get_country_states'); ?>',
          type: 'POST',
          data: data,
          dataType: 'json',
          cached: false,
          success: function(obj){
            $('.state').html(obj.msg);
          }
        });
      });
      $('.state').on('change',function(){
        var data = {state: this.value,}
        data[csfr_token_name] = csfr_token_value;
        $.ajax({
          url: '<?= base_url('home/get_state_cities'); ?>',
          type: 'POST',
          data: data,
          dataType: 'json',
          cached: false,
          success: function(obj){
            $('.city').html(obj.msg);
          }
        });
      });
    });


    $('#experience').on('submit',function(){
    event.preventDefault();
    var fields = $('#experience').serialize();
    //console.log(fields);
    $.ajax({
        url: "<?= base_url('home/insert_user_experience'); ?>",
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


$(document).on('click','.edit-experience',function(){
  var data = {
    exp_id : $(this).data('exp_id'),
  }
  data[csfr_token_name] = csfr_token_value;
   $.ajax({
    type: 'POST',
    url: "<?= base_url('home/get_experience_by_id'); ?>",
    data: data,
    success: function (response) {
      console.log(response);
      $('#user-experience-edit').html(response);
      $('#user-experience-edit').collapse('show');
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