<?php include(VIEWPATH . 'employer/include/header.php'); ?>
<style>
    .tab-content input,
    .select {
        border: 1px solid #2c304d;
    }
</style>
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
                <!-- End col-xl-9 -->
                <div class="widget has-shadow">
                    <div class="widget-header bordered no-actions d-flex align-items-center">
                        <h4>Wizard Example</h4>
                    </div>
                    <div class="widget-body">
                        <div class="row flex-row justify-content-center">
                            <div class="col-xl-10">
                                <div id="rootwizard">
                                    <div class="step-container">
                                        <div class="step-wizard">
                                            <div class="progress">
                                                <div class="progressbar" style="width: 33.3333%;"></div>
                                            </div>
                                            <ul>
                                                <li>
                                                    <a href="#tab1" data-toggle="tab">
                                                        <span class="step">1</span>
                                                        <span class="title">Step 1</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#tab2" data-toggle="tab">
                                                        <span class="step">2</span>
                                                        <span class="title">Step 2</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#tab3" data-toggle="tab">
                                                        <span class="step">3</span>
                                                        <span class="title">Step 3</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-content">
                                        <div class="tab-pane active show" id="tab1">
                                            <form class="form-horizontal" action="<?= base_url('employer/personal_info_update'); ?>" method='post' enctype="multipart/form-data">
                                                <div class="section-title mt-5 mb-5">
                                                    <h4>Personnal Informations</h4>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <div class="col-xl-12 mb-3">
                                                        <label class="form-control-label"><b>Profile Picture</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="la la-photo"></i>
                                                            </span>
                                                            <input type="file" class="form-control" name='profile_picture'>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <div class="col-xl-6 mb-3">
                                                        <label class="form-control-label"><b>First Name</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="la la-user"></i>
                                                            </span>
                                                            <input type="text" class="form-control" value="<?= $data[0]['firstname']; ?>" name="fname">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <label class="form-control-label"><b>Last Name</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="la la-user"></i>
                                                            </span>
                                                            <input type="text" class="form-control" value="<?= $data[0]['lastname']; ?>" name="lastname">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <div class="col-xl-6 mb-3">
                                                        <label class="form-control-label"><b>Email</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="la la-envelope"></i>
                                                            </span>
                                                            <input type="email" class="form-control" value="<?= $data[0]['email']; ?>" name="email">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <label class="form-control-label"><b>Designation</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="ti ti-briefcase"></i>
                                                            </span>
                                                            <input type="text" class="form-control" value="<?= $data[0]['designation']; ?>" name="designation">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <div class="col-xl-6 mb-3">
                                                        <label class="form-control-label"><b>Phone Number</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="la la-phone"></i>
                                                            </span>
                                                            <input type="text" class="form-control" value="<?= $data[0]['mobile_no']; ?>" name="phoneno">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <label class="form-control-label"><b>Country</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="ti-location-pin"></i>
                                                            </span>
                                                            <select name="country" id="country" class="country form-control select">
                                                                <option>Select Country</option>
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
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <div class="col-xl-6 mb-3">
                                                        <label class="form-control-label"><b>State</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="ti-location-pin"></i>
                                                            </span>
                                                            <?php
                                                            $states = get_country_states($data[0]['country']);
                                                            $options = array('' => 'Select State') + array_column($states, 'name', 'id');
                                                            echo form_dropdown('state', $options, $data[0]['state'], 'class="form-control state select" required');
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <label class="form-control-label"><b>City</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="ti-location-pin"></i>
                                                            </span>
                                                            <?php
                                                            $cities = get_state_cities($data[0]['state']);
                                                            $options = array('' => 'Select City') + array_column($cities, 'name', 'id');
                                                            echo form_dropdown('city', $options, $data[0]['city'], 'class="form-control city select" required');
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <div class="col-xl-12 mb-3">
                                                        <label class="form-control-label"><b>Address</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="ti-location-pin"></i>
                                                            </span>
                                                            <input type="text" class="form-control" value="<?= $data[0]['address']; ?>" name="address">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="text-left">
                                                    <button class="btn btn-gradient-01" type="submit">Update</button>
                                                </div>
                                            </form>
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
                                                <h4>Company Information</h4>
                                            </div>
                                            <form class="form-horizontal" action='<?= base_url('employer/cmp_info_update'); ?>' method='post' enctype="multipart/form-data">
                                                <div class="form-group row mb-3">
                                                    <div class="col-xl-12 mb-3">
                                                        <label class="form-control-label"><b>Company Logo *</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="la la-photo"></i>
                                                            </span>
                                                            <input type="file" class="form-control" value="<?= $cmpinfo[0]['company_logo']; ?>" name='company_logo'>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <div class="col-xl-6 mb-3">
                                                        <label class="form-control-label"><b>Company Name</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="la la-bank"></i>
                                                            </span>
                                                            <input type="text" class="form-control" value="<?= $cmpinfo[0]['company_name']; ?>" name='company_name' placeholder="Enter Company Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <label class="form-control-label"><b>Company Email</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="la la-envelope"></i>
                                                            </span>
                                                            <input type="email" class="form-control" value="<?= $cmpinfo[0]['email']; ?>" name='company_email' placeholder="Enter Company Email">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <div class="col-xl-6 mb-3">
                                                        <label class="form-control-label"><b>Phone No.</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="la la-phone   "></i>
                                                            </span>
                                                            <input type="text" class="form-control" value="<?= $cmpinfo[0]['phone_no']; ?>" name='phone_no' placeholder="Phone Number">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <label class="form-control-label"><b>Website</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="la la-link"></i>
                                                            </span>
                                                            <input type="text" class="form-control" value="<?= $cmpinfo[0]['website']; ?>" name='website' placeholder="Website">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <div class="col-xl-6 mb-3">
                                                        <label class="form-control-label"><b>Category</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="la la-server"></i>
                                                            </span>
                                                            <select class="form-control select" name="category">
                                                                <option value="">Select Category</option>
                                                                <?php foreach ($categories as $category) : ?>
                                                                    <?php if ($cmpinfo[0]['category'] == $category['id']) : ?>
                                                                        <option value="<?= $category['id']; ?>" selected> <?= $category['name']; ?> </option>
                                                                    <?php else : ?>
                                                                        <option value="<?= $category['id']; ?>"> <?= $category['name']; ?> </option>
                                                                <?php endif;
                                                                endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <label class="form-control-label"><b>Founded Date</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="la la-calendar-o"></i>
                                                            </span>
                                                            <input type="date" class="form-control" value="<?= $cmpinfo[0]['founded_date']; ?>" name='founded_date'>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <div class="col-xl-6 mb-3">
                                                        <label class="form-control-label"><b>Organization Type</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="la la-server"></i>
                                                            </span>
                                                            <select name="org_type" class="form-control select">
                                                                <option value="Public" <?php if ($cmpinfo[0]['org_type'] == 'Public') {
                                                                                            echo "selected";
                                                                                        } ?>>public</option>
                                                                <option value="Private" <?php if ($cmpinfo[0]['org_type'] == 'Private') {
                                                                                            echo "selected";
                                                                                        } ?>>private</option>
                                                                <option value="Government" <?php if ($cmpinfo[0]['org_type'] == 'Government') {
                                                                                                echo "selected";
                                                                                            } ?>>government</option>
                                                                <option value="NGO" <?php if ($cmpinfo[0]['org_type'] == 'NGO') {
                                                                                        echo "selected";
                                                                                    } ?>>ngo</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <label class="form-control-label"><b>No. of Employers</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="la la-users"></i>
                                                            </span>
                                                            <select name="no_of_employers" class="form-control select">
                                                                <option value="1-10" <?php if ($cmpinfo[0]['no_of_employers'] == '1-10') {
                                                                                            echo "selected";
                                                                                        } ?>>1-10</option>
                                                                <option value="10-20" <?php if ($cmpinfo[0]['no_of_employers'] == '10-20') {
                                                                                            echo "selected";
                                                                                        } ?>>10-20</option>
                                                                <option value="20-30" <?php if ($cmpinfo[0]['no_of_employers'] == '20-30') {
                                                                                            echo "selected";
                                                                                        } ?>>20-30</option>
                                                                <option value="30-50" <?php if ($cmpinfo[0]['no_of_employers'] == '30-50') {
                                                                                            echo "selected";
                                                                                        } ?>>30-50</option>
                                                                <option value="50-100" <?php if ($cmpinfo[0]['no_of_employers'] == '50-100') {
                                                                                            echo "selected";
                                                                                        } ?>>50-100</option>
                                                                <option value="100+" <?php if ($cmpinfo[0]['no_of_employers'] == '100+') {
                                                                                            echo "selected";
                                                                                        } ?>>100+</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <div class="col-xl-6 mb-3">
                                                        <label class="form-control-label"><b>Company Description</b></label>
                                                        <textarea class="form-control select" name='description'><?= $cmpinfo[0]['description']; ?></textarea>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <label class="form-control-label"><b>Country</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="ti-location-pin"></i>
                                                            </span>
                                                            <select name="country" id="ccountry" name="country" class="country form-control select">
                                                                <option>Select Country</option>
                                                                <?php foreach ($countries as $country) : ?>
                                                                    <?php if ($cmpinfo[0]['country'] == $country['id']) : ?>
                                                                        <option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
                                                                    <?php else : ?>
                                                                        <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
                                                                <?php endif;
                                                                endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <div class="col-xl-6 mb-3">
                                                        <label class="form-control-label"><b>State</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="ti-location-pin"></i>
                                                            </span>
                                                            <?php
                                                            $states = get_country_states($cmpinfo[0]['country']);
                                                            $options = array('' => 'Select State') + array_column($states, 'name', 'id');
                                                            echo form_dropdown('state', $options, $cmpinfo[0]['state'], 'class="form-control state select" required');
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <label class="form-control-label"><b>City</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="ti-location-pin"></i>
                                                            </span>
                                                            <?php
                                                            $cities = get_state_cities($cmpinfo[0]['state']);
                                                            $options = array('' => 'Select City') + array_column($cities, 'name', 'id');
                                                            echo form_dropdown('city', $options, $cmpinfo[0]['city'], 'class="form-control city select" required');
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <div class="col-xl-6 mb-3">
                                                        <label class="form-control-label"><b>Pin Code</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="ti-location-pin"></i>
                                                            </span>
                                                            <input type="text" class="form-control" value="<?= $cmpinfo[0]['postcode']; ?>" name='postcode' placeholder="Pin Code">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <label class="form-control-label"><b>Full Address</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="ti-location-pin"></i>
                                                            </span>
                                                            <input type="text" class="form-control" value="<?= $cmpinfo[0]['address']; ?>" name='full_address' placeholder="Full Address">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <div class="col-xl-6 mb-3">
                                                        <label class="form-control-label"><b>Facebook</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="la la-facebook"></i>
                                                            </span>
                                                            <input type="text" class="form-control" value="<?= $cmpinfo[0]['facebook_link']; ?>" name='facebook_link' placeholder="Facebook Link">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <label class="form-control-label"><b>Twitter</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="la la-twitter"></i>
                                                            </span>
                                                            <input type="text" class="form-control" value="<?= $cmpinfo[0]['twitter_link']; ?>" name='twitter_link' placeholder="Twitter Link">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <div class="col-xl-6 mb-3">
                                                        <label class="form-control-label"><b>Youtube</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="la la-youtube"></i>
                                                            </span>
                                                            <input type="text" class="form-control" value="<?= $cmpinfo[0]['youtube_link']; ?>" name='youtube_link' placeholder="Youtube Link">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <label class="form-control-label"><b>LinkedIn</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="la la-linkedin"></i>
                                                            </span>
                                                            <input type="text" class="form-control" value="<?= $cmpinfo[0]['linkedin_link']; ?>" name='linkedin_link' placeholder="LinkedIn Link">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="text-left">
                                                <button class="btn btn-gradient-01" type="submit">Update</button>
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
                                                <h4>Change Password</h4>
                                            </div>
                                            <form action="<?= base_url('employer/changepassword') ?>" method="post" class="form-horizontal">
                                                <div class="form-group row mb-3">
                                                    <div class="col-xl-6 mb-3">
                                                        <label class="form-control-label"><b>Password</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="la la-lock"></i>
                                                            </span>
                                                            <input type="password" name="password" class="form-control" placeholder="Enter Password">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <label class="form-control-label"><b>Confirm Password</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon addon-primary">
                                                                <i class="la la-lock"></i>
                                                            </span>
                                                            <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="text-left">
                                                    <button class="btn btn-gradient-01" type="submit">Update</button>
                                                </div>
                                            </form>

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
                        </div>
                    </div>
                </div>
            </div><!-- End col-xl-9 -->
        </div> <!-- End Row -->

    </div>
    <!-- End Container -->

    <script>
        $(document).ready(function() {
            $('#country').on('change', function() {
                var country_id = this.value;
                $.ajax({
                    url: '<?= base_url('employer/profile'); ?>',
                    type: 'POST',
                    data: {
                        country_id: country_id
                    },
                    cached: false,
                    success: function(result) {
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

            $('#state').on('change', function() {
                var state_id = this.value;
                $.ajax({
                    url: '<?= base_url('employer/getcities'); ?>',
                    type: 'POST',
                    data: {
                        state_id: state_id
                    },
                    cached: false,
                    success: function(result) {
                        var json = JSON.parse(result);
                        var $cities = $('#city');
                        for (var i = 0; i < json.length; i++) {
                            $cities.append('<option value=' + json[i].id + '>' + json[i].name + '</option>');
                        }
                    }
                });
            });

            $('#ccountry').on('change', function() {
                var country_id = this.value;
                $.ajax({
                    url: '<?= base_url('employer/profile'); ?>',
                    type: 'POST',
                    data: {
                        country_id: country_id
                    },
                    cached: false,
                    success: function(result) {
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
            $('#cstate').on('change', function() {
                var state_id = this.value;
                $.ajax({
                    url: '<?= base_url('employer/getcities'); ?>',
                    type: 'POST',
                    data: {
                        state_id: state_id
                    },
                    cached: false,
                    success: function(result) {
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


    <?php include(VIEWPATH . 'employer/include/footer.php'); ?>