<!doctype html>
<html lang="en">
<head>

<!-- Basic Page Needs
================================================== -->
<title>JoDice</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="icon" href="<?= base_url(); ?>/public/images/fav.png" type="image/gif" sizes="64x64">

<!-- CSS
================================================== -->
<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700&display=swap&subset=latin-ext" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url(); ?>/public/users/css/all.min.css">
<link href="<?= base_url(); ?>/public/users/css/aos.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url(); ?>/public/users/css/bootstrap.min.css">
<link href="<?= base_url(); ?>/public/users/css/select2.min.css" rel="stylesheet" />
<link href="<?= base_url(); ?>/public/users/css/owl.carousel.min.css" rel="stylesheet" />
<link rel="stylesheet" href="<?= base_url(); ?>/public/users/css/style.css">
<link rel="stylesheet" href="<?= base_url(); ?>/public/users/css/color-1.css">
<script src="<?= base_url(); ?>/public/users/js/jquery-3.4.1.min.js"></script>
</head>
<body>

<!-- Header 01
================================================== -->
<header class="header_01">
	<div class="header_main">
		<div class="header_menu fixed-top">
			<div class="container">
				<div class="header_top">
					<div class="logo">
						<a href="index.html">
							<img  alt="JoDice" class="img-fluid" src="<?= base_url(); ?>/public/users/images/dice-logo.png">
						</a>
					</div>
					<div class="navigation">
						<nav>
							<div class="hamburger hamburger--spring js-hamburger ">
						        <div class="hamburger-box">
						          <div class="hamburger-inner"></div>
						        </div>
						      </div>
							<ul>
								<li class="has-sub-menu current_page">
									<a href="index.html" >Home</a>
									<ul class="sub-menu">
										<li class="current_page">
											<a href="index.html">Homepage 1</a>
										</li>
										<li>
											<a href="home-page-2.html">Homepage 2</a>
										</li>
										<li>
											<a href="home-page-3.html">Homepage 3</a>
										</li>
										<li>
											<a href="home-page-4.html">Homepage 4</a>
										</li>
									</ul>
								</li>
								<li class="has-sub-menu">
									<a href="index.html">Job Seekers</a>
									<ul class="sub-menu">
										<li>
											<a href="job-seeker-dashboard.html">Job dashboard</a>
										</li>
										<li>
											<a href="browse-jobs.html">Browse jobs</a>
										</li>
										
										<li>
											<a href="job-single.html">Job single</a>
										</li>
										
										<li>
											<a href="my-stared-jobs.html">My stared jobs</a>
										</li>
										<li>
											<a href="staff-profile-single.html">Job seeker profile</a>
										</li>
										<li>
											<a href="edit-profile.html">Update my profile</a>
										</li>
										
										<li>
											<a href="<?= base_url('home/changepassword'); ?>">Change password</a>
										</li>
										<li>
											<a href="registration.html">Registration</a>
										</li>
										<li>
											<a href="browse-companies.html">Browse companies</a>
										</li>
									</ul>
								</li>


								<li class="has-sub-menu">
									<a href="#">For employers</a>
									<ul class="sub-menu">
										<li>
											<a href="job-dashboard.html">Job dashboard</a>
										</li>
										<li>
											<a href="post-a-job.html">Post a job</a>
										</li>
										<li>
											<a href="my-job-listing.html">My Jobs listing</a>
										</li>
										<li>
											<a href="find-staff.html">Find staff</a>
										</li>
										<li>
											<a href="compnay-profile-single.html">Company profile</a>
										</li>
										
										<li>
											<a href="emp-edit-profile.html">Update profile</a>
										</li>
										<li>
											<a href="emp-edit-password.html">Change password</a>
										</li>
										<li>
											<a href="emp-registration.html">Employer registration</a>
										</li>
									</ul>
								</li>

								<li class="has-sub-menu">
									<a href="#">Pages</a>
									<ul class="sub-menu">

										<li>
											<a href="blog.html">blog</a>
										</li>
										<li>
											<a href="blog-single.html">Blog single</a>
										</li>
										<li>
											<a href="contact-us.html">Contact us</a>
										</li>
										<li>
											<a href="plan-page.html">Membership Plans</a>
										</li>
										<li>
											<a href="login.html">Login</a>
										</li>
										<li>
											<a href="lost-password.html">Lost password</a>
										</li>
										<li>
											<a href="user-interface-elements.html">User interface elements</a>
										</li>
										<li>
											<a href="404.html">404</a>
										</li>	
									</ul>
								</li>
							</ul>
						</nav>
						<div class="ac_nav">
							<!--Not logedin-->
								<div class="login_pop">
									<button class="btn btn-primary">Login / Sign up <i class="fas fa-caret-down"></i></button>
									<div class="login_pop_box">
										<span class="twobtn_cont">
											<a class=" signjs_btn" href="registration.html">				 
											<span>Job seekers</span> Sign up
											<i class="far fa-user"></i>
											</a>
										<a class=" signrs_btn" href="emp-registration.html">	<span>EMPLOYERS</span> Sign up
											<i class="fas fa-landmark"></i>
										</a>
										</span>
										<div>
											<span class="member_btn">Already a member?</span>
											<a class="lgin_btn btn btn-primary" href="login.html"> 
											   	Login
											</a>
										</div>
									</div>
								</div>
							<!--end logedin-->
						</div>
					</div>
				</div>
			</div>
		</div>