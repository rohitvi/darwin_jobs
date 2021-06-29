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
                        <a href="<?= base_url('home') ?>">
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
                                            <a href="<?= base_url('employer') ?>">Job dashboard</a>
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
                                            <a href="edit-password.html">Change password</a>
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
                                            <a href="<?= base_url('employer') ?>">Job dashboard</a>
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
                            <?php if (session('employer_logged_in')) : ?>
                                <div class="login_pop">
                                    <div class="dropdown">
                                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Welcome <?= session('employer_username') ?></button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="<?= base_url('employer/profile'); ?>"><i class="fas fa-user" aria-hidden="true"></i> &nbsp;&nbsp;My Profile</a>
                                        <a class="dropdown-item" href="<?= base_url('employer/logout'); ?>"><i class="fas fa-power-off"></i> &nbsp;&nbsp;Logout</a>
                                      </div>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="login_pop">
                                    <button class="btn btn-primary">Login / Sign up <i class="fas fa-caret-down"></i></button>
                                    <div class="login_pop_box">
                                        <span class="twobtn_cont">
                                            <a class=" signjs_btn" href="<?= base_url('home/register') ?>">
                                            <span>Job seekers</span> Sign up
                                                <i class="far fa-user"></i>
                                            </a>
                                            <a class=" signrs_btn" href="<?= base_url('employer/register') ?>">
                                            <span>EMPLOYERS</span> Sign up
                                                <i class="fas fa-landmark"></i>
                                            </a>
                                        </span>
                                        <div>
                                            <span class="member_btn">Already a member?</span>
                                            <span class="twobtn_cont">
                                            <a class=" signjs_btn" href="<?= base_url('login') ?>">
                                            <span>Job seekers</span> Login In
                                                <i class="far fa-user"></i>
                                            </a>
                                            <a class=" signrs_btn" href="<?= base_url('employer/login') ?>">
                                            <span>EMPLOYERS</span> Login In
                                                <i class="fas fa-landmark"></i>
                                            </a>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ; ?>
                            <!--end logedin-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_btm">
      <h2>Update My Profile</h2>
    </div>
  </div> 
</header>


<!-- End Header 02
================================================== -->



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
              <a href="<?= base_url('employer') ?>">
                <i class="fas fa-border-all"></i> Job Dashboard </a>
              </li>
          </ul>
          <h5>Packages</h5>
          <ul class="user_navigation">
              <li >
              <a href="<?= base_url('employer/packages') ?>"><i class="fas fa-money-bill"></i>Buy Packages</a>
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
                <a href="<?= base_url('employer/profile') ?>"><i class="fas fa-user"></i> Update My Profile</a>
            </li>
            <li>
                <a href="#"><i class="fas fa-list"></i> My packages</a>
            </li>
            <li >
                <a href="emp-edit-password.html"><i class="fas fa-key"></i>Change Password</a>
            </li>
            <li>
                <a href="#"><i class="fas fa-power-off"></i> Logout</a>
            </li>
          </ul>
        </div>