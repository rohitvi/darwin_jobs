<!doctype html>
<html lang="en">

<head>

    <!-- Basic Page Needs
================================================== -->
    <title><?= $title ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="icon" href="<?= get_g_setting_val('favicon'); ?>" type="image/gif" sizes="64x64">

    <!-- CSS================================================== -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700&display=swap&subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/users/css/all.min.css">
    <link href="<?= base_url(); ?>/public/users/css/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/users/css/bootstrap.min.css">
    <link href="<?= base_url(); ?>/public/users/css/select2.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>/public/users/css/owl.carousel.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url(); ?>/public/users/css/style.css">
     <link rel="stylesheet" href="<?= base_url(); ?>/public/employer/assets/css/custom.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/users/css/color-1.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/users/css/datatables/datatables.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/users/toastr/toastr.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/users/css/tagin.min.css">
    <script src="<?= base_url(); ?>/public/users/js/ckeditor.js"></script>
</head>
<div id="loader-wrapper">
			<div id="loader"></div>

			<div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>

		</div>
<body style="overflow-x:hidden;">

    <!-- Header 01
================================================== -->
    <header class="header_01">
        <div class="header_main">
            <div class="header_menu fixed-top">
                <div class="container">
                    <div class="header_top">
                        <div class="logo">
                            <a href="<?= base_url('employer/dashboard') ?>">
                                <img alt="JoDice" class="img-fluid" src="<?= get_g_setting_val('logo'); ?>">
                            </a>
                        </div>
                        <div class="navigation">
                            <nav>
                                <div class="hamburger hamburger--spring js-hamburger">
                                    <div class="hamburger-box">
                                        <div class="hamburger-inner"></div>
                                    </div>
                                </div>
                                <ul>
                                    <?php if (!session('employer_logged_in')) : ?>
                                    <li class="<?= (uri_string(true) == "employer/dashboard") ? "current_page" : '' ?>"><a href="<?= base_url('employer') ?>"> HOME </a></li>
									<li class="<?= (uri_string(true) == "employer/aboutus") ? "current_page" : '' ?>"><a href="<?= base_url('employer/aboutus') ?>">ABOUT US</a> </li>
                                    <li class="<?= (uri_string(true) == "employer/post") ? "current_page" : '' ?>"><a href="<?= base_url('employer/post') ?>">POST A JOBS</a></li>
                                    <?php endif; ?>
                                    <?php if (session('employer_logged_in')) : ?>
                                    <li class="<?= (uri_string(true) == "employer/dashboard") ? "current_page" : '' ?>"><a href="<?= base_url('employer/dashboard') ?>"> Dashboard </a></li>
                                    <li class="<?= (uri_string(true) == "employer/list_jobs") ? "current_page" : '' ?>"><a href="<?= base_url('employer/list_jobs') ?>"> Manage Jobs</a></li>
                                    <li class="<?= (uri_string(true) == "employer/search") ? "current_page" : '' ?>"><a href="<?= base_url('employer/search') ?>"> Find Candidate</a></li>
									
                                    <li class="has-sub-menu login_pop after_login">
                                        <button class="btn btn-primary withdp"><a style="color:#fff;" href="#"><img class="" src="<?= get_employer_profile(session('employer_id')) != '' ? get_employer_profile(session('employer_id')) : base_url('public/users/images/user.png') ?>"><?= session('employer_username'); ?>&nbsp;<i class="fas fa-caret-down"></i></a></button>
                                        <ul class="sub-menu">
                                            <li class="<?= (uri_string(true) == "employer/profile") ? "current_page" : '' ?>"><a href="<?= base_url('employer/profile'); ?>">My Profile</a></li>
                                            <li class="<?= (uri_string(true) == "employer/logout") ? "current_page" : '' ?>"><a href="<?= base_url('employer/logout') ?>">Logout</a></li>
                                        </ul>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
							 <!--<div class="ac_nav">
                
                <?php if (session('user_logged_in')) : ?>
                <?php else : ?>
                  <div class="dropdown login_pop">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login</button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="<?= base_url('login'); ?>">Job Seeker Login</a>
                      <a class="dropdown-item" href="<?= base_url('employer/login'); ?>">Employer Login</a>
                    </div>
                  </div>
                <?php endif; ?>
              </div>-->
                            <div class="ac_nav">
							<!--Not logedin-->
							<?php if (session('user_logged_in')) : ?>
							  <?php elseif (session('employer_logged_in')) : ?>
							<?php else : ?>
								<div class="login_pop">
									<button class="btn btn-primary">Login<i class="fas fa-caret-down ml_5"></i></button>
									<div class="login_pop_box">
										<span class="twobtn_cont">
											<a class=" signjs_btn" href="<?= base_url('login'); ?>">				 
											<span>Job seekers</span> Sign in
											<i class="far fa-user"></i>
											</a>
										<a class=" signrs_btn" href="<?= base_url('employer/login'); ?>">	<span>EMPLOYERS</span> Sign in
											<i class="fas fa-landmark"></i>
										</a>
										</span>

									</div>
								</div>
								<?php endif; ?>
							<!--end logedin-->
						</div>
							
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Header 02
================================================== -->