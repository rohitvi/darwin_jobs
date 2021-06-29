<?php include(VIEWPATH.'users/include/header.php'); ?>
<div class='header_inner'>
<div class="header_btm header_job_single">
	<div class="header_job_single_inner container">
		<div class="poster_company">
        <img src="<?= $data['company_logo']; ?>" alt="">
		</div> 
		<div class="poster_details">
			<h2><?= $data['title']; ?> <span class="varified"><i class="fas fa-check"></i>Verified</span></h2>
			<h5>About the Employer</h5>
			<ul>
				<li>
					<a href="#">
						<i class="fas fa-landmark"></i>
						<?= $data['company_name']; ?>
					</a>
				</li>
				<li>
					<a href="#">
						<i class="fas fa-map-marker-alt"></i>
						<?= get_city_name($data['city']); ?>, <?= get_country_name($data['country']); ?>
					</a>
				</li>
				<li>
					<a href="#">
						<i class="far fa-clock"></i>
						<?= time_ago($data['created_date']); ?>
					</a>
				</li>
			</ul>		
		</div>
		<div class="poster_action">
			<a class="addtofav" title="add to favourite" href="#"><i class="far fa-heart"></i></a>
			<a class="btn btn-third" href="#">Apply Now</a>
			
		</div>
	</div>
</div>
</div>



<main>
  <div class="single_job">
    <div class="container">
      <div class="row">
      	<div class="col-md-9">
      		<div class="row ">
		        <div class="col-md-12 single_job_main">
		        	<h2>Job Description</h2>
		        	<p><?= $data['description']; ?></p>
		        </div>
		        <div class="section-divider"></div>
		        <div class="col-md-12 single_job_main">
		        	<h2>Required Knowledge, Skills, and Abilities</h2>
                    <ul>
                           <li><?= $data['title']; ?></li>
                       </ul>
		        </div>

                <div class="col-md-12 single_job_main">
		        	<h2>Education + Experience</h2>
                        <ul>
                           <li><?= $data['education']; ?></li>
                           <li><?= $data['experience']; ?> years</li>
                       </ul>
		        </div>
		      </div>
      	</div>
      	<div class="col-md-3 ">
      		<div class="single-job-sidebar">
				<div class="sjs_box">
					<h3>Job Summary</h3>
	      			<ul class="single-job-sidebar-features">
	      				<li><i class="fas fa-map-marker-alt"></i><h6>Location</h6><p><?= get_city_name($data['city']); ?>, <?= get_country_name($data['country']); ?></p></li>
	      				<li><i class="fas fa-briefcase"></i><h6>Job Type</h6><p><?= $data['salary_period']; ?></p></li>
                        <li><i class="fas fa-briefcase"></i><h6>Vacancy</h6><p><?= $data['total_positions']; ?></p></li>
	      				<li><i class="fas fa-money-bill-alt"></i><h6>Salary</h6><p>₹<?= $data['min_salary']; ?> - ₹<?= $data['max_salary']; ?></p></li>
	      				<li><i class="far fa-clock"></i><h6>Date Posted</h6><p><?= $data['created_date']; ?></p></li>
	      			</ul>
				</div>      			
      		</div>


              <div class="single-job-sidebar">
				<div class="sjs_box">
					<h3>Company Information</h3>
	      			<ul class="single-job-sidebar-features">
	      				<li><i class="fas fa-landmark"></i><h6>Name </h6><p><?= $data['company_name']; ?></p></li>
	      				<li><i class="fas fa-landmark"></i><h6>Web </h6><p><?= $data['website']; ?></p></li>
                        <li><i class="fas fa-envelope"></i><h6>Email </h6><p><?= $data['email']; ?></p></li>
	      			</ul>
				</div>      			
      		</div>
      	</div>
      </div>
    </div>
  </div>
</main>
<?php include(VIEWPATH.'users/include/footer.php'); ?>