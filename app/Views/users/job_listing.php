<?php include(VIEWPATH . 'users/include/header.php'); ?>
<style>
  .fild-wrap input {
    width: 100%;
    padding: 0 17px;
    height: 58px;
    line-height: 58px;
    border: none;
  }

  .contact_side {
    padding-left: 15px;
    padding-right: 15px;
    display: none;
  }
</style>

<div class='header_inner '>
<div class="header_btm">
  <!-- <div class="bg-v" >
				<div class="bg-v-2 bg-b-r">
				</div>
			</div> -->
  <div class="container">
    <div class="banner_slider ">
      <div class="">
        <div class="row align-items-center">
          <div class="col-lg-4" data-aos="fade-down" data-aos-delay="200">
            <h2>Find the most exciting<br> starup jobs</h2>
            <p>Most complete 2020 template for Job board sites.</p>
            <a class="btn btn-primary" href="browse-jobs.html">Know more
              <i class="material-icons">arrow_right_alt</i>
            </a>
          </div>
          <div class="col-lg-8">
            <div class="banner_form_cont">
              <form action="<?= base_url('search') ?>" method="POST">
                <div class="banerSearch" data-aos="fade-up" data-aos-delay="200">
                  <div class="fild-wrap fw-job-title">
                    <input class="form-control" type="text" name="job_title" value="<?= isset($_POST['job_title']) ? $_POST['job_title'] : '' ?>" placeholder="Job Title" required>
                  </div>
                  <div class="fild-wrap fw-job-location">
                    <i class="fas fa-map-marker-alt"></i>
                    <select class="js-example-basic-single" name="state">
                      <?php foreach ($states as $key => $state) : ?>
                        <option value="<?= $state['id'] ?>" <?= (isset($_POST['state']) && $_POST['state'] == $state['id']) ? 'selected' : '' ?>><?= $state['name'] ?></option>
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
              <div class="user_type">
                <div class="row">
                  <div class="col-md-6">
                    <div class="user_type_inner  user_type_seeker">
                      <a href="browse-jobs.html">
                        <div class="usertype_img">
                          <img alt="" src="<?= base_url(); ?>/public/users/images/usertype-2.png">
                          <img alt="" class="usertype-addon" src="<?= base_url(); ?>/public/users/images/usertype-2-addon.png">
                        </div>
                        <div>
                          <h3>I'm looking for a job</h3>
                          <p>Post CV and apply job you love</p>
                          <i class="fas fa-long-arrow-alt-right"></i>
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="user_type_inner user_type_post">
                      <a href="post-a-job.html">
                        <div class="usertype_img">
                          <img alt="" src="<?= base_url(); ?>/public/users/images/usertype-1.png">
                          <img alt="" class="usertype-addon" src="<?= base_url(); ?>/public/users/images/usertype-1-addon.png">
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
</div>
</header>
<!-- Main 
================================================== -->
<main>
  <div class="job_container">
    <div class="container">
      <div class="row job_main">
      <div class="sidebar">
          <ul class="user_navigation">
            <li class="is-active">
              <a>Filter Jobs
                <i class="fas fa-filter"></i>
              </a>
            </li>
            <li>
              <form style="padding-left:15px; padding-right:15px;" method="POST">
                <div class="form-group">
                  <label>Category</label>
                  <div class="field">
                    <i class="fas fa-briefcase"></i>
                    <select class="js-example-basic-single" name="category">
                      <option value="">Select Category</option>
                      <?php foreach ($categories as $key => $cate) : ?>
                        <option value="<?= $cate['id'] ?>" <?= (isset($_POST['category']) && $_POST['category'] == $cate['id']) ? 'selected' : '' ?>><?= $cate['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label>Experience</label>
                  <div class="field">
                    <i class="fas fa-briefcase"></i>
                    <select class="js-example-basic-single" name="experience">
                      <option value="">Select Experience</option>
                      <option value="0-1" <?= (isset($_POST['experience']) && $_POST['experience'] == '0-1') ? 'selected' : '' ?>>0-1 Year</option>
                      <option value="1-2" <?= (isset($_POST['experience']) && $_POST['experience'] == '1-2') ? 'selected' : '' ?>>1-2 Years</option>
                      <option value="2-5" <?= (isset($_POST['experience']) && $_POST['experience'] == '2-5') ? 'selected' : '' ?>>2-5 Years</option>
                      <option value="5-10" <?= (isset($_POST['experience']) && $_POST['experience'] == '5-10') ? 'selected' : '' ?>>5-10 Years</option>
                      <option value="10-15" <?= (isset($_POST['experience']) && $_POST['experience'] == '10-15') ? 'selected' : '' ?>>10-15 Years</option>
                      <option value="15+" <?= (isset($_POST['experience']) && $_POST['experience'] == '15+') ? 'selected' : '' ?>>15+ Years</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label>Job Type</label>
                  <div class="field">
                    <i class="fas fa-briefcase"></i>
                    <?php
                    $job_type = (isset($search_value['job_type'])) ? $search_value['job_type'] : '';
                    $types = get_job_type_list();
                    ?>
                    <select class="js-example-basic-single" name="job_type">
                      <?php foreach ($types as $type) : ?>
                        <option value="<?= $type['id'] ?>" <?= (isset($_POST['job_type']) && $_POST['job_type'] == $type['id']) ? 'selected' : '' ?>><?= $type['type'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label>Job Type</label>
                  <div class="field">
                    <i class="fas fa-briefcase"></i>
                    <?php
                    $employment_type = (isset($search_value['employment_type'])) ? $search_value['employment_type'] : '';
                    $emp_type = get_employment_type_list();
                    ?>
                    <select class="js-example-basic-single" name="job_type">
                      <?php foreach ($emp_type as $type) : ?>
                        <option value="<?= $type['id'] ?>"><?= $type['type'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div><br><br>
                <button type="submit" class="btn btn-primary btn-block">SEARCH</button>
 
            </li>
          </ul>
        </div>
        <div class=" job_main_right">
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
            </div>
            <div class="col-sm-12">
              <div class="featured_box ">
                <div class="fb_image">
                  <img alt="brand logo" src="assets/images/c-logo-05.webp">
                </div>
                <div class="fb_content">
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
                        3 days ago
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="fb_action">
                  <a title="add to favourite" href="#"><i class="fas fa-heart"></i></a>
                  <a class="btn btn-primary" href="#">Apply Now</a>
                </div>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="featured_box ">
                <div class="fb_image">
                  <img alt="brand logo" src="assets/images/c-logo-01.webp">
                </div>
                <div class="fb_content">
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
                        5 days ago
                      </a>
                    </li>

                  </ul>
                </div>
                <div class="fb_action">
                  <a title="add to favourite" href="#"><i class="far fa-heart"></i></a>
                  <a class="btn btn-primary disabled" href="#">Applied</a>
                </div>
              <div class="fild-wrap fw-submit">
                <button type="submit" class="btn btn-primary">
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
                  <img alt="brand logo" src="<?= get_company_logo($job['company_id']) ?>">
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
                  <a title="add to favourite" onclick="save(<?= $job['id'] ?>)"><i id="save" style="cursor:pointer; color:#ff6158;" class="<?= (in_array($job['id'], $saved_job)) ? 'fas fa-heart' : 'far fa-heart' ?>"></i></a>
                  <a class="btn btn-primary" href="<?= base_url('home/jobdetails/'.$job['id']) ?>">Details</a>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
          <div class="section-divider">
          <nav aria-label="...">
            <ul class="pagination">
              <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
              </li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item active" aria-current="page">
                <a class="page-link" href="#">2</a>
              </li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#">Next</a>
              </li>
            </ul>
          </nav>
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

<script>
  function save(id){
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
</script>