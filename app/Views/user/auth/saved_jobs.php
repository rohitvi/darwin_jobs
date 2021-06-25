<?php include(VIEWPATH . 'user/include/header.php'); ?>
<!-- Hero Area Start-->
<div class="slider-area ">
    <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="assets/img/hero/about.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>Candidate Profile</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero Area End -->
<!-- Job List Area Start -->
<div class="job-listing-area pt-120 pb-120">
    <div class="container">
        <div class="row">
            <!-- Left content -->
            <div class="col-xl-3 col-lg-3 col-md-4">
                <div class="row">
                    <div class="col-12">
                            <div class="small-section-tittle2 mb-45">
                            <div class="ion"> <svg 
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="20px" height="12px">
                            <path fill-rule="evenodd"  fill="rgb(27, 207, 107)"
                                d="M7.778,12.000 L12.222,12.000 L12.222,10.000 L7.778,10.000 L7.778,12.000 ZM-0.000,-0.000 L-0.000,2.000 L20.000,2.000 L20.000,-0.000 L-0.000,-0.000 ZM3.333,7.000 L16.667,7.000 L16.667,5.000 L3.333,5.000 L3.333,7.000 Z"/>
                            </svg>
                            </div>
                            <h4>Filter Jobs</h4>
                        </div>
                    </div>
                </div>
                <!-- Job Category Listing start -->
                <div class="job-category-listing mb-50">
                   <div class="single-listing text-center">
                        <div class="out">
                            <a href="javascript:avoid(0)" class="employer-dashboard-thumb">
                                <img class="profile-picture img-fluid rounded" height="125" width="125" src="http://localhost/reference-job/uploads/profile_pictures/2371115986d7a15f9904cb4a355cf5f0.jpg" alt="">
                            </a>
                            <form id="change_file">
                                <div class="iconn">
                                    <label>
                                        <i class="loader_class fas fa-camera fa-3x"></i>
                                        <input type="file" style="display: none" name="profile_picture" class="change_file">
                                    </label>
                                </div>
                            </form>
                        </div>
                   </div>
                   <div class="single-listing mt-3 text-left">
                        <a href="<?= base_url('home/profile'); ?>" class="ahref mt-3">
                            <div class="icon"><i class="fas fa-user ml-3" aria-hidden="true"></i> &nbsp;&nbsp; My Profile</div>
                        </a>
                   </div>
                   <div class="single-listing mt-3 text-left">
                        <a href="" class="ahref mt-3">
                            <div class="icon"><i class="fas fa-file-word ml-3" aria-hidden="true"></i> &nbsp;&nbsp; My Applications</div>
                        </a>
                   </div>
                   <div class="single-listing mt-3 text-left">
                        <a href="<?= base_url('home/matching_jobs'); ?>" class="ahref mt-3">
                            <div class="icon"><i class="fas fa-briefcase ml-3" aria-hidden="true"></i> &nbsp;&nbsp; Matching Jobs</div>
                        </a>
                   </div>
                   <div class="single-listing mt-3 text-left">
                        <a href="<?= base_url('home/saved_jobs'); ?>" class="ahref mt-3">
                            <div class="icon"><i class="fas fa-heart ml-3" aria-hidden="true"></i> &nbsp;&nbsp; Saved Jobs</div>
                        </a>
                   </div>
                   <div class="single-listing mt-3 text-left">
                        <a href="" class="ahref mt-3">
                            <div class="icon"><i class="fas fa-lock ml-3" aria-hidden="true"></i> &nbsp;&nbsp; Change Password</div>
                        </a>
                   </div>
                </div>
                <!-- Job Category Listing End -->
            </div>
            <!-- Right content -->
            <div class="col-xl-9 col-lg-9 col-md-8">
                <!-- Featured_job_start -->
                <section class="featured-job-area">
                    <div class="container">
                        <!-- Count of Job list Start -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="count-job mb-35">
                                    <span>39, 782 Jobs found</span>
                                    <!-- Select job items start -->
                                    <div class="select-job-items">
                                        <span>Sort by</span>
                                        <select name="select">
                                            <option value="">None</option>
                                            <option value="">job list</option>
                                            <option value="">job list</option>
                                            <option value="">job list</option>
                                        </select>
                                    </div>
                                    <!--  Select job items End-->
                                </div>
                            </div>
                        </div>
                        <!-- Count of Job list End -->
                        <!-- single-job-content -->
                        <?php foreach ($data as $key => $value) : ?>
                        <div class="single-job-items mb-30">
                            <div class="job-items">
                                <div class="company-img">
                                    <a href="#"><img height="50" width="50" src="<?= get_company_logo($value['company_id'])?>" alt=""></a>
                                </div>
                                <div class="job-tittle job-tittle2">
                                    <a href="#">
                                        <h4><?= $value['title'] ?></h4>
                                    </a>
                                    <ul>
                                        <li><?= get_company_name($value['company_id']) ?></li>
                                        <li><i class="fas fa-map-marker-alt"></i><?= get_city_name($value['city']); ?>, <?= get_country_name($value['country']); ?></li>
                                        <li>₹<?= $value['min_salary'] ?> - ₹<?= $value['max_salary'] ?></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="items-link items-link2 f-right">
                                <a href="job_details.html">Details</a>
                                <span><?= time_ago($value['created_date']); ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <!-- single-job-content -->
                    </div>
                </section>
                <!-- Featured_job_end -->
            </div>
        </div>
    </div>
</div>
<!-- Job List Area End -->
<?php include(VIEWPATH . 'user/include/footer.php'); ?>
