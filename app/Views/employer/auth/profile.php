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
                                    <div id='widgetbody' class="widget-body">
                                        <div class="mt-5">
                                            <img src="<?= base_url('public/employer/assets/img/avatar/avatar-01.jpg') ?>" alt="..." style="width: 120px;" class="avatar rounded-circle d-block mx-auto">
                                        </div>
                                        <h3 class="text-center mt-3 mb-1">David Green</h3>
                                        <p class="text-center">dgreen@example.com</p>
                                        <div class="em-separator separator-dashed"></div>
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?= base_url('employer/profile') ?>"><i class="la la-user la-2x align-middle pr-2"></i>Personal Information</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?= base_url('employer/mypackages') ?>"><i class="la la-bell la-2x align-middle pr-2"></i>My Packages</a>
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
                                            <input type="file" class="form-control"  name='profile_picture'>
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
										<?php 
					                        $states = get_country_states($data[0]['country']);
					                        $options = array('' => 'Select State')+array_column($states, 'name','id');
					                        echo form_dropdown('state',$options,$data[0]['state'],'class="form-control state" required');
					                      ?>
                                            </div>
                                        </div>

                                        <div class="form-group row d-flex align-items-center mb-5">
                                        <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>City *</b></label>
                                            <div class="col-lg-6">
                                                <?php 
                                                $cities = get_state_cities($data[0]['state']);
                                                $options = array('' => 'Select City')+array_column($cities, 'name','id');
                                                echo form_dropdown('city',$options,$data[0]['city'],'class="form-control city" required');
                                                ?>
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
                                                <?php 
                                                    $states = get_country_states($cmpinfo[0]['country']);
                                                    $options = array('' => 'Select State')+array_column($states, 'name','id');
                                                    echo form_dropdown('state',$options,$cmpinfo[0]['state'],'class="form-control state" required');
                                                ?>
                                                </div>
                                            </div>
                                            <div class="form-group row d-flex align-items-center mb-5">
                                                <label class="col-lg-3 form-control-label d-flex justify-content-lg-end"><b>City *</b></label>
                                                <div class="col-lg-6">
                                                <?php 
                                                $cities = get_state_cities($cmpinfo[0]['state']);
                                                $options = array('' => 'Select City')+array_column($cities, 'name','id');
                                                echo form_dropdown('city',$options,$cmpinfo[0]['city'],'class="form-control city" required');
                                                ?>
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

                                
<!-- tab start -->
<div class="col-xl-10">
                                                <div id="rootwizard">
                                                    <div class="step-container">
                                                        <div class="step-wizard">
                                                            <div class="progress">
                                                                <div class="progressbar" style="width: 33.3333%;"></div>
                                                            </div>
                                                            <ul class="nav nav-pills">
                                                                <li>
                                                                    <a href="#tab1" data-toggle="tab" class="active show">
                                                                        <span class="step">1</span>
                                                                        <span class="title">Step 1</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#tab2" data-toggle="tab" class="">
                                                                        <span class="step">2</span>
                                                                        <span class="title">Step 2</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#tab3" data-toggle="tab" class="">
                                                                        <span class="step">3</span>
                                                                        <span class="title">Step 3</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="tab-content">
                                                        <div class="tab-pane active show" id="tab1">
                                                            <div class="section-title mt-5 mb-5">
                                                                <h4>Client Informations</h4>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <div class="col-xl-6 mb-3">
                                                                    <label class="form-control-label">Name<span class="text-danger ml-2">*</span></label>
                                                                    <input type="text" value="David Green" class="form-control">
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <label class="form-control-label">Email<span class="text-danger ml-2">*</span></label>
                                                                    <input type="email" value="dgreen@elisyam.com" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-5">
                                                                <div class="col-xl-6 mb-3">
                                                                    <label class="form-control-label">Phone</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon addon-secondary">
                                                                            <i class="la la-phone"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control" value="+00 987 654 32">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <label class="form-control-label">Occupation</label>
                                                                    <input type="text" value="UX Designer" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="section-title mt-5 mb-5">
                                                                <h4>Address</h4>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <div class="col-xl-6 mb-3">
                                                                    <label class="form-control-label">Address<span class="text-danger ml-2">*</span></label>
                                                                    <input type="text" value="123 Century Blvd" class="form-control">
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <label class="form-control-label">Country<span class="text-danger ml-2">*</span></label>
                                                                    <select name="country" class="custom-select form-control">
                                                                        <option value="">Select</option>
                                                                        <option value="AF">Afghanistan</option>
                                                                        <option value="AX">Åland Islands</option>
                                                                        <option value="AL">Albania</option>
                                                                        <option value="DZ">Algeria</option>
                                                                        <option value="AS">American Samoa</option>
                                                                        <option value="AD">Andorra</option>
                                                                        <option value="AO">Angola</option>
                                                                        <option value="AI">Anguilla</option>
                                                                        <option value="AQ">Antarctica</option>
                                                                        <option value="AG">Antigua and Barbuda</option>
                                                                        <option value="AR">Argentina</option>
                                                                        <option value="AM">Armenia</option>
                                                                        <option value="AW">Aruba</option>
                                                                        <option value="AU">Australia</option>
                                                                        <option value="AT">Austria</option>
                                                                        <option value="AZ">Azerbaijan</option>
                                                                        <option value="BS">Bahamas</option>
                                                                        <option value="BH">Bahrain</option>
                                                                        <option value="BD">Bangladesh</option>
                                                                        <option value="BB">Barbados</option>
                                                                        <option value="BY">Belarus</option>
                                                                        <option value="BE">Belgium</option>
                                                                        <option value="BZ">Belize</option>
                                                                        <option value="BJ">Benin</option>
                                                                        <option value="BM">Bermuda</option>
                                                                        <option value="BT">Bhutan</option>
                                                                        <option value="BO">Bolivia, Plurinational State of</option>
                                                                        <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                                                        <option value="BA">Bosnia and Herzegovina</option>
                                                                        <option value="BW">Botswana</option>
                                                                        <option value="BV">Bouvet Island</option>
                                                                        <option value="BR">Brazil</option>
                                                                        <option value="IO">British Indian Ocean Territory</option>
                                                                        <option value="BN">Brunei Darussalam</option>
                                                                        <option value="BG">Bulgaria</option>
                                                                        <option value="BF">Burkina Faso</option>
                                                                        <option value="BI">Burundi</option>
                                                                        <option value="KH">Cambodia</option>
                                                                        <option value="CM">Cameroon</option>
                                                                        <option value="CA">Canada</option>
                                                                        <option value="CV">Cape Verde</option>
                                                                        <option value="KY">Cayman Islands</option>
                                                                        <option value="CF">Central African Republic</option>
                                                                        <option value="TD">Chad</option>
                                                                        <option value="CL">Chile</option>
                                                                        <option value="CN">China</option>
                                                                        <option value="CX">Christmas Island</option>
                                                                        <option value="CC">Cocos (Keeling) Islands</option>
                                                                        <option value="CO">Colombia</option>
                                                                        <option value="KM">Comoros</option>
                                                                        <option value="CG">Congo</option>
                                                                        <option value="CD">Congo, the Democratic Republic of the</option>
                                                                        <option value="CK">Cook Islands</option>
                                                                        <option value="CR">Costa Rica</option>
                                                                        <option value="CI">Côte d'Ivoire</option>
                                                                        <option value="HR">Croatia</option>
                                                                        <option value="CU">Cuba</option>
                                                                        <option value="CW">Curaçao</option>
                                                                        <option value="CY">Cyprus</option>
                                                                        <option value="CZ">Czech Republic</option>
                                                                        <option value="DK">Denmark</option>
                                                                        <option value="DJ">Djibouti</option>
                                                                        <option value="DM">Dominica</option>
                                                                        <option value="DO">Dominican Republic</option>
                                                                        <option value="EC">Ecuador</option>
                                                                        <option value="EG">Egypt</option>
                                                                        <option value="SV">El Salvador</option>
                                                                        <option value="GQ">Equatorial Guinea</option>
                                                                        <option value="ER">Eritrea</option>
                                                                        <option value="EE">Estonia</option>
                                                                        <option value="ET">Ethiopia</option>
                                                                        <option value="FK">Falkland Islands (Malvinas)</option>
                                                                        <option value="FO">Faroe Islands</option>
                                                                        <option value="FJ">Fiji</option>
                                                                        <option value="FI">Finland</option>
                                                                        <option value="FR">France</option>
                                                                        <option value="GF">French Guiana</option>
                                                                        <option value="PF">French Polynesia</option>
                                                                        <option value="TF">French Southern Territories</option>
                                                                        <option value="GA">Gabon</option>
                                                                        <option value="GM">Gambia</option>
                                                                        <option value="GE">Georgia</option>
                                                                        <option value="DE">Germany</option>
                                                                        <option value="GH">Ghana</option>
                                                                        <option value="GI">Gibraltar</option>
                                                                        <option value="GR">Greece</option>
                                                                        <option value="GL">Greenland</option>
                                                                        <option value="GD">Grenada</option>
                                                                        <option value="GP">Guadeloupe</option>
                                                                        <option value="GU">Guam</option>
                                                                        <option value="GT">Guatemala</option>
                                                                        <option value="GG">Guernsey</option>
                                                                        <option value="GN">Guinea</option>
                                                                        <option value="GW">Guinea-Bissau</option>
                                                                        <option value="GY">Guyana</option>
                                                                        <option value="HT">Haiti</option>
                                                                        <option value="HM">Heard Island and McDonald Islands</option>
                                                                        <option value="VA">Holy See (Vatican City State)</option>
                                                                        <option value="HN">Honduras</option>
                                                                        <option value="HK">Hong Kong</option>
                                                                        <option value="HU">Hungary</option>
                                                                        <option value="IS">Iceland</option>
                                                                        <option value="IN">India</option>
                                                                        <option value="ID">Indonesia</option>
                                                                        <option value="IR">Iran, Islamic Republic of</option>
                                                                        <option value="IQ">Iraq</option>
                                                                        <option value="IE">Ireland</option>
                                                                        <option value="IM">Isle of Man</option>
                                                                        <option value="IL">Israel</option>
                                                                        <option value="IT">Italy</option>
                                                                        <option value="JM">Jamaica</option>
                                                                        <option value="JP">Japan</option>
                                                                        <option value="JE">Jersey</option>
                                                                        <option value="JO">Jordan</option>
                                                                        <option value="KZ">Kazakhstan</option>
                                                                        <option value="KE">Kenya</option>
                                                                        <option value="KI">Kiribati</option>
                                                                        <option value="KP">Korea, Democratic People's Republic of</option>
                                                                        <option value="KR">Korea, Republic of</option>
                                                                        <option value="KW">Kuwait</option>
                                                                        <option value="KG">Kyrgyzstan</option>
                                                                        <option value="LA">Lao People's Democratic Republic</option>
                                                                        <option value="LV">Latvia</option>
                                                                        <option value="LB">Lebanon</option>
                                                                        <option value="LS">Lesotho</option>
                                                                        <option value="LR">Liberia</option>
                                                                        <option value="LY">Libya</option>
                                                                        <option value="LI">Liechtenstein</option>
                                                                        <option value="LT">Lithuania</option>
                                                                        <option value="LU">Luxembourg</option>
                                                                        <option value="MO">Macao</option>
                                                                        <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                                                                        <option value="MG">Madagascar</option>
                                                                        <option value="MW">Malawi</option>
                                                                        <option value="MY">Malaysia</option>
                                                                        <option value="MV">Maldives</option>
                                                                        <option value="ML">Mali</option>
                                                                        <option value="MT">Malta</option>
                                                                        <option value="MH">Marshall Islands</option>
                                                                        <option value="MQ">Martinique</option>
                                                                        <option value="MR">Mauritania</option>
                                                                        <option value="MU">Mauritius</option>
                                                                        <option value="YT">Mayotte</option>
                                                                        <option value="MX">Mexico</option>
                                                                        <option value="FM">Micronesia, Federated States of</option>
                                                                        <option value="MD">Moldova, Republic of</option>
                                                                        <option value="MC">Monaco</option>
                                                                        <option value="MN">Mongolia</option>
                                                                        <option value="ME">Montenegro</option>
                                                                        <option value="MS">Montserrat</option>
                                                                        <option value="MA">Morocco</option>
                                                                        <option value="MZ">Mozambique</option>
                                                                        <option value="MM">Myanmar</option>
                                                                        <option value="NA">Namibia</option>
                                                                        <option value="NR">Nauru</option>
                                                                        <option value="NP">Nepal</option>
                                                                        <option value="NL">Netherlands</option>
                                                                        <option value="NC">New Caledonia</option>
                                                                        <option value="NZ">New Zealand</option>
                                                                        <option value="NI">Nicaragua</option>
                                                                        <option value="NE">Niger</option>
                                                                        <option value="NG">Nigeria</option>
                                                                        <option value="NU">Niue</option>
                                                                        <option value="NF">Norfolk Island</option>
                                                                        <option value="MP">Northern Mariana Islands</option>
                                                                        <option value="NO">Norway</option>
                                                                        <option value="OM">Oman</option>
                                                                        <option value="PK">Pakistan</option>
                                                                        <option value="PW">Palau</option>
                                                                        <option value="PS">Palestinian Territory, Occupied</option>
                                                                        <option value="PA">Panama</option>
                                                                        <option value="PG">Papua New Guinea</option>
                                                                        <option value="PY">Paraguay</option>
                                                                        <option value="PE">Peru</option>
                                                                        <option value="PH">Philippines</option>
                                                                        <option value="PN">Pitcairn</option>
                                                                        <option value="PL">Poland</option>
                                                                        <option value="PT">Portugal</option>
                                                                        <option value="PR">Puerto Rico</option>
                                                                        <option value="QA">Qatar</option>
                                                                        <option value="RE">Réunion</option>
                                                                        <option value="RO">Romania</option>
                                                                        <option value="RU">Russian Federation</option>
                                                                        <option value="RW">Rwanda</option>
                                                                        <option value="BL">Saint Barthélemy</option>
                                                                        <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                                                        <option value="KN">Saint Kitts and Nevis</option>
                                                                        <option value="LC">Saint Lucia</option>
                                                                        <option value="MF">Saint Martin (French part)</option>
                                                                        <option value="PM">Saint Pierre and Miquelon</option>
                                                                        <option value="VC">Saint Vincent and the Grenadines</option>
                                                                        <option value="WS">Samoa</option>
                                                                        <option value="SM">San Marino</option>
                                                                        <option value="ST">Sao Tome and Principe</option>
                                                                        <option value="SA">Saudi Arabia</option>
                                                                        <option value="SN">Senegal</option>
                                                                        <option value="RS">Serbia</option>
                                                                        <option value="SC">Seychelles</option>
                                                                        <option value="SL">Sierra Leone</option>
                                                                        <option value="SG">Singapore</option>
                                                                        <option value="SX">Sint Maarten (Dutch part)</option>
                                                                        <option value="SK">Slovakia</option>
                                                                        <option value="SI">Slovenia</option>
                                                                        <option value="SB">Solomon Islands</option>
                                                                        <option value="SO">Somalia</option>
                                                                        <option value="ZA">South Africa</option>
                                                                        <option value="GS">South Georgia and the South Sandwich Islands</option>
                                                                        <option value="SS">South Sudan</option>
                                                                        <option value="ES">Spain</option>
                                                                        <option value="LK">Sri Lanka</option>
                                                                        <option value="SD">Sudan</option>
                                                                        <option value="SR">Suriname</option>
                                                                        <option value="SJ">Svalbard and Jan Mayen</option>
                                                                        <option value="SZ">Swaziland</option>
                                                                        <option value="SE">Sweden</option>
                                                                        <option value="CH">Switzerland</option>
                                                                        <option value="SY">Syrian Arab Republic</option>
                                                                        <option value="TW">Taiwan, Province of China</option>
                                                                        <option value="TJ">Tajikistan</option>
                                                                        <option value="TZ">Tanzania, United Republic of</option>
                                                                        <option value="TH">Thailand</option>
                                                                        <option value="TL">Timor-Leste</option>
                                                                        <option value="TG">Togo</option>
                                                                        <option value="TK">Tokelau</option>
                                                                        <option value="TO">Tonga</option>
                                                                        <option value="TT">Trinidad and Tobago</option>
                                                                        <option value="TN">Tunisia</option>
                                                                        <option value="TR">Turkey</option>
                                                                        <option value="TM">Turkmenistan</option>
                                                                        <option value="TC">Turks and Caicos Islands</option>
                                                                        <option value="TV">Tuvalu</option>
                                                                        <option value="UG">Uganda</option>
                                                                        <option value="UA">Ukraine</option>
                                                                        <option value="AE">United Arab Emirates</option>
                                                                        <option value="GB">United Kingdom</option>
                                                                        <option value="US" selected="">United States</option>
                                                                        <option value="UM">United States Minor Outlying Islands</option>
                                                                        <option value="UY">Uruguay</option>
                                                                        <option value="UZ">Uzbekistan</option>
                                                                        <option value="VU">Vanuatu</option>
                                                                        <option value="VE">Venezuela, Bolivarian Republic of</option>
                                                                        <option value="VN">Viet Nam</option>
                                                                        <option value="VG">Virgin Islands, British</option>
                                                                        <option value="VI">Virgin Islands, U.S.</option>
                                                                        <option value="WF">Wallis and Futuna</option>
                                                                        <option value="EH">Western Sahara</option>
                                                                        <option value="YE">Yemen</option>
                                                                        <option value="ZM">Zambia</option>
                                                                        <option value="ZW">Zimbabwe</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <div class="col-xl-4 mb-3">
                                                                    <label class="form-control-label">City<span class="text-danger ml-2">*</span></label>
                                                                    <input type="text" value="Los Angeles" class="form-control">
                                                                </div>
                                                                <div class="col-xl-4 mb-5">
                                                                    <label class="form-control-label">State<span class="text-danger ml-2">*</span></label>
                                                                    <input type="email" value="CA" class="form-control">
                                                                </div>
                                                                <div class="col-xl-4">
                                                                    <label class="form-control-label">Zip<span class="text-danger ml-2">*</span></label>
                                                                    <input type="email" value="90045" class="form-control">
                                                                </div>
                                                            </div>
                                                            <ul class="pager wizard text-right">
                                                                <li class="previous d-inline-block disabled">
                                                                    <a href="javascript:;" class="btn btn-secondary ripple">Previous</a>
                                                                </li>
                                                                <li class="next d-inline-block">
                                                                    <a href="javascript:;" class="btn btn-gradient-01">Next</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="tab-pane" id="tab2">
                                                            <div class="section-title mt-5 mb-5">
                                                                <h4>Account Details</h4>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <div class="col-xl-6 mb-3">
                                                                    <label class="form-control-label">Username<span class="text-danger ml-2">*</span></label>
                                                                    <input type="text" value="DGreen" class="form-control">
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <label class="form-control-label">Password<span class="text-danger ml-2">*</span></label>
                                                                    <input type="text" value="**********" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <div class="col-xl-12">
                                                                    <label class="form-control-label">Url</label>
                                                                    <input type="url" value="http://mywebsite.com" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="section-title mt-5 mb-5">
                                                                <h4>Billing Information</h4>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <div class="col-xl-12 mb-3">
                                                                    <label class="form-control-label">Card Number</label>
                                                                    <input type="text" value="98765432145698547" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <div class="col-xl-4 mb-3">
                                                                    <label class="form-control-label">Exp Month<span class="text-danger ml-2">*</span></label>
                                                                    <select name="exp-month" class="custom-select form-control">
                                                                        <option value="">Select</option>
                                                                        <option value="01">01</option>
                                                                        <option value="02">02</option>
                                                                        <option value="03">03</option>
                                                                        <option value="04">04</option>
                                                                        <option value="05">05</option>
                                                                        <option value="06" selected="">06</option>
                                                                        <option value="07">07</option>
                                                                        <option value="08">08</option>
                                                                        <option value="09">09</option>
                                                                        <option value="10">10</option>
                                                                        <option value="11">11</option>
                                                                        <option value="12">12</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-xl-4 mb-3">
                                                                    <label class="form-control-label">Exp Year<span class="text-danger ml-2">*</span></label>
                                                                    <select name="exp-month" class="custom-select form-control">
                                                                        <option value="2018">2018</option>
                                                                        <option value="2019">2019</option>
                                                                        <option value="2020">2020</option>
                                                                        <option value="2021">2021</option>
                                                                        <option value="2022">2022</option>
                                                                        <option value="2023" selected="">2023</option>
                                                                        <option value="2024">2024</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-xl-4">
                                                                    <label class="form-control-label">CVV<span class="text-danger ml-2">*</span></label>
                                                                    <input type="email" value="651" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <div class="col-xl-12">
                                                                    <div class="styled-checkbox">
                                                                        <input type="checkbox" name="savecard" id="check-card">
                                                                        <label for="check-card">Save this card</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <ul class="pager wizard text-right">
                                                                <li class="previous d-inline-block disabled">
                                                                    <a href="javascript:;" class="btn btn-secondary ripple">Previous</a>
                                                                </li>
                                                                <li class="next d-inline-block">
                                                                    <a href="javascript:;" class="btn btn-gradient-01">Next</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="tab-pane" id="tab3">
                                                            <div class="section-title mt-5 mb-5">
                                                                <h4>Confirmation</h4>
                                                            </div>
                                                            <div id="accordion-icon-right" class="accordion">
                                                                <div class="widget has-shadow">
                                                                    <a class="card-header collapsed d-flex align-items-center" data-toggle="collapse" href="#IconRightCollapseOne" aria-expanded="true">
                                                                        <div class="card-title w-100">1. Client Informations</div>
                                                                    </a>
                                                                    <div id="IconRightCollapseOne" class="card-body collapse show" data-parent="#accordion-icon-right">
                                                                        <div class="form-group row mb-5">
                                                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Name</div>
                                                                            <div class="col-sm-8 form-control-plaintext">David Green</div>
                                                                        </div>
                                                                        <div class="form-group row mb-5">
                                                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Email</div>
                                                                            <div class="col-sm-8 form-control-plaintext">dgreen@elisyam.com</div>
                                                                        </div>
                                                                        <div class="form-group row mb-5">
                                                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Phone</div>
                                                                            <div class="col-sm-8 form-control-plaintext">+00 987 654 32</div>
                                                                        </div>
                                                                        <div class="form-group row mb-5">
                                                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Occupation</div>
                                                                            <div class="col-sm-8 form-control-plaintext">UX Designer</div>
                                                                        </div>
                                                                    </div>
                                                                    <a class="card-header collapsed d-flex align-items-center" data-toggle="collapse" href="#IconRightCollapseTwo">
                                                                        <div class="card-title w-100">2. Address</div>
                                                                    </a>
                                                                    <div id="IconRightCollapseTwo" class="card-body collapse" data-parent="#accordion-icon-right">
                                                                        <div class="form-group row mb-5">
                                                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Address</div>
                                                                            <div class="col-sm-8 form-control-plaintext">123 Century Blvd</div>
                                                                        </div>
                                                                        <div class="form-group row mb-5">
                                                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Country</div>
                                                                            <div class="col-sm-8 form-control-plaintext">Country</div>
                                                                        </div>
                                                                        <div class="form-group row mb-5">
                                                                            <div class="col-sm-3 form-control-label d-flex align-items-center">City</div>
                                                                            <div class="col-sm-8 form-control-plaintext">Los Angeles</div>
                                                                        </div>
                                                                        <div class="form-group row mb-5">
                                                                            <div class="col-sm-3 form-control-label d-flex align-items-center">State</div>
                                                                            <div class="col-sm-8 form-control-plaintext">CA</div>
                                                                        </div>
                                                                        <div class="form-group row mb-5">
                                                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Zip</div>
                                                                            <div class="col-sm-8 form-control-plaintext">90045</div>
                                                                        </div>
                                                                    </div>
                                                                    <a class="card-header collapsed d-flex align-items-center" data-toggle="collapse" href="#IconRightCollapseThree">
                                                                        <div class="card-title w-100">3. Account Details</div>
                                                                    </a>
                                                                    <div id="IconRightCollapseThree" class="card-body collapse" data-parent="#accordion-icon-right">
                                                                        <div class="form-group row mb-5">
                                                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Username</div>
                                                                            <div class="col-sm-8 form-control-plaintext">Saerox</div>
                                                                        </div>
                                                                        <div class="form-group row mb-5">
                                                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Password</div>
                                                                            <div class="col-sm-8 form-control-plaintext"><span class="la-2x">*********</span></div>
                                                                        </div>
                                                                        <div class="form-group row mb-5">
                                                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Url</div>
                                                                            <div class="col-sm-8 form-control-plaintext">http://mywebsite.com</div>
                                                                        </div>
                                                                    </div>
                                                                    <a class="card-header collapsed d-flex align-items-center" data-toggle="collapse" href="#IconRightCollapseFour">
                                                                        <div class="card-title w-100">4. Billing Information</div>
                                                                    </a>
                                                                    <div id="IconRightCollapseFour" class="card-body collapse" data-parent="#accordion-icon-right">
                                                                        <div class="form-group row mb-5">
                                                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Card Number</div>
                                                                            <div class="col-sm-8 form-control-plaintext">98765432145698547</div>
                                                                        </div>
                                                                        <div class="form-group row mb-5">
                                                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Exp Month</div>
                                                                            <div class="col-sm-8 form-control-plaintext">06</div>
                                                                        </div>
                                                                        <div class="form-group row mb-5">
                                                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Exp Year</div>
                                                                            <div class="col-sm-8 form-control-plaintext">2023</div>
                                                                        </div>
                                                                        <div class="form-group row mb-5">
                                                                            <div class="col-sm-3 form-control-label d-flex align-items-center">CVV</div>
                                                                            <div class="col-sm-8 form-control-plaintext">651</div>
                                                                        </div>
                                                                        <div class="form-group row mb-5">
                                                                            <div class="col-xl-12">
                                                                                <div class="styled-checkbox">
                                                                                    <input type="checkbox" name="checkbox" id="agree">
                                                                                    <label for="agree">I Accept <a href="#">Terms and Conditions</a></label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <ul class="pager wizard text-right">
                                                                <li class="previous d-inline-block disabled">
                                                                    <a href="javascript:void(0)" class="btn btn-secondary ripple">Previous</a>
                                                                </li>
                                                                <li class="next d-inline-block">
                                                                    <a href="javascript:void(0)" class="finish btn btn-gradient-01" data-toggle="modal">Finish</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
<!-- tab end -->






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
