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
<header class="header_01 header_inner ">
  <div class="header_main header_job_single_main">
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
                <?php if (session('user_logged_in')) : ?>
                  <div class="login_pop">
                    <div class="dropdown">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Welcome <?= session('username') ?></button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="<?= base_url('home/profile') ?>"><i class="fas fa-user" aria-hidden="true"></i> &nbsp;&nbsp;My Profile</a>
                        <a class="dropdown-item" href="<?= base_url('home/applied_jobs') ?>"><i class="fas fa-briefcase" aria-hidden="true"></i> &nbsp;&nbsp;My Applications</a>
                        <a class="dropdown-item" href="<?= base_url('home/matching_jobs') ?>"><i class="fas fa-briefcase" aria-hidden="true"></i> &nbsp;&nbsp;Matching Jobs</a>
                        <a class="dropdown-item" href="<?= base_url('home/saved_jobs') ?>"><i class="fas fa-briefcase" aria-hidden="true"></i> &nbsp;&nbsp;Saved Jobs</a>
                        <a class="dropdown-item" href="<?= base_url('home/change_password') ?>"><i class="fas fa-key" aria-hidden="true"></i> &nbsp;&nbsp;Change Password</a>
                        <a class="dropdown-item" href="<?= base_url('home/logout') ?>"><i class="fas fa-power-off"></i> &nbsp;&nbsp;Logout</a>
                      </div>
                    </div>
                  </div>
                <?php else : ?>
                  <div class="dropdown login_pop">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login</button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="<?= base_url('login'); ?>">Job Seeker Login</a>
                      <a class="dropdown-item" href="<?= base_url('employer/login'); ?>">Employer Login</a>
                    </div>
                  </div>
                <?php endif; ?>
                <!--end logedin-->
              </div>
          </div>
        </div>
      </div>
    </div>
    <div class="header_btm header_job_single">
	<div class="header_job_single_inner container">
		<div class="poster_company">
			<img  alt="brand logo" class="img img-fluid" src="<?= $data['company_logo'] ?>">
		</div> 
		<div class="poster_details">
			<h2><?= $data['title'] ?></h2>
			<ul>
				<li>
					<a href="#">
						<i class="fas fa-landmark"></i>
						<?= get_company_name($data['company_id']) ?>
					</a>
				</li>
				<li>
					<a href="#">
						<i class="fas fa-map-marker-alt"></i>
						<?= get_state_name($data['state']) ?>, <?= get_city_name($data['city']) ?>
					</a>
				</li>
				<li>
					<a href="#">
						<i class="far fa-clock"></i>
						<?= time_ago($data['created_date']) ?>
					</a>
				</li>
			</ul>		
		</div>
		<div class="poster_action">
			<a class="addtofav" title="add to favourite" onclick="save(<?= $data['id']; ?>)" href="#"><i id="save" style="cursor:pointer" class="<?= (in_array($data['id'],$saved_job)) ? 'fas fa-heart' : 'far fa-heart' ?>"></i></a>
			<a class="btn btn-third" onclick="apply(<?= $data['id'] ?>)" href="#">Apply Now</a>
			
		</div>
	</div>
    	
    </div>
  </div> 
</header>


<!-- End Header 02
================================================== -->



<!-- Main 
================================================== -->
<main>
  <div class="single_job">
    <div class="container">
      <div class="row">
      	<div class="col-md-9">
      		<div class="row ">
		        <div class="col-md-12 single_job_main">
		        	<h2>Job Description</h2>
		        	<p><?= $data['description'] ?></p>
		        </div>
            <div class="col-md-12 single_job_main">
		        	<h2>Cover Letter</h2>
              <div class="form-group">
                <textarea id="cover" class="form-control"></textarea>
              </div>
            </div>
		      </div>
      	</div>
      	<div class="col-md-3 ">
      		<div class="single-job-sidebar">
				<div class="sjs_box">
					<h3>Job Summary</h3>
	      			<ul class="single-job-sidebar-features">
	      				<li>
	      					<i class="fas fa-map-marker-alt"></i>
	      					<h6>Location</h6>
	      					<p><?= get_state_name($data['state']) ?>, <?= get_city_name($data['city']) ?></p>
	      				</li>
	      				<li>
	      					<i class="fas fa-briefcase"></i>
	      					<h6>Job Type</h6>
	      					<p><?= get_job_type_name($data['job_type']) ?></p>
	      				</li>
	      				<li>
	      					<i class="fas fa-money-bill-alt"></i>
	      					<h6>Salary</h6>
	      					<p>₹<?= $data['min_salary'] ?> - ₹<?= $data['max_salary'] ?></p>
	      				</li>
	      				<li>
	      					<i class="far fa-clock"></i>
	      					<h6>Date Posted</h6>
	      					<p><?= time_ago($data['created_date']) ?></p>
	      				</li>
	      			</ul>
				</div>      			
      		</div>
      		<div class=" sjs_box_action">
      				<a class="btn btn-third text-white" onclick="apply(<?= $data['id'] ?>)">Apply Job</a>
      			</div>
      	</div>
      </div>
    </div>
  </div>
</main>

<?php include(VIEWPATH.'users/include/footer.php'); ?>
<script>
function save(id)
  {
    event.preventDefault();
    var data = {
      job_id : id
    };
    $.ajax({
      url:'<?= base_url('home/save_job') ?>',
      method: 'POST',
      data: data,
      success: function(response){
        $("#save").toggleClass("fas far");
      }
    });
  }
  function apply(id)
  {
    event.preventDefault();
    var data = {
      'job_id': id,
      'employer_id': '<?= $data['employer_id'] ?>',
      'username': '<?= session('username') ?>',
      'cover_letter': $('#cover').val(),
      'email': '<?= $data['email'] ?>',
      'job_title': '<?= $data['title'] ?>',
      'job_actual_link': '<?= base_url('home/jobdetails/') ?>/'+id,
    }
    $.ajax({
      url:'<?= base_url('home/apply_job') ?>',
      method:'post',
      data: data,
      success: function (response){
        console.log(response);
      }
    })
  }
</script>  