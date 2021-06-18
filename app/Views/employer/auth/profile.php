<?php include(VIEWPATH.'employer/include/header.php'); ?>

                <!-- End Left Sidebar -->
                <!-- Begin Content -->
                <div class="content-inner profile">
                    <div class="container-fluid">
                        <!-- Begin Page Header-->
                        <div class="row">
                            <div class="page-header">
                                <div class="d-flex align-items-center">
                                    <h2 class="page-header-title">Profile</h2>
                                    <div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?= base_url('employer/dashboard') ?>"><i class="ti ti-home"></i></a></li>
                                            <li class="breadcrumb-item active">Profile</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Page Header -->
                        <div class="row flex-row">
                            <div class="col-xl-3">
                                <!-- Begin Widget -->
                                <div class="widget has-shadow">
                                    <div class="widget-body">
                                        <div class="mt-5">
                                            <img src="<?= base_url('public/employer/assets/img/avatar/avatar-01.jpg') ?>" alt="..." style="width: 120px;" class="avatar rounded-circle d-block mx-auto">
                                        </div>
                                        <h3 class="text-center mt-3 mb-1">David Green</h3>
                                        <p class="text-center">dgreen@example.com</p>
                                        <div class="em-separator separator-dashed"></div>
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?= base_url('employer/mypackages') ?>"><i class="la la-bell la-2x align-middle pr-2"></i>My Packages</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="javascript:void(0)"><i class="la la-bolt la-2x align-middle pr-2"></i>Activity</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="javascript:void(0)"><i class="la la-comments la-2x align-middle pr-2"></i>Messages</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="javascript:void(0)"><i class="la la-bar-chart la-2x align-middle pr-2"></i>Statistics</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="javascript:void(0)"><i class="la la-clipboard la-2x align-middle pr-2"></i>Tasks</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="javascript:void(0)"><i class="la la-gears la-2x align-middle pr-2"></i>Settings</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="javascript:void(0)"><i class="la la-question-circle la-2x align-middle pr-2"></i>FAQ</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- End Widget -->
                            </div>
                            <div class="col-xl-9">
                                <div class="widget has-shadow">
                                    <div class="widget-header bordered no-actions d-flex align-items-center">
                                        <h4>Update Profile</h4>
                                    </div>
                                    <div class="widget-body">
                                        <div class="col-10 ml-auto">
                                            <div class="section-title mt-3 mb-3">
                                                <h4>01. Personnal Informations</h4>
                                            </div>
                                        </div>
                                        <form class="form-horizontal" action="<?= base_url('employer/personal_info_update');?>" method='post' enctype="multipart/form-data">
                                        <div class="widget-body">

                                        <div class="form-group row d-flex align-items-center mb-5">
                                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>Profile Picture</b></label>
                                            <div class="col-lg-6">
                                            <input type="file" class="form-control" value="<?= $data[0]['profile_picture'];?>" name='profile_picture'>
                                            </div>
                                        </div>

                                        <div class="form-group row d-flex align-items-center mb-5">
                                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>First Name</b></label>
                                            <div class="col-lg-6">
                                            <input type="text" class="form-control" value="<?= $data[0]['firstname'];?>" name="fname">
                                            </div>
                                        </div>

                                        <div class="form-group row d-flex align-items-center mb-5">
                                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>Last Name</b></label>
                                            <div class="col-lg-6">
                                            <input type="text" class="form-control"  value="<?= $data[0]['lastname'];?>" name="lastname">
                                            </div>
                                        </div>

                                        <div class="form-group row d-flex align-items-center mb-5">
                                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>Email</b></label>
                                            <div class="col-lg-6">
                                            <input type="email" class="form-control"  value="<?= $data[0]['email'];?>" name="email">
                                            </div>
                                        </div>

                                        <div class="form-group row d-flex align-items-center mb-5">
                                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>Designation</b></label>
                                            <div class="col-lg-6">
                                            <input type="text" class="form-control"  value="<?= $data[0]['designation'];?>" name="designation">
                                            </div>
                                        </div>

                                        <div class="form-group row d-flex align-items-center mb-5">
                                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>Phone Number *</b></label>
                                            <div class="col-lg-6">
                                            <input type="text" class="form-control"  value="<?= $data[0]['mobile_no'];?>" name="phoneno">
                                            </div>
                                        </div>


                            

                                        <div class="form-group row d-flex align-items-center mb-5">
                                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>Country *</b></label>
                                            <div class="col-lg-6">
                                                    <select name="country" id="country" class="country form-control">
                                                    <option>Select Country</option>
                                                    <?php foreach($countries as $country):?>
                                                        <?php if($data[0]['country'] == $country['id']): ?>
							                              <option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
							                            <?php else: ?>
							                              <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
                                                    <?php endif; endforeach; ?>
                                                    </select>
                                            </div>
                                        </div>

                                        <div class="form-group row d-flex align-items-center mb-5">
                                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>State *</b></label>
                                            <div class="col-lg-6">
                                            <select class="form-control" id="state" name="state">
                                                <option selected="selected">Select State</option>
                                            </select>
                                            </div>
                                        </div>

                                        <div class="form-group row d-flex align-items-center mb-5">
                                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>City *</b></label>
                                            <div class="col-lg-6">
                                            <select class="form-control" id="city" name="city">
                                                <option selected="selected">Select City</option>
                                            </select>
                                            </div>
                                        </div>

                                        <div class="form-group row d-flex align-items-center mb-5">
                                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>Address *</b></label>
                                            <div class="col-lg-6">
                                            <input type="text" class="form-control"  value="<?= $data[0]['address'];?>" name="address">
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button class="btn btn-gradient-01" type="submit">Update</button>
                                        </div>
                                    </div>
                                        <div class="em-separator separator-dashed"></div>
                                        
                                        </form>

                                        <div class="col-10 ml-auto">
                                            <div class="section-title mt-3 mb-3">
                                                <h4>02. Company Information</h4>
                                            </div>
                                        </div>
                                        <form class="form-horizontal" action='<?= base_url('employer/cmp_info_update');?>' method='post' enctype="multipart/form-data">
                                            <div class="form-group row d-flex align-items-center mb-5">
                                                <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>Company Logo *</b></label>
                                                <div class="col-lg-6">
                                                    <input type="file" class="form-control" value="<?= $cmpinfo[0]['company_logo'];?>" name='company_logo' placeholder="123 Century Blvd">
                                                </div>
                                            </div>
                                                    <div class="form-group row d-flex align-items-center mb-5">
                                                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>Company Name *</b></label>
                                                        <div class="col-lg-6">
                                                        <input type="text" class="form-control" value="<?= $cmpinfo[0]['company_name'];?>" name='company_name' placeholder="Enter Company Name">
                                                        </div>
                                                    </div>
                                            <div class="form-group row d-flex align-items-center mb-5">
                                                <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>Company Email *</b></label>
                                                <div class="col-lg-6">
                                                <input type="email" class="form-control" value="<?= $cmpinfo[0]['email'];?>" name='company_email' placeholder="Enter Company Email">
                                                </div>
                                            </div>
                                            <div class="form-group row d-flex align-items-center mb-5">
                                                <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>Phone No. *</b></label>
                                                <div class="col-lg-6">
                                                <input type="text" class="form-control" value="<?= $cmpinfo[0]['phone_no'];?>" name='phone_no' placeholder="Phone Number">
                                                </div>
                                            </div>
                                            <div class="form-group row d-flex align-items-center mb-5">
                                                <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>Website *</b></label>
                                                <div class="col-lg-6">
                                                <input type="text" class="form-control" value="<?= $cmpinfo[0]['website'];?>" name='website' placeholder="Website">
                                                </div>
                                            </div>
                                            <div class="form-group row d-flex align-items-center mb-5">
                                                <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>Category *</b></label>
                                                <div class="col-lg-6">

                                            <select class="form-control" name="category">
											<option value="">Select Category</option>
											<?php foreach($categories as $category):?>
												<?php if($cmpinfo[0]['category'] == $category['id']): ?>
													<option value="<?= $category['id']; ?>" selected> <?= $category['name']; ?> </option>
													<?php else: ?>
														<option value="<?= $category['id']; ?>"> <?= $category['name']; ?> </option>
													<?php endif; endforeach; ?>
												</select>
                                                </div>
                                            </div>
                                            <div class="form-group row d-flex align-items-center mb-5">
                                                <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>Founded Date</b></label>
                                                <div class="col-lg-6">
                                                <input type="date" class="form-control" value="<?= $cmpinfo[0]['founded_date'];?>" name='founded_date'>
                                                </div>
                                            </div>
                                            <div class="form-group row d-flex align-items-center mb-5">
                                                <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>Organization Type*</b></label>
                                                <div class="col-lg-6">
                                                <select name="org_type"  class="form-control" >
													<option value="Public" <?php if($cmpinfo[0]['org_type'] == 'Public'){ echo "selected";} ?>>public</option>
													<option value="Private" <?php if($cmpinfo[0]['org_type'] == 'Private'){ echo "selected";} ?>>private</option>
													<option value="Government" <?php if($cmpinfo[0]['org_type'] == 'Government'){ echo "selected";} ?>>government</option>
													<option value="NGO" <?php if($cmpinfo[0]['org_type'] == 'NGO'){ echo "selected";} ?>>ngo</option>
												</select>
                                                </div>
                                            </div>
                                            <div class="form-group row d-flex align-items-center mb-5">
                                                <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>No. of Employers *</b></label>
                                                <div class="col-lg-6">
                                                <select name="no_of_employers" class="form-control">
													<option value="1-10" <?php if($cmpinfo[0]['no_of_employers'] == '1-10'){ echo "selected";} ?>>1-10</option>
													<option value="10-20" <?php if($cmpinfo[0]['no_of_employers'] == '10-20'){ echo "selected";} ?>>10-20</option>
													<option value="20-30" <?php if($cmpinfo[0]['no_of_employers'] == '20-30'){ echo "selected";} ?>>20-30</option>
													<option value="30-50" <?php if($cmpinfo[0]['no_of_employers'] == '30-50'){ echo "selected";} ?>>30-50</option>
													<option value="50-100" <?php if($cmpinfo[0]['no_of_employers'] == '50-100'){ echo "selected";} ?>>50-100</option>
													<option value="100+" <?php if($cmpinfo[0]['no_of_employers'] == '100+'){ echo "selected";} ?>>100+</option>
												</select>
                                                </div>
                                            </div>
                                            <div class="form-group row d-flex align-items-center mb-5">
                                                <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>Company Description *</b></label>
                                                <div class="col-lg-6">
                                                <textarea class="form-control" name='description'><?= $cmpinfo[0]['description'];?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row d-flex align-items-center mb-5">
                                                <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>Country *</b></label>
                                                <div class="col-lg-6">
                                                <select name="country" id="ccountry" name="country" class="country form-control">
                                                    <option>Select Country</option>
                                                    <?php foreach($countries as $country):?>
                                                        <?php if($cmpinfo[0]['country'] == $country['id']): ?>
							                              <option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
							                            <?php else: ?>
							                              <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
                                                    <?php endif; endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row d-flex align-items-center mb-5">
                                                <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>State *</b></label>
                                                <div class="col-lg-6">
                                                    <select class="form-control" id="cstate" name="state">
                                                        <option selected="selected">Select State</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row d-flex align-items-center mb-5">
                                                <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>City *</b></label>
                                                <div class="col-lg-6">
                                                    <select class="form-control" id="ccity" name="state">
                                                        <option selected="selected">Select City</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row d-flex align-items-center mb-5">
                                                <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>Pin Code *</b></label>
                                                <div class="col-lg-6">
                                                <input type="text" class="form-control" value="<?= $cmpinfo[0]['postcode'];?>" name='postcode' placeholder="Pin Code">
                                                </div>
                                            </div>
                                            <div class="form-group row d-flex align-items-center mb-5">
                                                <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>Full Address *</b></label>
                                                <div class="col-lg-6">
                                                <input type="text" class="form-control" value="<?= $cmpinfo[0]['address'];?>" name='full_address' placeholder="Full Address">
                                                </div>
                                            </div>
                                            <div class="form-group row d-flex align-items-center mb-5">
                                                <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>Facebook</b></label>
                                                <div class="col-lg-6">
                                                <input type="text" class="form-control" value="<?= $cmpinfo[0]['facebook_link'];?>" name='facebook_link' placeholder="Facebook Link">
                                                </div>
                                            </div>
                                            <div class="form-group row d-flex align-items-center mb-5">
                                                <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>Twitter</b></label>
                                                <div class="col-lg-6">
                                                <input type="text" class="form-control" value="<?= $cmpinfo[0]['twitter_link'];?>" name='twitter_link' placeholder="Twitter Link">

                                                </div>
                                            </div>
                                            <div class="form-group row d-flex align-items-center mb-5">
                                                <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>Youtube</b></label>
                                                <div class="col-lg-6">
                                                <input type="text" class="form-control" value="<?= $cmpinfo[0]['youtube_link'];?>" name='youtube_link' placeholder="Youtube Link">

                                                </div>
                                            </div>
                                            <div class="form-group row d-flex align-items-center mb-5">
                                                <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>LinkedIn</b></label>
                                                <div class="col-lg-6">
                                                <input type="text" class="form-control" value="<?= $cmpinfo[0]['linkedin_link'];?>" name='linkedin_link' placeholder="LinkedIn Link">

                                                </div>
                                            </div>
                                            
                                        <div class="em-separator separator-dashed"></div>
                                        <div class="text-right">
                                            <button class="btn btn-gradient-01" type="submit">Update</button>
                                        </div>
                                        </form>

                                        <div class="col-10 ml-auto">
                                            <div class="section-title mt-3 mb-3">
                                                <h4>Change Password</h4>
                                            </div>
                                        </div>
                                        <form action="<?= base_url('employer/changepassword') ?>" method="post" class="form-horizontal">
                                            <div class="form-group row d-flex align-items-center mb-5">
                                                <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Password</label>
                                                <div class="col-lg-6">
                                                    <input type="password" name="password" class="form-control" placeholder="Enter Password">
                                                </div>
                                            </div>
                                            <div class="form-group row d-flex align-items-center mb-5">
                                                <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Confirm Password</label>
                                                <div class="col-lg-6">
                                                    <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password">
                                                </div>
                                            </div>
                                            <div class="em-separator separator-dashed"></div>
                                            <div class="text-right">
                                                <button class="btn btn-gradient-01" type="submit">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Row -->
                    </div>
                    <!-- End Container -->

<script>
$(document).ready(function(){
    $('#country').on('change',function(){
        var country_id = this.value;
        $.ajax({
          url: '<?= base_url('employer/profile'); ?>',
          type: 'POST',
          data: {
            country_id: country_id
          },
          cached: false,
          success: function(result){
            var json = JSON.parse(result);
            var $state = $('#state');
            for (var i = 0; i < json.length; i++) {
              $state.append('<option value=' + json[i].id + '>' + json[i].name + '</option>')
            }
            // $('#state').html(result);
            // $('#city').html('<option value="">Select State First!</option>');
          }
        });
      });

      $('#state').on('change',function(){
        var state_id = this.value;
        $.ajax({
          url: '<?= base_url('employer/getcities'); ?>',
          type: 'POST',
          data: {state_id:state_id},
          cached: false,
          success: function(result){
            var json = JSON.parse(result);
            var $cities = $('#city');
            for (var i = 0; i < json.length; i++) {
              $cities.append('<option value=' + json[i].id + '>' + json[i].name + '</option>');
            }
          }
        });
      });

      $('#ccountry').on('change',function(){
        var country_id = this.value;
        $.ajax({
          url: '<?= base_url('employer/profile'); ?>',
          type: 'POST',
          data: {
            country_id: country_id
          },
          cached: false,
          success: function(result){
            var json = JSON.parse(result);
            var $state = $('#cstate');
            for (var i = 0; i < json.length; i++) {
              $state.append('<option value=' + json[i].id + '>' + json[i].name + '</option>')
            }
            // $('#state').html(result);
            // $('#city').html('<option value="">Select State First!</option>');
          }
        });
      });
      $('#cstate').on('change',function(){
        var state_id = this.value;
        $.ajax({
          url: '<?= base_url('employer/getcities'); ?>',
          type: 'POST',
          data: {state_id:state_id},
          cached: false,
          success: function(result){
            var json = JSON.parse(result);
            var $cities = $('#ccity');
            for (var i = 0; i < json.length; i++) {
              $cities.append('<option value=' + json[i].id + '>' + json[i].name + '</option>');
            }
          }
        });
      });
});
</script>


<?php include(VIEWPATH.'employer/include/footer.php'); ?>
