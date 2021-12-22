<?php include(VIEWPATH . 'users/include/header.php'); ?>
<style>
	.fild-wrap input {
		width: 100%;
		padding: 0 17px;
		height: 62px;
		line-height: 62px;
		border: none;
	}
	.fild-wrap > i {
		line-height: 58px;
	}

    .header_02 .header_btm {
        min-height: 240px;
        background: url('<?= get_g_setting_val('home_banner'); ?>');
        /*background: linear-gradient(to bottom,#051322,#15457c);*/
        background-position: center;
        position: relative;
        background-size: cover;
    }
</style>

<header class="header_02">
<div class="header_btm">
	<!-- <div class="bg-v" >
				<div class="bg-v-2 bg-b-r">
				</div>
			</div> -->
	<div class="container">
		<div class="banner_slider ">
			<div class="">
				<div class="row align-items-center">
					<!--<div class="col-lg-4" data-aos="fade-down" data-aos-delay="200">
						
						<p>Most complete 2020 template for Job board sites.</p>
						<a class="btn btn-primary text-white" href="<?= base_url('search') ?>" id="tos">All Jobs
							<i class="material-icons">arrow_right_alt</i>
						</a>
					</div>-->
					
					<div class="col-lg-7 bg_color">
					     <h4 class="title_head">Find the most exciting jobs</h4>
						<div class="banner_form_cont">
							<form action="<?= base_url('search') ?>" method="POST">
								<div class="banerSearch" data-aos="fade-up" data-aos-delay="200">
									<div class="fild-wrap fw-job-title  br_right">
										<input class="select2-search__field" value="<?=  isset($_POST['job_title']) ? $_POST['job_title'] : '' ?>" type="text" name="job_title" placeholder="Job Title">
									</div>
									<div class="fild-wrap fw-job-location">
										<i class="fas fa-map-marker-alt"></i>
										<select class="js-example-basic-single" name="city">
											<?php foreach ($cities as $key => $city) : ?>
												<option value="<?= $city['id'] ?>" <?= ($city['id'] == 2707) ? 'selected' : '' ?>><?= $city['name'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="fild-wrap fw-submit">
										<button type="submit" class="btn btn-primary" value="">
											<i class="material-icons">search</i> SEARCH JOBS
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="col-lg-5">
					    
					    <div class="user_type">
										<div class="row">
											<div style="border-bottom: 1px solid #eee;" class="col-md-12">
												<div class="user_type_inner  user_type_seeker">
													<a href="<?= base_url('home/search') ?>">
														<div class="usertype_img">
															<img alt="" src="<?= base_url('public/users/images/usertype-2.png')?>">
															<img alt="" class="usertype-addon" src="<?= base_url('public/users/images/usertype-2-addon.png')?>">
														</div>
														<div>
															<h3>I'm looking for a job</h3>
															<p>Post CV and apply job you love</p>
															<i class="fas fa-long-arrow-alt-right"></i>
														</div>
													</a>
												</div>
											</div>
											<div class="col-md-12">
												<div class="user_type_inner  user_type_seeker">
													<a href="<?= base_url('employer') ?>">
														<div class="usertype_img">
															<img alt="" src="<?= base_url('public/users/images/usertype-1.png')?>">
															<img alt="" class="usertype-addon" src="<?= base_url('public/users/images/usertype-1-addon.png')?>">
														</div>
														<div>
															<h3>I want to post job</h3>
															<p>Post jobs & hire porfessionls</p>
															<i class="fas fa-long-arrow-alt-right"></i>
														</div>
													</a>
												</div>
											</div>
										</div>
									</div>
					</div>
				</div>
			</div>


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
	
	<div class="section category-section-2 gray">
	   <div class="bg-v">
			<div class="bg-v-1 bg-t-l" data-aos="zoom-in">
			</div>
			<div class="bg-v-2 bg-b-r" data-aos="zoom-in">
			</div>
		</div>
		<div class="container">
			<h2 data-aos="fade-up" data-aos-delay="400" class="section_h">Popular Job Categories</h2>
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
					    <?php foreach($categories as $category) : ?>
						<div class="col-md-12">
						   <a href="<?= base_url('home/search?category='.$category['id']) ?>">
							<div class="category_box">
								<div class="cb_header">
									<i class="<?= $category['iconfield'] ?>"></i>
									<span class="job_count"><?= getNumsJobThruCategory($category['id']) ?></span>
								</div>
								<div class="cb_bottom">
									<h3 class="line_height"><?= $category['name'] ?></h3>
									
								</div>
							</div>
						  </a>
						</div>
						<?php endforeach; ?>

						<div class="col-md-12 text-right">
							<a class="btn btn-primary" href="<?= base_url('home/search') ?>">Browse All Jobs <i class="fas fa-long-arrow-alt-right"></i></a>
						</div>
					</div>
				</div>
				
			</div>   
		</div>
		<div class="category-section-stickyBg"></div>
	</div>

	<div style="background-color: #74e8af;" class="section featured_section">

		<div class="container">
			<h2 data-aos="fade-up" data-aos-delay="400" class="section_h txt-blk">Latest Jobs</h2>
			<div class="row two_col featured_box_outer">
			<?php foreach($posts as $post) : ?>
				<div class="col-sm-6">
					<div class="featured_box ">
						<div class="fb_image padd_adjust	">
							<a href="<?= base_url('home/jobdetails/' . $post['id']) ?>">
								<img class="img img-fluid" height="50" width="50" alt="brand logo" src="<?= (isset($post['employer_id'])) ? get_company_logo_empid($post['employer_id']) : base_url('public/users/images/ava.jpg') ?>">
							</a>
						</div>
						<div class='fb_content padd_adjust'>
							<h4>
								<a href="<?= base_url('home/jobdetails/' . $post['id']) ?>"><?= $post['title'] ?></a>
							</h4>
							<ul>
								<li>
									<a href="#">
										<i class="fas fa-landmark"></i>
										<?= get_company_name($post['employer_id']) ?>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-map-marker-alt"></i>
										<?= get_state_name($post['state']) ?>, <?= get_city_name($post['city']) ?>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="far fa-clock"></i>
										<?= time_ago($post['created_date']) ?>
									</a>
								</li>
							</ul>
						</div>
						
						<div class="fb_action">
							<a class="btn btn-third" type="button" href="<?= base_url('home/jobdetails/' . $post['id']) ?>">Details</a>
							<?php  
							$skills = explode("," , $post['skills']);
							?>
              					<ul class="tags">
									<?php $i= 1; foreach($skills as $skill){ if($i <= 3){ ?>
									<li>
                					<a> <i class="fas fa-hashtag"></i>  <?= $skill; ?></a>
									</li>
									<?php } $i++; } ?>
								</ul>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
				<div class="col-md-12 text-right">
					<a data-aos="fade-down" data-aos-delay="400" class="btn btn-primary" href="<?= base_url('home/search') ?>">Browse All Jobs <i class="fas fa-long-arrow-alt-right"></i></a>
					
				</div>
			</div>
		</div>
	</div>

</main>
<?php include(VIEWPATH . 'users/include/footer.php'); ?>