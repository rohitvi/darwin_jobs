<?php include(VIEWPATH . 'users/include/header.php'); ?>

<style>
  .select2-container .select2-selection--single .select2-selection__rendered{
    line-height: 45px!important;
  }
  .select2-selection__rendered{
    line-height: 45px!important;
  }
  .btn, button {
    padding: 9px 20px!important;
  }
  .page-item.active .page-link{
    background-color: #ff6158;
    border: #ff6158;
  }
  .page-link{
    color: #ff6158;
  }
</style>

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
                        <option value="<?= $cate['id'] ?>" <?= (isset($_GET['category']) && $_GET['category'] == $cate['id']) ? 'selected' : '' ?>><?= $cate['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label>Experience</label>
                  <div class="field">
                    <i class="fas fa-briefcase"></i>
                    <select class="js-example-basic-single" name="experience">
                      <option value="">Select Experience</option>s
                      <option value="0-1" <?= (isset($_GET['experience']) && $_GET['experience'] == '0-1') ? 'selected' : '' ?>>0-1 Year</option>
                      <option value="1-2" <?= (isset($_GET['experience']) && $_GET['experience'] == '1-2') ? 'selected' : '' ?>>1-2 Years</option>
                      <option value="2-5" <?= (isset($_GET['experience']) && $_GET['experience'] == '2-5') ? 'selected' : '' ?>>2-5 Years</option>
                      <option value="5-10" <?= (isset($_GET['experience']) && $_GET['experience'] == '5-10') ? 'selected' : '' ?>>5-10 Years</option>
                      <option value="10-15" <?= (isset($_GET['experience']) && $_GET['experience'] == '10-15') ? 'selected' : '' ?>>10-15 Years</option>
                      <option value="15+" <?= (isset($_GET['experience']) && $_GET['experience'] == '15+') ? 'selected' : '' ?>>15+ Years</option>
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
                      <option value="">Select job type</option>
                      <?php foreach ($types as $type) : ?>
                        <option value="<?= $type['id'] ?>" <?= (isset($_GET['job_type']) && $_GET['job_type'] == $type['id']) ? 'selected' : '' ?>><?= $type['type'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label>Employment Type</label>
                  <div class="field">
                    <i class="fas fa-briefcase"></i>
                    <?php
                    $employment_type = (isset($search_value['employment_type'])) ? $search_value['employment_type'] : '';
                    $emp_type = get_employment_type_list();
                    ?>
                    <select class="js-example-basic-single" name="job_type">
                    <option value="">Select Employment</option>
                      <?php foreach ($emp_type as $type) : ?>
                        <option value="<?= $type['id'] ?>"><?= $type['type'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">SEARCH</button>
            </li>
          </ul>
        </div>
        <div class=" job_main_right">
          <div class="banerSearch" data-aos="fade-up" data-aos-delay="200">
            <div class="fild-wrap fw-job-title">
              <input class="form-control" value="<?= isset($_GET['title']) ? $_GET['title'] : '' ?>" type="text" name="job_title" placeholder="Job Title">
            </div>
            <div class="fild-wrap fw-job-location">
              <i class="fas fa-map-marker-alt"></i>
              <select class="js-example-basic-single" name="city">
                <option value=''>Select City</option>
                <?php foreach ($cities as $key => $city) : ?>
                  <option value="<?= $city['id'] ?>" <?= (isset($_GET['city']) && $_GET['city'] == $city['id']) ? 'selected' : '' ?>><?= $city['name'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="fild-wrap ml-1 fw-submit">
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
            <?php if (count($jobs) > 0) : ?>
             <?php foreach ($jobs as $job) : ?>
              <div class="col-sm-12">
                <div class="featured_box ">
                  <div class="fb_image">
                    <img class="img img-fluid" height="50" width="50" alt="brand logo" src="<?= get_company_logo($job['company_id']) ?>">
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
                    <a title="add to favourite" onclick="save(<?= $job['id'] ?>)"><i id="save<?= $job['id'] ?>" style="cursor:pointer; color:#ff6158;" class="<?= (in_array($job['id'], $saved_job)) ? 'fas fa-heart' : 'far fa-heart' ?>"></i></a>
                    <a class="btn btn-primary" href="<?= base_url('home/jobdetails/' . $job['id']) ?>">Details</a>
                  </div>
                </div>
              </div>
            <?php endforeach;
            else: ?>
              <div class="col-sm-12">
                <p>No Search Result</p>
              </div>
            <?php endif; ?>
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

<script>
  function save(id) {
    event.preventDefault();
    var data = {
      job_id: id
    };
    $.ajax({
      url: '<?= base_url('home/save_job') ?>',
      method: 'POST',
      data: data,
      success: function(responses) {
        var response = responses.split('~');
        if ($.trim(response[0]) == 0) {
          toastr.error(response[1]);
        }else{
          toastr.success(response[1]);
          $("#save" + id).toggleClass("fas far");
        }
      }
    });
  }
</script>