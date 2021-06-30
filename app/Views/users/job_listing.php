<?php include(VIEWPATH . 'users/include/header.php'); ?>

<div class='header_inner '>
<div class="header_btm">
  <h2>Browse Jobs</h2>
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
            <li class="is-active">
              <a href="browse-jobs.html"><i class="fas fa-search"></i> Browse Jobs </a>
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
            <li>
              <a href="job-seeker-dashboard.html">
                <i class="fas fa-border-all"></i> Job Dashboard
              </a>
            </li>
          </ul>
          <h5>Organize and Manage</h5>
          <ul class="user_navigation">
            <li>
              <a href="my-stared-jobs.html"><i class="fas fa-star"></i> View My Stared Jobs</a>
            </li>
          </ul>
          <h5>Account</h5>
          <ul class="user_navigation">
            <li>
              <a href="edit-profile.html"><i class="fas fa-user"></i> Update My Profile</a>
            </li>
            <li>
              <a href="edit-password.html"><i class="fas fa-key"></i>Change Password</a>
            </li>
            <li>
              <a href="edit-password.html"><i class="fas fa-power-off"></i> Logout</a>
            </li>
          </ul>
        </div>
        <div class=" job_main_right">
          <form action="<?= base_url('search') ?>" method="POST">
            <div class="banerSearch" data-aos="fade-up" data-aos-delay="200">
              <div class="fild-wrap fw-job-title">
                <input class="form-control" type="text" name="job_title" placeholder="Job Title" required>
              </div>
              <div class="fild-wrap fw-job-location">
                <i class="fas fa-map-marker-alt"></i>
                <select class="js-example-basic-single" name="state">
                <?php foreach ($states as $key=>$state) : ?>
                  <option value="<?= $state['id'] ?>"><?= $state['name'] ?></option>
                  <?php endforeach ; ?>
                </select>
              </div>
              <div class="fild-wrap fw-submit">
                <button type="submit" class="btn btn-primary" value="">
                  <i class="material-icons">search</i> SEARCH JOBS
                </button>
              </div>
            </div>
          </form>
          <div class="jm_headings">
            <h5>Browse Jobs in list</h5>
          </div>
          <div class="row full_width featured_box_outer">
          <?php foreach ($jobs as $job) : ?>
            <div class="col-sm-12">
              <div class="featured_box ">
                <div class="fb_image">
                  <img alt="brand logo" src="<?= base_url(); ?>/public/users/images/c-logo-02.webp">
                </div>
                <div class="fb_content">
                  <h4><?= $job['title']; ?></h4>
                  <ul>
                    <li>
                      <a href="#">
                        <i class="fas fa-landmark"></i>
                        <?= get_company_name($job['company_id']); ?>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="fas fa-map-marker-alt"></i>
                        <?= get_state_name($job['state']) ?>, <?= get_city_name($job['city']) ?>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="far fa-clock"></i>
                        <?= time_ago($job['created_date']) ?>
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="fb_action">
                  <a title="add to favourite" href="#"><i class="far fa-heart"></i></a>
                  <a class="btn btn-primary" href="<?= base_url('home/jobdetails/'.$job['id']) ?>">Details</a>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
          <div class="section-divider">
            <?php if ($pager) : ?>
              <?php $pagi_path = 'search' ?>
              <?php $pager->setPath($pagi_path); ?>
              <?= $pager->links() ?>
            <?php endif ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php include(VIEWPATH . 'users/include/footer.php'); ?>