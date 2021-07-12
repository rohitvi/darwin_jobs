<?php include(VIEWPATH . 'employer/include/header.php'); ?>
<style>
  .form-control {
    padding-left: 27px;
  }

  #big_form_group {
    box-shadow: 2px 14px 14px 12px rgb(14 13 13 / 11%);
    padding-left: 20px;
  }

  body {
    overflow-x: hidden;
  }

  .pagination {
    margin-top: 1.5rem!important;
  }
  .select2-container .select2-selection--single .select2-selection__rendered {
	  height: 45px!important;
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
    <?php include(VIEWPATH . 'employer/include/profile_info.php'); ?>
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
                          <input type="text" name='job_title' class="form-control" value="<?= isset($_GET['job_title']) ? $_GET['job_title'] : ''; ?>" placeholder='What are you looking for?'>
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
                              <option value="<?= $category['id']; ?>" <?= (isset($_GET['category']) && $_GET['category'] == $category['id']) ? 'selected' : '' ?>> <?= $category['name']; ?> </option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <div class="field">
                          <i class="fas fa-map-marker-alt"></i>
                          <select name="city" class="form-control js-example-basic-single">
                            <option value="">Select Location</option>
                            <?php foreach ($cities as $city) : ?>
                              <option value="<?= $city['id']; ?>" <?= (isset($_GET['city']) && $_GET['city'] == $city['id']) ? 'selected' : '' ?>> <?= $city['name']; ?> </option>
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
                              <option value="<?= $i; ?>" <?= (isset($_GET['expected_salary']) && $_GET['expected_salary'] == $i) ? 'selected' : '' ?>> <?= $i; ?> </option>
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
                              <option value="<?= $education['id']; ?>" <?= (isset($_GET['education_level']) && $_GET['education_level'] == $education['id']) ? 'selected' : '' ?>> <?= $education['type']; ?> </option>
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
                            <option value="0-1" <?= (isset($_GET['experience']) && $_GET['experience'] == '0-1') ? 'selected' : '' ?>>0-1 Year</option>
                            <option value="1-2" <?= (isset($_GET['experience']) && $_GET['experience'] == '1-2') ? 'selected' : '' ?>>1-2 Years</option>
                            <option value="2-5" <?= (isset($_GET['experience']) && $_GET['experience'] == '2-5') ? 'selected' : '' ?>>2-5 Years</option>
                            <option value="5-10" <?= (isset($_GET['experience']) && $_GET['experience'] == '5-10') ? 'selected' : '' ?>>5-10 Years</option>
                            <option value="10-15" <?= (isset($_GET['experience']) && $_GET['experience'] == '10-15') ? 'selected' : '' ?>>10-15 Years</option>
                            <option value="15+" <?= (isset($_GET['experience']) && $_GET['experience'] == '15+') ? 'selected' : '' ?>>15+ Years</option>
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
                      <a class="btn btn-third" href="<?= base_url('employer/candidates_shortlisted/' . $row['id']) ?>" onclick="userdetails(<?= $row['id'] ?>)" data-toggle="modal" data-target="#modal-large" data-message="<?= $row['email'] ?>">User Profile</a>
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

<!-- Begin User Modal -->
<div id="modal-large" class="modal fade">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">User Details</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">close</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-shadow" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End User Modal -->

<?php include(VIEWPATH . 'employer/include/footer.php'); ?>
<script>
  $('.js-example-basic-single').select2();
</script>
<script>
    function userdetails(id){
        event.preventDefault();
        $('#modal-body').html('');
        var id = id;
        $.ajax({
            type: "GET",
            url: '<?= base_url();?>/employer/userdetails/'+id,
            cached: false,
            success: function(data) {
                $('#modal-body').html(data);
            }
        });
    }
</script>