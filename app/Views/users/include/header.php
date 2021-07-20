<!doctype html>
<html lang="en">

<head>

  <!-- Basic Page Needs
================================================== -->
  <title><?= $title ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="icon" href="<?= get_g_setting_val('favicon'); ?>" type="image/gif" sizes="64x64">

  <!-- CSS
================================================== -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700&display=swap&subset=latin-ext" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url(); ?>/public/users/css/all.min.css">
  <link href="<?= base_url(); ?>/public/users/css/aos.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url(); ?>/public/users/css/bootstrap.min.css">
  <link href="<?= base_url(); ?>/public/users/css/select2.min.css" rel="stylesheet" />
  <link href="<?= base_url(); ?>/public/users/css/owl.carousel.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?= base_url(); ?>/public/users/css/color-1.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/public/users/css/style.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/public/users/toastr/toastr.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/public/users/css/tagin.min.css">
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
              <a href="<?= base_url('home') ?>">
                <img alt="JoDice" class="img-fluid" src="<?= base_url(); ?>/public/users/images/dice-logo.png">
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
                  <li class="<?= (uri_string(true) == "" || uri_string(true) == "home") ? "current_page" : '' ?>">
                    <a href="<?= base_url() ?>">HOME</a>
                  </li>
                  <li class="<?= (uri_string(true) == "home/aboutus") ? "current_page" : '' ?>">
                    <a href="<?= base_url('home/aboutus') ?>">ABOUT US</a>
                  </li>
                  <li class="has-sub-menu <?= (uri_string(true) == "home/search" || uri_string(true) == "home/jobs_by_category" || uri_string(true) == "home/jobs_by_industry" || uri_string(true) == "home/jobs_by_location") ? "current_page" : '' ?>">
                    <a href="#">JOBS</a>
                    <ul class="sub-menu">
                      <li class="<?= (uri_string(true) == "home/search") ? "current_page" : '' ?>"><a href="<?= base_url('home/search') ?>">Search Job</a></li>
                      <li class="<?= (uri_string(true) == "home/jobs_by_category") ? "current_page" : '' ?>"><a href="<?= base_url('home/jobs_by_category') ?>">Job By Category</a></li>
                      <li class="<?= (uri_string(true) == "home/jobs_by_industry") ? "current_page" : '' ?>"><a href="<?= base_url('home/jobs_by_industry') ?>">Job By Industry</a></li>
                      <li class="<?= (uri_string(true) == "home/jobs_by_location") ? "current_page" : '' ?>"><a href="<?= base_url('home/jobs_by_location') ?>">Job By Location</a></li>
                      <li><a href="<?= base_url('home/search') ?>">Browse All Jobs</a></li>
                    </ul>
                  </li>
                  <li class="<?= (uri_string(true) == "home/companies") ? "current_page" : '' ?>"><a href="<?= base_url('home/companies'); ?>"><?= 'COMPANIES' ?></a></li>
                  <?php if (session('user_logged_in')) : ?>
                    <li class="has-sub-menu login_pop login_fixed after_login">
             
                      <button class="btn btn-primary resp_change withdp"><a style="color:#fff;" href="#"><img class="" src="<?= get_user_profile(session('user_id')) != '' ? get_user_profile(session('user_id')) : base_url('public/users/images/user.png')?>"><?= session('username'); ?>&nbsp;<i class="fas fa-caret-down"></i></a></button>
                      <ul class="sub-menu">
                        <li class="<?= (uri_string(true) == "home/profile") ? "current_page" : '' ?>"><a href="<?= base_url('home/profile'); ?>">My Profile</a></li>
                        <li class="<?= (uri_string(true) == "home/applied_jobs") ? "current_page" : '' ?>"><a href="<?= base_url('home/applied_jobs'); ?>">My Applications</a></li>
                        <li class="<?= (uri_string(true) == "home/matching_jobs") ? "current_page" : '' ?>"><a href="<?= base_url('home/matching_jobs'); ?>">Matching Jobs</a></li>
                        <li class="<?= (uri_string(true) == "home/saved_jobs") ? "current_page" : '' ?>"><a href="<?= base_url('home/saved_jobs'); ?>">Saved Jobs</a></li>
                        <li class="<?= (uri_string(true) == "home/change_password") ? "current_page" : '' ?>"><a href="<?= base_url('home/change_password'); ?>">Change Password</a></li>
                        <li class="<?= (uri_string(true) == "home/logout") ? "current_page" : '' ?>"><a href="<?= base_url('home/logout') ?>">Logout</a></li>
                      </ul>
                    </li>
                  <?php endif; ?>
                </ul>
        
              </nav>
        <div class="ac_nav">
        <!--Not logedin-->
        <?php if (session('user_logged_in')) : ?>
        <?php else : ?>
          <div class="login_pop">
            <button class="btn btn-primary">Login<i class="fas fa-caret-down ml_5"></i></button>
            <div class="login_pop_box">
              <span class="twobtn_cont">
                <a class=" signjs_btn" href="<?= base_url('login'); ?>">         
                <span>Job seekers</span> Sign in
                <i class="far fa-user"></i>
                </a>
              <a class=" signrs_btn" href="<?= base_url('employer/login'); ?>"> <span>EMPLOYERS</span> Sign in
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