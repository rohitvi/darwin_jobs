<?php include(VIEWPATH . 'employer/include/header.php'); ?>
<style>
  .form-control {
    padding-left: 27px;
  }

  #big_form_group {
    box-shadow: 2px 14px 14px 12px rgb(14 13 13 / 11%);
    padding-left: 20px;
  }
</style>
<div class='header_inner '>
  <div class="header_btm">
    <h2>Search Candidates</h2>
  </div>
</div>
</header>

<main>
  <div class="job_container">
    <div class="container">
      <div class="row job_main">
        <?php include(VIEWPATH . 'employer/include/sidebar.php'); ?>
        <div class=" job_main_right">
          <div class="row job_section">
            <div class="col-sm-12">
              <div class="jm_headings">
                <h5>Search Candidates</h5>
              </div>
              <?php if (isset($_POST['search']) && empty($profiles)) : ?>
                <p class="alert alert-danger">Sorry, we could not find any profile for the keywords that you entered</p>
              <?php endif; ?>
              <form action='search' method='post'>
                <div class="big_form_group">
                  <div class="row">

                    <div class="col-md-4">
                      <div class="form-group">
                        <div class="field">
                          <i class="fa fa-search"></i>
                          <input type="text" name='job_title' class="form-control" value="<?= set_value('job_title'); ?>" placeholder='What are you looking for?'>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <div class="field">
                          <i class="fa fa-list"></i>
                          <select name="category" class="form-control js-example-basic-single">
                            <option value="">Select Category</option>
                            <?php foreach ($categories as $category) : ?>
                              <option value="<?= $category['id']; ?>"> <?= $category['name']; ?> </option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <div class="field">
                          <i class="fas fa-map-marker-alt"></i>
                          <select name="state" class="form-control js-example-basic-single">
                            <option value="">Select Location</option>
                            <?php foreach ($states as $state) : ?>
                              <option value="<?= $state['id']; ?>"> <?= $state['name']; ?> </option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <div class="field">
                          <i class="fas fa-money-bill"></i>
                          <select name="expected_salary" class="form-control js-example-basic-single">
                            <option value="">Expected Salary</option>
                            <?php for ($i = 500; $i < 10000; $i = $i + 500) { ?>
                              <option value="<?= $i; ?>"> <?= $i; ?> </option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <div class="field">
                          <i class="fas fa-user-graduate"></i>
                          <select name="education_level" class="form-control js-example-basic-single">
                            <option value="">Select Education</option>
                            <?php foreach ($education as $education) : ?>
                              <option value="<?= $education['id']; ?>"> <?= $education['type']; ?> </option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <div class="field">
                          <i class="fas fa-briefcase"></i>
                          <select name="experience" class="form-control js-example-basic-single">
                            <option value="">Select Experience</option>
                            <option value="0-1">0-1 years</option>
                            <option value="1-2">1-2 years</option>
                            <option value="2-5">2-5 years</option>
                            <option value="5-10">5-10 years</option>
                            <option value="10-15">10-15 years</option>
                            <option value="15+">15+ years</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                    </div>

                    <div class="col-md-4">
                      <input type="submit" name="search" class="btn btn-primary btn-block mb-2" value='Search'>

                    </div>
                    <div class="col-md-4">

                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="row findstaf_section ">
            <?php foreach ($profiles as $row) : ?>
              <div class="col-sm-6">
                <div class="staffBox">
                  <div class="staff_img">
                    <img alt="Photo" src="<?= $row['profile_picture']; ?>">
                  </div>
                  <div class="staff_detail">
                    <h3><?= $row['firstname'] . ' ' . $row['lastname']; ?></h3>
                    <p><?= $row['job_title']; ?></p>
                    <ul>
                      <li>
                        <h6><?= $row['job_title']; ?></h6>
                        <i class="fas fa-map-marker-alt"></i>
                        <span><?= get_city_name($row['city']); ?></span>
                      </li>
                      <li>
                        <h6>Experience</h6>
                        <i class="fas fa-calendar-check"></i>
                        <span><?= $row['experience']; ?></span>
                      </li>
                      <li>
                        <h6>Age</h6>
                        <i class="fas fa-user"></i>
                        <span><?= $row['age']; ?></span>
                      </li>
                    </ul>
                    <div class="staffBox_action">
                      <a href="<?= base_url('employer/candidates_shortlisted/' . $row['id']) ?>" class="btn btn-third">Shortlist</a>
                      <a class="btn btn-third" href="">View profile</a>
                      <a class="btn btn-third" href="<?= $row['resume'] ?>">Download CV</a>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <?php if ($pager) : ?>
            <?php $pagi_path = 'employer/search' ?>
            <?php $pager->setPath($pagi_path); ?>
            <?= $pager->links() ?>
          <?php endif ?>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include(VIEWPATH . 'employer/include/footer.php'); ?>
<script>
  $('.js-example-basic-single').select2();
</script>