<?php include(VIEWPATH . 'user/include/header.php'); ?>
<!-- Hero Area Start-->
<div class="slider-area ">
    <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="assets/img/hero/about.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>Job Details</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero Area End -->
<!-- job post company Start -->
<div class="job-post-company pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-between">
            <!-- Left Content -->
            <div class="col-xl-7 col-lg-8">
                <!-- job single -->
                <div class="single-job-items pr-0 mb-50">
                    <div class="job-items">
                        <div class="company-img company-img-details">
                            <a href="#"><img height="50" width="50" src="<?= $data['company_logo']; ?>" alt=""></a>
                        </div>
                        <div class="job-tittle">
                            <a href="#">
                                <h4><?= $data['title']; ?></h4>
                            </a>
                            <ul>
                                <li><?= $data['company_name']; ?></li>
                                <li><i class="fas fa-map-marker-alt"></i><?= get_city_name($data['city']); ?>, <?= get_country_name($data['country']); ?></li>
                                <li>₹<?= $data['min_salary']; ?> - ₹<?= $data['max_salary']; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                  <!-- job single End -->
               
                <div class="job-post-details">
                    <div class="post-details1 mb-50">
                        <!-- Small Section Tittle -->
                        <div class="small-section-tittle">
                            <h4>Job Description</h4>
                        </div>
                        <p><?= $data['description']; ?></p>
                    </div>
                    <div class="post-details2  mb-50">
                         <!-- Small Section Tittle -->
                        <div class="small-section-tittle">
                            <h4>Required Knowledge, Skills, and Abilities</h4>
                        </div>
                       <ul>
                           <li><?= $data['title']; ?></li>
                       </ul>
                    </div>
                    <div class="post-details2  mb-50">
                         <!-- Small Section Tittle -->
                        <div class="small-section-tittle">
                            <h4>Education + Experience</h4>
                        </div>
                       <ul>
                           <li><?= $data['education']; ?></li>
                           <li><?= $data['experience']; ?> years</li>
                       </ul>
                    </div>
                </div>

            </div>
            <!-- Right Content -->
            <div class="col-xl-4 col-lg-4">
                <div class="post-details3  mb-50">
                    <!-- Small Section Tittle -->
                   <div class="small-section-tittle">
                       <h4>Job Overview</h4>
                   </div>
                  <ul>
                      <li>Posted date : <span><?= $data['created_date']; ?></span></li>
                      <li>Location : <span><?= $data['location']; ?></span></li>
                      <li>Vacancy : <span><?= $data['total_positions']; ?></span></li>
                      <li>Job nature : <span><?= $data['salary_period']; ?></span></li>
                      <li>Salary :  <span><?= $data['min_salary']; ?> - <?= $data['max_salary']; ?></span></li>
                      <li>Application date : <span><?= $data['created_date']; ?></span></li>
                  </ul>
                 <div class="apply-btn2">
                    <a href="#" class="btn">Apply Now</a>
                 </div>
               </div>
                <div class="post-details4  mb-50">
                    <!-- Small Section Tittle -->
                   <div class="small-section-tittle">
                       <h4>Company Information</h4>
                   </div>
                      <span><?= $data['company_name']; ?></span>
                      <p><?= $data['cdescription']; ?></p>
                    <ul>
                        <li>Name: <span><?= $data['company_name']; ?> </span></li>
                        <li>Web : <span><?= $data['website']; ?></span></li>
                        <li>Email: <span><?= $data['email']; ?></span></li>
                    </ul>
               </div>
            </div>
        </div>
    </div>
</div>
<!-- job post company End -->

<?php include(VIEWPATH . 'user/include/footer.php'); ?>
