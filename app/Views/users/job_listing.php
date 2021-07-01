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
                  <a title="add to favourite" onclick="save(<?= $job['id'] ?>)"><i id="save" style="cursor:pointer; color:#ff6158;" class="<?= (in_array($job['id'],$saved_job)) ? 'fas fa-heart' : 'far fa-heart' ?>"></i></a>
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
</script>