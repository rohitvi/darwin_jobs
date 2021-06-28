<!doctype html>
<html lang="en">
<head>

<!-- Basic Page Needs
================================================== -->
<title>JoDice</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="icon" href="assets/images/fav.png" type="image/gif" sizes="64x64">

<!-- CSS
================================================== -->
<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700&display=swap&subset=latin-ext" rel="stylesheet">
<link rel="stylesheet" href="assets/css/all.min.css">
<link href="assets/css/aos.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link href="assets/css/select2.min.css" rel="stylesheet" />
<link href="assets/css/owl.carousel.min.css" rel="stylesheet" />
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/color-2.css">
</head>
<body>

<!-- Header 03
================================================== -->
<header class="header_03">
	<div class="header_main">
		<div class="header_menu fixed-top">
			<div class="container">
				<div class="header_top">
					<div class="logo">
						<a href="index.html">
							<img alt="JoDice" class="img-fluid" src="assets/images/logo-2.png">
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
										<li >
											<a href="index.html">Homepage 1</a>
										</li>
										<li>
											<a href="home-page-2.html">Homepage 2</a>
										</li>
										<li class="current_page">
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
											<a href="edit-profile.html">Update my profile</a>
										</li>
										<li>
											<a href="edit-password.html">Change password</a>
										</li>
										<li>
											<a href="registration.html">Registration</a>
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
		<div class="header_btm">
			<div>
				<h2>Find resorts jobs with simplicity &amp; ease</h2>
				<p>Most complete 2020 template for Job board sites.</p>
				<form action="browse-jobs.html">
					<div class="banerSearch">
						<div class="fild-wrap fw-job-title">
							<i class="fas fa-briefcase"></i>
							<select class="js-example-basic-multiple" name="state">
							  <option value="AL"> JOB TITLE, SKILL, INDUSTRY</option>
							  <option value="1">Concierge</option>
							  <option value="2">Event Planner</option>
							  <option value="3">Executive Chef</option>
							   <option value="4">General Manager</option>

							</select>
						</div>
						<div class="fild-wrap fw-job-location">
							<i class="fas fa-map-marker-alt"></i>
							<select class="js-example-basic-single" name="state">
							  <option value="AL">ALABAMA</option>
							  <option value="WY">WYOMING</option>
							</select>
						</div>
						<div class="fild-wrap fw-submit">
							<input type="submit" class="btn btn-primary" value="SEARCH JOBS">
						</div>
					</div>
				</form>
			</div>	
		</div>
	</div> 
</header>


<!-- End Header 02
================================================== -->



<!-- Main 
================================================== -->
<main>
	<div class="section user_type-2 ">
		<div class="container">
			<h2 class="section_h">We are Popular Everywhere</h2>
			<div class="user_type">
						<div class="row">
							<div class="col-md-6">
								<div class="user_type_inner  user_type_seeker">
									<a href="browse-jobs.html">
										<div class="usertype_img">
											<i class="far fa-user"></i>
										</div>
										<div>
											<h3>I'm looking for a job</h3>
											<p>Post CV and apply job you love</p>
											<span class="btn btn-rounded btn-primary">Register As Candidate</span>
										</div>
									</a>
								</div>
							</div>
							<h3 class="ut_or">Or</h3>
							<div class="col-md-6">
								<div class="user_type_inner user_type_post">
									<a href="post-a-job.html">
										<div class="usertype_img">
											<i class="fas fa-laptop"></i>
										</div>
										<div>
											<h3>I want to post job</h3>
											<p>Post jobs &amp; hire porfessionls</p>
											<span class="btn btn-rounded btn-primary">Register As Company</span>
										</div>
									</a>
								</div>
							</div>
						</div>
					</div>
		</div>
	</div>
	<div class="section category-section-2 gray">
		<div class="container">
			<h2 class="section_h">Popular Job Categories</h2>
			<div class="row">
				<div class="col-md-6">
					<div class="category-how-work-sec">
						<h4>How it works?</h4>
						<p>We have easy 3 step process for applying application</p>
						<ul class="how-work-box">
							<li>
								<div class="hwb-icon"> 
									<i class="fas fa-search"></i>
								</div>
								<div class="hwb-cont">
									<h5>Search jobs</h5>
									<p>Search available jobs by category, location and more </p>
								</div>
							</li>
							<li>
								<div class="hwb-icon"> 
									<i class="far fa-file-word"></i>
								</div>
								<div class="hwb-cont">
									<h5>Apply</h5>
									<p>Notify employers of your interest with one click!</p>
								</div>
							</li>
							<li>
								<div class="hwb-icon"> 
									<i class="far fa-thumbs-up"></i>
								</div>
								<div class="hwb-cont">
									<h5>Let Employers Find You</h5>
									<p>Employers can find you based on your experience and credentials.</p>
								</div>
							</li>
							
							
						</ul>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-12">
							<div class="category_box">
								<div class="cb_header">
									<i class="far fa-file-code"></i>
									<span class="job_count">363</span>
								</div>
								<div class="cb_bottom">
									<h3>Web & Software Dev</h3>
									<p>Software Engineer, Web / Mobile Developer &amp; More</p>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="category_box">
								<div class="cb_header">
									<i class="fas fa-cloud-upload-alt"></i>
									<span class="job_count">572</span>
								</div>
								<div class="cb_bottom">
									<h3>Data Science & Analitycs</h3>
									<p>Data Specialist / Scientist, Data Analyst & More</p>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="category_box">
								<div class="cb_header">
									<i class="fas fa-calculator"></i>
									<span class="job_count">252</span>
								</div>
								<div class="cb_bottom">
									<h3>Accounting & Consulting</h3>
									<p>Auditor, Accountant, Fnancial Analyst & More</p>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="category_box">
								<div class="cb_header">
									<i class="fas fa-pen-fancy"></i>
									<span class="job_count">523</span>
								</div>
								<div class="cb_bottom">
									<h3>Writing & Translations</h3>
									<p>Copywriter, Creative Writer, Translator & More</p>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="category_box">
								<div class="cb_header">
									<i class="fas fa-chart-pie"></i>
									<span class="job_count">98</span>
								</div>
								<div class="cb_bottom">
									<h3>Sales & Marketing</h3>
									<p>Brand Manager, Marketing Coordinator & More</p>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="category_box">
								<div class="cb_header">
									<i class="fas fa-camera-retro"></i>
									<span class="job_count">53</span>
								</div>
								<div class="cb_bottom">
									<h3>Graphics & Design</h3>
									<p>Creative Director, Web Designer & More</p>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="category_box">
								<div class="cb_header">
									<i class="fas fa-bullhorn"></i>
									<span class="job_count">75</span>
								</div>
								<div class="cb_bottom">
									<h3>Digital Marketing</h3>
									<p>Darketing Analyst, Social Profile Admin & More</p>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="category_box">
								<div class="cb_header">
									<i class="fas fa-graduation-cap"></i>
									<span class="job_count">366</span>
								</div>
								<div class="cb_bottom">
									<h3>Education & Training</h3>
									<p>Advisor, Coach, Education Coordinator & More</p>
								</div>
							</div>
						</div>
						<div class="col-md-12 text-right">
							<a class="btn btn-primary" href="#">Browse All Jobs <i class="fas fa-long-arrow-alt-right"></i></a>
						</div>
					</div>
				</div>
				
			</div>   
		</div>
		<div class="category-section-stickyBg"></div>
	</div>
	<div class="section featured_section">
		<div class="container">
			<h2 class="section_h">Featured Jobs</h2>
			<div class="row full_width featured_box_outer">
				<div class="col-sm-12">
					<div class="featured_box ">
						<div class="fb_image">
							<img alt="brand logo" src="assets/images/c-logo-01.webp">
						</div>
						<div class='fb_content'>
							<h4>Restaurant General Manager</h4>
							<ul>
								<li>
									<a href="#">
										<i class="fas fa-landmark"></i>
										Magna Aliqua
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-map-marker-alt"></i>
										New York
									</a>
								</li>
								<li>
									<a href="#">
										<i class="far fa-clock"></i>
										2 days ago
									</a>
								</li>
							</ul>
						</div>
						<ul class="tags">
							<li>copywriting</li>
							<li>translating</li>
							<li>editing</li>
						</ul>
						<div class="fb_action">
							<a title="add to favourite" href="#"><i class="far fa-heart"></i></a>
							<a class="btn btn-primary" href="job-single.html">Apply Now</a>
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="featured_box ">
						<div class="fb_image">
							<img alt="brand logo" src="assets/images/c-logo-02.webp">
						</div>
						<div class='fb_content'>
							<h4>Fix Python Selenium Code</h4>
							<ul>
								<li>
									<a href="#">
										<i class="fas fa-landmark"></i>
										Magna Aliqua
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-map-marker-alt"></i>
										New York
									</a>
								</li>
								<li>
									<a href="#">
										<i class="far fa-clock"></i>
										3 days ago
									</a>
								</li>
							</ul>
						</div>
						<ul class="tags">
							<li>Python</li>
							<li>Flask</li>
							<li>API Development</li>
						</ul>
						<div class="fb_action">
							<a title="add to favourite" href="#"><i class="fas fa-heart"></i></a>
							<a class="btn btn-primary" href="job-single.html">Apply Now</a>
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="featured_box ">
						<div class="fb_image">
							<img alt="brand logo" src="assets/images/c-logo-03.webp">
						</div>
						<div class='fb_content'>
							<h4>Fix Python Selenium Code</h4>
							<ul>
								<li>
									<a href="#">
										<i class="fas fa-landmark"></i>
										Magna Aliqua
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-map-marker-alt"></i>
										New York
									</a>
								</li>	
								<li>
									<a href="#">
										<i class="far fa-clock"></i>
										5 days ago
									</a>
								</li>
							</ul>
						</div>
						<ul class="tags">
							<li>Python</li>
							<li>Flask</li>
							<li>API Development</li>
						</ul>
						<div class="fb_action">
							<a title="add to favourite" href="#"><i class="far fa-heart"></i></a>
							<a class="btn btn-primary disabled" href="#">Applied</a>
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="featured_box ">
						<div class="fb_image">
							<img alt="brand logo" src="assets/images/c-logo-05.webp">
						</div>
						<div class='fb_content'>
							<h4>PHP Core Website Fixes</h4>
							<ul>
								<li>
									<a href="#">
										<i class="fas fa-landmark"></i>
										Magna Aliqua
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-map-marker-alt"></i>
										New York
									</a>
								</li>
								<li>
									<a href="#">
										<i class="far fa-clock"></i>
										5 days ago
									</a>
								</li>
							</ul>
						</div>
						<ul class="tags">
							<li>PHP</li>
							<li>MySQL Administration</li>
							<li>API Development</li>
						</ul>
						<div class="fb_action">
							<a title="add to favourite" href="#"><i class="far fa-heart"></i></a>
							<a class="btn btn-primary" href="job-single.html">Apply Now</a>
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="featured_box ">
						<div class="fb_image">
							<img alt="brand logo" src="assets/images/c-logo-05.webp">
						</div>
						<div class='fb_content'>
							<h4>Restaurant General Manager</h4>
							<ul>
								<li>
									<a href="#">
										<i class="fas fa-landmark"></i>
										Magna Aliqua
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-map-marker-alt"></i>
										New York
									</a>
								</li>
								<li>
									<a href="#">
										<i class="far fa-clock"></i>
										7 days ago
									</a>
								</li>
							</ul>
						</div>
						<ul class="tags">
							<li>PHP</li>
							<li>MySQL Administration</li>
							<li>API Development</li>
						</ul>
						<div class="fb_action">
							<a title="add to favourite" href="#"><i class="far fa-heart"></i></a>
							<a class="btn btn-primary" href="job-single.html">Apply Now</a>

						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="featured_box ">
						<div class="fb_image">
							<img alt="brand logo" src="assets/images/c-logo-05.webp">
						</div>
						<div class='fb_content'>
							<h4>Food Delviery Mobile App</h4>
							<ul>
								<li>
									<a href="#">
										<i class="fas fa-landmark"></i>
										Magna Aliqua
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-map-marker-alt"></i>
										New York
									</a>
								</li>
								<li>
									<a href="#">
										<i class="far fa-clock"></i>
										9 days ago
									</a>
								</li>
							</ul>
						</div>
						<ul class="tags">
							<li>IOS</li>
							<li>Android</li>
							<li>mobile apps</li>
							<li>design</li>
						</ul>
						<div class="fb_action">
							<a title="add to favourite" href="#"><i class="far fa-heart"></i></a>
							<a class="btn btn-primary" href="job-single.html">Apply Now</a>
						</div>
					</div>
				</div>
				<div class="col-md-12 text-center mt-4">
					<a class="btn btn-primary" href="#">Browse All Jobs <i class="fas fa-long-arrow-alt-right"></i></a>
				</div>
			</div>
		</div>
	</div>
	<div class="section gray paln_section">
		<div class="container">
			<h2 class="section_h">Membership Plans</h2>
			<div class="planduration">
				<div class="custom-control custom-switch text-center">
				  <label class="before-custom-control-label" for="customSwitch1"> <span>Billed Monthly</span></label>
				  <input type="checkbox" class="custom-control-input" id="customSwitch1">
				  <label class="custom-control-label" for="customSwitch1"> <span>Billed Yearly</span> </label>
				  <div class="small-alert alert-success"> Save 21%  </div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="plan_box">
						<h3>Basic Plan</h3>
						<p>One time fee for one listing or task highlighted in search results.</p>
						<div class="plan_price pl-monthly">
							<h4><strong>$19</strong>/ monthly</h4>
						</div>
						<div class="plan_price pl-yearly hide">
							<h4><strong>$200</strong>/ yearly</h4>
						</div>
						<h5>Features of Basic Plan</h5>
						<ul>
							<li><i class="fas fa-check"></i> 1 Listing</li>
							<li><i class="fas fa-check"></i> 30 Days Visibility</li>
							<li><i class="fas fa-check"></i> Highlighted in Search Results</li>

						</ul>
						<a class="btn btn-primary" href="#">Buy Now</a>
					</div>
				</div>
				<div class="col-md-4">
					<div class="plan_box plan_box_hoverd">
						<div class="populer_plan">
							Most Populer
						</div>
						<h3>Standard Plan</h3>
						<p>One time fee for one listing or task highlighted in search results.</p>
						<div class="plan_price">
							<h4><strong>$36</strong>/ monthly</h4>
						</div>
						<div class="plan_price pl-yearly hide">
							<h4><strong>$396</strong>/ yearly</h4>
						</div>
						<h5>Features of Standard Plan</h5>
						<ul>
							<li><i class="fas fa-check"></i> 6 Listing</li>
							<li><i class="fas fa-check"></i> 65 Days Visibility</li>
							<li><i class="fas fa-check"></i> Highlighted in Search Results</li>
						</ul>
						<a class="btn btn-primary" href="#">Buy Now</a>
					</div>
				</div>
				<div class="col-md-4">
					<div class="plan_box">

						<h3>Extended Plan</h3>
						<p>One time fee for one listing or task highlighted in search results.</p>
						<div class="plan_price">
							<h4><strong>$79</strong>/ monthly</h4>
						</div>
						<div class="plan_price pl-yearly hide">
							<h4><strong>$850</strong>/ yearly</h4>
						</div>
						<h5>Features of Extended Plan</h5>
						<ul>
							<li><i class="fas fa-check"></i> Unlimited Listings Listing</li>
							<li><i class="fas fa-check"></i> 100 Days Visibility</li>
							<li><i class="fas fa-check"></i> Highlighted in Search Results</li>
						</ul>
						<a class="btn btn-primary" href="#">Buy Now</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section status_section ">
		
		<div class="container">
			<h2 class="section_h">JoDice Status</h2>
			
			<div class="row justify-content-between">
				<div class="col-auto">
					<div class="status_box-2">
						<i class="fas fa-paper-plane"></i>
						<h3>83</h3>
						<p>Job Posted.</p>
					</div>
				</div>
				<div class="col-auto">
					<div class="status_box-2">
						<i class="fas fa-vote-yea"></i>						
						<h3>16</h3>
						<p>Job Filled.</p>
					</div>
				</div>
				<div class="col-auto">
					<div class="status_box-2">
						<i class="fas fa-building"></i>
						<h3>36</h3>
						<p>Companies</p>
					</div>
				</div>
				<div class="col-auto">
					<div class="status_box-2">
						<i class="fas fa-users"></i>
						<h3>175</h3>
						<p>Members</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section post_section  ">
		<div class="container">
			<h2 class="section_h">Featured Posts</h2>
			<div class="row">
				<div class="col-md-4">
					<div class="post_box">
						<img alt="" src="assets/images/blog1.jpg" class="img-responsive">
						<div class="post_content">
							<h6>
								<a href="blog-single.html">4 Secrets To Be Strategic About Your Job Search</a>
							</h6>
							<p>Queequeg removed himself to just beyond the head of the … </p>
							<a class="btn btn-secondary btn-rounded" href="blog-single.html">Continue reading</a>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="post_box">
						<img alt="" src="assets/images/blog2.jpg" class="img-responsive">
						<div class="post_content">
							<h6>
								<a href="blog-single.html">Why Long-Term Unemployment Isn’t As Bad As You Think</a>
							</h6>
							<p>Queequeg removed himself to just beyond the head of the … </p>
							<a class="btn btn-secondary btn-rounded" href="blog-single.html">Continue reading</a>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="post_box">
						<img alt="" src="assets/images/blog3.jpg" class="img-responsive">
						<div class="post_content">	
							<h6>
								<a href="blog-single.html">6 Ways Your Job is Losing You Future Earnings</a>
							</h6>
							<p>Queequeg removed himself to just beyond the head of the … </p>
							<a class="btn btn-secondary btn-rounded" href="blog-single.html">Continue reading</a>
						</div>
					</div>
				</div>
			</div>
		</div> 
	</div>
	<div class="section  partner_section gray">
		<div class="container">
			<h2 class="section_h">Our Partners</h2>
			<ul class="partner_carousel owl-carousel owl-theme">
				<li>
					<a href="#"><img alt="brand logo" src="assets/images/company-logo-1.svg"></a>
				</li>
				<li>
					<a href="#"><img alt="brand logo" src="assets/images/company-logo-2.svg"></a>
				</li>
				<li>
					<a href="#"><img alt="brand logo" src="assets/images/company-logo-3.svg"></a>
				</li>
				<li>
					<a href="#"><img alt="brand logo" src="assets/images/company-logo-4.png"></a>
				</li>
				<li>
					<a href="#"><img alt="brand logo" src="assets/images/company-logo-5.png"></a>
				</li>	
				<li>
					<a href="#"><img alt="brand logo" src="assets/images/company-logo-1.svg"></a>
				</li>
				<li>
					<a href="#"><img alt="brand logo" src="assets/images/company-logo-2.svg"></a>
				</li>
				<li>
					<a href="#"><img alt="brand logo" src="assets/images/company-logo-3.svg"></a>
				</li>
				<li>
					<a href="#"><img alt="brand logo" src="assets/images/company-logo-4.png"></a>
				</li>
				<li>
					<a href="#"><img alt="brand logo" src="assets/images/company-logo-5.png"></a>
				</li>	
			</ul>
		</div>
	</div>
</main>


<!-- Footer Container
================================================== -->
<footer id="colophon" class="site-footer custom_footer dark_footer">
	<div class="container">
		<div class="row footer_widget">
				<div class="col-md-3">
					<div class="footer_widget_box">
						<h2 >Job seekers</h2>
						<ul >
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
								<a href="edit-profile.html">Update my profile</a>
							</li>
							<li>
								<a href="edit-password.html">Change password</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer_widget_box">
						<h2 >Employers</h2>
						<ul >
							<li>
								<a href="emp-registration.html">Get a FREE Employer Account</a> 
							</li>
							<li>
								<a href="post-a-job.html">Post a job</a>
							</li>
							<li>
								<a href="find-staff.html">Find staff</a>
							</li>
							<li>
								<a href="job-dashboard.html">Job dashboard</a>
							</li>
							<li>
								<a href="emp-edit-profile.html">Update profile</a>
							</li>
							<li>
								<a href="emp-edit-password.html">Change password</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer_widget_box">
						<h2 >Community</h2>
						<ul >
							<li> <a href="contact-us.html">Help / Contact Us</a> 
				            </li>
				            <li> <a href="content-page.html">Guidelines</a> 
				            </li>
				            <li> <a href="content-page.html">Terms of Use</a> 
				            </li>
				            <li> <a href="content-page.html">Privacy &amp; Cookies </a> 
				            </li>
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer_widget_box">
						<h2 >Get In Touch</h2>
						<ul class="social_list">
							<li> <a href="#"><i class="fab fa-twitter"></i></a> 
							</li>
							<li> <a href="#"><i class="fab fa-facebook"></i></a> 
							</li>
							<li> <a href="#"><i class="fab fa-linkedin"></i></a> 
							</li>
							<li> <a href="#"><i class="fab fa-youtube"></i></a> 
							</li>
						</ul>

					</div>
					
          <div class="footer_widget_box">
						<form class="newsletter">
			                  <h2 >Newsletter</h2>
			                  <div  class="d-flex">

			                    <input class="form-control" type="email" placeholder="Enter your email ">
			                    <button class="btn btn-primary"><i class="fa fa-paper-plane"></i></button>
			                   
			                  </div>
		                   
		                </form>
		            </div> 
				</div>
				<div class="col-md-12">
					<div class="footer_widget_box"  >
						<p class="copyright-text">© Copyright 2020 by JoDice. All rights reserved.
						</p>
					</div>
				</div>
			</div>
		<!-- .site-info -->
	</div>
</footer>


<!-- End Footer Container
================================================== -->

<!-- Scripts
================================================== -->
<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/select2.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/custom.js"></script>
</body>
</html>
