<!doctype html>
<html lang="en">
<head>

<!-- Basic Page Needs
================================================== -->
<title>JoDice</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="icon" href="<?= base_url(); ?>/public/users/images/fav.png" type="image/gif" sizes="64x64">

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
<header class="header_01 header_inner">
  <div class="header_main">
    <div class="header_menu fixed-top">
      <div class="container">
        <div class="header_top">
          <div class="logo">
            <a href="<?= base_url('employer') ?>">
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
                <li class="has-sub-menu ">
                  <a href="index.html" >Home</a>
                  <ul class="sub-menu">
                    <li >
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

                <li class="has-sub-menu ">
                  <a href="#">Pages</a>
                  <ul class="sub-menu">

                    <li >
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
                <div class="dropdown login_pop">
                  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Register</button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="<?= base_url('home/register'); ?>">Job Seeker Register</a>
                    <a class="dropdown-item" href="<?= base_url('employer/register'); ?>">Employer Register</a>
                  </div>
                </div>
              <!--end logedin-->
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="header_btm">
      <h2>Job Seeker Login</h2>
    </div>
  </div> 
</header>


<!-- End Header 02
================================================== -->



<!-- Main 
================================================== -->
<main>
  <div class="only-form-pages">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="only-form-box">   
            <form method="post" id="login">
              <div class="com_class_form">
                <div class="form-group">
              
                  <input class="form-control" type="text" name="email" size="40" placeholder="Email address * ">
                </div>
                <div class="form-group">
                  
                  <input class="form-control" type="password" name="password" placeholder=" Password * ">
                </div>
                
                
                <div class="form-group">
                  <input class="btn btn-primary" type="submit" value="Login">
                </div>
                <div>
                    <div class="d-inline-block">
                      <a class="lost_password" href="<?= base_url('employer/password_reset') ?>"> Lost your password?</a>
                    </div>
                    <div class="float-right d-inline-block">
                      <a class="lost_password" href="<?= base_url('employer/register') ?>"> New User?</a>
                    </div>
                </div>
              </div>
            </form>
            <div class="social_login">
              <p class="or_span"><span>or</span></p>
              <button class="btn btn-facebook"><i class="fab fa-facebook-f"></i> Log In via Facebook</button>
              <button class="btn btn-google"><i class="fab fa-google-plus-g"></i> Register via Google+</button>
            </div>
           </div>
        </div>
      </div>
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
            <h2>Job seekers</h2>
            <ul>
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
            <h2>Employers</h2>
            <ul>
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
            <h2>Community</h2>
            <ul>
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
            <h2>Get In Touch</h2>
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
                        <h2>Newsletter</h2>
                        <div class="d-flex">

                          <input class="form-control" type="email" placeholder="Enter your email ">
                          <button class="btn btn-primary"><i class="fa fa-paper-plane"></i></button>
                         
                        </div>
                       
                    </form>
                </div>
        </div>
        <div class="col-md-12">
          <div class="footer_widget_box">
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
<script src="<?= base_url(); ?>/public/users/js/jquery-3.4.1.min.js"></script>
<script src="<?= base_url(); ?>/public/users/js/select2.min.js"></script>
<script src="<?= base_url(); ?>/public/users/js/popper.min.js"></script>
<script src="<?= base_url(); ?>/public/users/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/public/users/js/owl.carousel.min.js"></script>
<script src="<?= base_url(); ?>/public/users/js/custom.js"></script>
<script src="<?= base_url(); ?>/public/users/js/noty/noty.js"></script>
<script>
  $('#login').on('submit',function(){
        event.preventDefault();
    var fields = $('#login').serialize();
    $.ajax({
      url: "<?= base_url('employer/login') ?>",
            method: "POST",
            data: fields,
            success: function(responses){
              console.log(responses);
              var response = responses.split('~');
              if ($.trim(response[0]) == 0) {
                $('#login').trigger("reset");
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
                if ($.trim(responses[0]) == 1) {
                  $('#login').trigger("reset");
                  setTimeout(function() {
                    window.location.href = 'dashboard';
                  }, 500);
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
</body>
</html>
