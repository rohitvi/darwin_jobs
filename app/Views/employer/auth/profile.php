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
                                                <a class="nav-link" href="javascript:void(0)"><i class="la la-bell la-2x align-middle pr-2"></i>Notifications</a>
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
                                        <form class="form-horizontal">
                                            <div class="form-group row d-flex align-items-center mb-5">
                                                <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Full Name</label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" placeholder="David Green">
                                                </div>
                                            </div>
                                            <div class="form-group row d-flex align-items-center mb-5">
                                                <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Email</label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" placeholder="dgreen@mail.com">
                                                </div>
                                            </div>
                                            <div class="form-group row d-flex align-items-center mb-5">
                                                <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Phone</label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" placeholder="+00 987 654 32">
                                                </div>
                                            </div>
                                            <div class="form-group row d-flex align-items-center mb-5">
                                                <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Website</label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" placeholder="www.website.com">
                                                </div>
                                            </div>
                                        </form>
                                        <div class="em-separator separator-dashed"></div>
                                        <div class="text-right">
                                            <button class="btn btn-gradient-01" type="submit">Save Changes</button>
                                            <button class="btn btn-shadow" type="reset">Cancel</button>
                                        </div>
                                        <div class="col-10 ml-auto">
                                            <div class="section-title mt-3 mb-3">
                                                <h4>02. Address Informations</h4>
                                            </div>
                                        </div>
                                        <form class="form-horizontal">
                                            <div class="form-group row d-flex align-items-center mb-5">
                                                <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Address</label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" placeholder="123 Century Blvd">
                                                </div>
                                            </div>
                                            <div class="form-group row d-flex align-items-center mb-5">
                                                <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">City</label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" placeholder="Los Angeles">
                                                </div>
                                            </div>
                                            <div class="form-group row d-flex align-items-center mb-5">
                                                <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">State</label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" placeholder="California">
                                                </div>
                                            </div>
                                            <div class="form-group row d-flex align-items-center mb-5">
                                                <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Zip</label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" placeholder="90045">
                                                </div>
                                            </div>
                                        </form>
                                        <div class="em-separator separator-dashed"></div>
                                        <div class="text-right">
                                            <button class="btn btn-gradient-01" type="submit">Save Changes</button>
                                            <button class="btn btn-shadow" type="reset">Cancel</button>
                                        </div>
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
                    
<?php include(VIEWPATH.'employer/include/footer.php'); ?>
