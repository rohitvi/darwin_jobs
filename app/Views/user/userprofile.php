<?php include(VIEWPATH . 'user/include/header.php'); ?>
<style>
    .nice-select,.list{width: 100%;}
    a {
    color: #2561b9;
    outline: medium none;
}
</style>
<!-- Hero Area Start-->
<div class="slider-area ">
    <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="assets/img/hero/about.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>Candidate Profile</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero Area End -->
<!-- Job List Area Start -->
<div class="job-listing-area pt-120 pb-120">
    <div class="container">
        <div class="row">
            <!-- Left content -->
            <div class="col-xl-3 col-lg-3 col-md-4">
                <div class="row">
                    <div class="col-12">
                            <div class="small-section-tittle2 mb-45">
                            <div class="ion"> <svg 
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="20px" height="12px">
                            <path fill-rule="evenodd"  fill="rgb(27, 207, 107)"
                                d="M7.778,12.000 L12.222,12.000 L12.222,10.000 L7.778,10.000 L7.778,12.000 ZM-0.000,-0.000 L-0.000,2.000 L20.000,2.000 L20.000,-0.000 L-0.000,-0.000 ZM3.333,7.000 L16.667,7.000 L16.667,5.000 L3.333,5.000 L3.333,7.000 Z"/>
                            </svg>
                            </div>
                            <h4>Filter Jobs</h4>
                        </div>
                    </div>
                </div>
                <!-- Job Category Listing start -->
                <div class="job-category-listing mb-50">
                   <div class="single-listing text-center">
                        <div class="out">
                            <a href="javascript:avoid(0)" class="employer-dashboard-thumb">
                                <img class="profile-picture img-fluid rounded" height="125" width="125" src="http://localhost/reference-job/uploads/profile_pictures/2371115986d7a15f9904cb4a355cf5f0.jpg" alt="">
                            </a>
                            <form id="change_file">
                                <div class="iconn">
                                    <label>
                                        <i class="loader_class fas fa-camera fa-3x"></i>
                                        <input type="file" style="display: none" name="profile_picture" class="change_file">
                                    </label>
                                </div>
                            </form>
                        </div>
                   </div>
                   <div class="single-listing mt-3 text-left">
                        <a href="<?= base_url('home/profile'); ?>" class="ahref mt-3">
                            <div class="icon"><i class="fas fa-user ml-3" aria-hidden="true"></i> &nbsp;&nbsp; My Profile</div>
                        </a>
                   </div>
                   <div class="single-listing mt-3 text-left">
                        <a href="<?= base_url('home/applied_jobs'); ?>" class="ahref mt-3">
                            <div class="icon"><i class="fas fa-file-word ml-3" aria-hidden="true"></i> &nbsp;&nbsp; My Applications</div>
                        </a>
                   </div>
                   <div class="single-listing mt-3 text-left">
                        <a href="<?= base_url('home/matching_jobs'); ?>" class="ahref mt-3">
                            <div class="icon"><i class="fas fa-briefcase ml-3" aria-hidden="true"></i> &nbsp;&nbsp; Matching Jobs</div>
                        </a>
                   </div>
                   <div class="single-listing mt-3 text-left">
                        <a href="<?= base_url('home/saved_jobs'); ?>" class="ahref mt-3">
                            <div class="icon"><i class="fas fa-heart ml-3" aria-hidden="true"></i> &nbsp;&nbsp; Saved Jobs</div>
                        </a>
                   </div>
                   <div class="single-listing mt-3 text-left">
                        <a href="<?= base_url('home/change_password'); ?>" class="ahref mt-3">
                            <div class="icon"><i class="fas fa-lock ml-3" aria-hidden="true"></i> &nbsp;&nbsp; Change Password</div>
                        </a>
                   </div>
                </div>
                <!-- Job Category Listing End -->
            </div>
            <!-- Right content -->
            <div class="col-xl-9 col-lg-9 col-md-8">
                <!-- Featured_job_start -->
                <section class="featured-job-area">
                    <div class="container">
                        <!-- Count of Job list Start -->
                        <!-- <div class="row">
                            <div class="col-lg-12">
                                <div class="count-job mb-35">
                                    <span>39, 782 Jobs found</span>
                                    <div class="select-job-items">
                                        <span>Sort by</span>
                                        <select name="select">
                                            <option value="">None</option>
                                            <option value="">job list</option>
                                            <option value="">job list</option>
                                            <option value="">job list</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!-- Count of Job list End -->
                        <!-- single-job-content -->
                        <h3>Personal Information</h3>
                        <hr>
                        <form action="<?= base_url('home/profile');?>" method="post" class="form-horizontal">
                                    <div class="form-group row mb-3">
                                        <div class="col-xl-10">
                                            <label class="form-control-label"><b>Profile Picture</b></label>
                                            <input type="file" name="profile_picture" class="form-control" placeholder="Confirm Password">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <div class="col-xl-5">
                                            <label class="form-control-label"><b>First Name *</b></label>
                                            <input type="text" name="firstname" value="<?= $data[0]['firstname'];?>" class="form-control">
                                        </div>
                                        <div class="col-xl-5">
                                            <label class="form-control-label"><b>Last Name *</b></label>
                                            <input type="text" name="lastname" value="<?= $data[0]['lastname'];?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <div class="col-xl-5">
                                            <label class="form-control-label"><b>Email *</b></label>
                                            <input type="email" name="email" value="<?= $data[0]['email'];?>" class="form-control">
                                        </div>
                                        <div class="col-xl-5">
                                            <label class="form-control-label"><b>Phone *</b></label>
                                            <input type="text" name="mobile_no" value="<?= $data[0]['mobile_no'];?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <div class="col-xl-5">
                                            <label class="form-control-label"><b>Date of Birth:</b></label>
                                            <input type="date" name="dob" value="<?= $data[0]['dob'];?>" class="form-control">
                                        </div>
                                        <div class="col-xl-5">
                                            <label class="form-control-label"><b>Age *</b></label><br>
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

                                    <div class="form-group row mb-3">
                                        <div class="col-xl-5">
                                            <label class="form-control-label"><b>Category  *</b></label><br>
                                            <select class="form-control select" name="category">
                                            <option value="">Select Category</option>
                                            <?php foreach($categories as $category):?>
                                                <?php if($data[0]['category'] == $category['id']): ?>
                                                    <option value="<?= $category['id']; ?>" selected> <?= $category['name']; ?> </option>
                                                    <?php else: ?>
                                                        <option value="<?= $category['id']; ?>"> <?= $category['name']; ?> </option>
                                                    <?php endif; endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-xl-5">
                                            <label class="form-control-label"><b>Job Title *</b></label>
                                            <input type="text" name="job_title" value="<?= $data[0]['job_title'];?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <div class="col-xl-5">
                                            <label class="form-control-label"><b>Experience *</b></label><br>
                                            <select name="experience" class="form-control">
                                                <option value="0-1" <?php if($data[0]['experience'] == '0-1'){ echo "selected";} ?>>0-1 Years</option>
                                                <option value="1-2" <?php if($data[0]['experience'] == '1-2'){ echo "selected";} ?>>1-2 Years</option>
                                                <option value="2-5" <?php if($data[0]['experience'] == '2-5'){ echo "selected";} ?>>2-5 Years</option>
                                                <option value="5-10" <?php if($data[0]['experience'] == '5-10'){ echo "selected";} ?>>5-10 Years</option>
                                                <option value="10-15" <?php if($data[0]['experience'] == '10-15'){ echo "selected";} ?>>10-15 Years</option>
                                                <option value="15+" <?php if($data[0]['experience'] == '15+'){ echo "selected";} ?>>15+ Years</option>
                                            </select>
                                           
                                        </div>
                                        <div class="col-xl-5">
                                            <label class="form-control-label"><b>Skills  *</b></label>
                                            <input type="text" name="skills" value="<?= $data[0]['skills'];?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                    <div class="col-xl-5">
                                            <label class="form-control-label"><b>Current Salary(INR) *</b></label>
                                            <select name="current_salary" class="form-control">
                                                <?php for($i=500; $i<10000; $i=$i+500): ?>
                                                <?php if($data[0]['current_salary'] == $i): ?>
                                                <option value="<?= $i; ?>" selected> <?= $i; ?> </option>
                                                <?php else: ?>
                                                <option><?= $i; ?></option>
                                                <?php endif; endfor; ?>
                                            </select>
                                        </div>
                                        <div class="col-xl-5">
                                            <label class="form-control-label"><b>Expected Salary(INR) *</b></label>
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

                                    <div class="row mb-3">
                                        <div class="col-xl-5 form-group">
                                            <label class="form-control-label"><b>Country *</b></label>
                                            <select class="form-control select" id="country" name="country">
                                            <option value="">Select Country</option>
                                            <?php foreach($countries as $country):?>
                                                <?php if($data[0]['country'] == $country['id']): ?>
                                                <option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
                                                <?php else: ?>
                                                <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
                                                <?php endif; endforeach; ?>
                                            </select> -->
                                        </div>
                                        <div class="col-xl-5 form-group">
                                            <label class="form-control-label"><b>State *</b></label>
                                            <?php
                                                $states = get_country_states($data[0]['country']);
                                                $options = array('' => 'Select State') + array_column($states, 'name', 'id');
                                                echo form_dropdown('state', $options, $data[0]['state'], 'class="state" required');
                                            ?>
                                        </div>
                                        <div class="col-xl-5 form-group">
                                            <label><b>City *</b></label>
                                            <?php
                                            $cities = get_state_cities($data[0]['state']);
                                            $options = array('' => 'Select City') + array_column($cities, 'name', 'id');
                                            echo form_dropdown('city', $options, $data[0]['city'], 'class="form-control select2bs4 city" required');
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <div class="col-xl-5">
                                            <label for="state">State *</label>
                                            <?php
                                                $states = get_country_states($data[0]['country']);
                                                $options = array('' => 'Select State') + array_column($states, 'name', 'id');
                                                echo form_dropdown('state', $options, $data[0]['state'], 'class="form-control select2bs4 state" required');
                                            ?>
                                        </div>

                                        <div class="col-xl-5">
                                        <label for="city">City *</label>
                                        <?php
                                            $cities = get_state_cities($data[0]['state']);
                                            $options = array('' => 'Select City') + array_column($cities, 'name', 'id');
                                            echo form_dropdown('city', $options, $data[0]['city'], 'class="city" required');
                                        ?>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <div class="col-xl-10">
                                            <label class="form-control-label"><b>Full Address</b></label>
                                            <input type="text" name="address" value="<?= $data[0]['address'];?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="text-left">
                                    <button class="btn btn-gradient-01" type="submit">Update</button>
                                    </div>
                        </form>

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
                            <a href="javascript:void(0)" class="edit-experience" data-exp_id="<?= $exp['id'] ?>"><i class="fa fa-trash"></i> Edit</a>&nbsp;
                            <a href="<?= base_url('home/delete_experience/'.$exp['id']) ?>" class="btn-delete"><i class="fa fa-trash"></i> Delete</a>&nbsp;
                            </p>
                
                            </div>
                            <?php endforeach; ?>
                        </div>

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
                                    <label>End  Month</label>         
                                    <?php 
                                    $options = get_months_list();
                                    echo form_dropdown('ending_month',$options,'','class="form-control " required');
                                    ?>        
                                </div>
                                <div class="col-md-3">
                                    <label>End  Year</label>         
                                    <?php 
                                $options = get_years_list();
                                echo form_dropdown('ending_year',$options,'','class="form-control " required');
                                ?>        
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

                    </div>
                </section>
                <!-- Featured_job_end -->
            </div>
        </div>
    </div>
</div>

<!-- Job List Area End -->
<?php include(VIEWPATH . 'user/include/footer.php'); ?>

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
          var state = this.value;
        var data = {state: this.value,}
        data[csfr_token_name] = csfr_token_value;
        // console.log(data);return false;
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
        url: "<?= base_url('home/experience'); ?>",
        method: "POST",
        data: fields,
         success:function(responses){
            var response = responses.split('~');
            $('#experience').trigger("reset");
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
