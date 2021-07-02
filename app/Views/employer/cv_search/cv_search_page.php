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
              <div class="section-divider">
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

          <?php foreach ($profiles as $row) : ?>
            <div id='big_form_group' class='big_form_group'>
              <div class="row">
                <table>
                  <tr>
                    <td>
                      <h5><?= $row['firstname'] . ' ' . $row['lastname']; ?></h5>
                    </td>

                    <td> <img src="<?= base_url('public/employer/assets/img/avatar/user.png') ?>" height=60 alt=""></td>
                  </tr>
                  <tr>
                    <td><b>Job Title :&nbsp;&nbsp;&nbsp;</b><?= $row['job_title']; ?></td>
                  </tr>
                  <tr>
                    <td><b>Category :&nbsp;&nbsp;&nbsp;</b><?= get_category_name($row['category']); ?></td>
                    <td><i class="fas fa-briefcase"></i>&nbsp;&nbsp;&nbsp;<?= $row['experience']; ?> Years</td>
                  </tr>
                  <tr>
                    <td><b>Current Salary :</b>&nbsp;&nbsp;&nbsp;INR <?= $row['current_salary']; ?></td>
                    <td><i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;&nbsp;<?= get_state_name($row['state']) . ',' . get_country_name($row['country']); ?></td>
                  </tr>
                  <tr>
                    <td><b>Expected Salary :</b>&nbsp;&nbsp;&nbsp;INR <?= $row['current_salary']; ?></td>
                    <td><i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;&nbsp;<b>Nationality :&nbsp;&nbsp;&nbsp;</b><?= get_country_name($row['nationality']); ?></td>
                  </tr>
                  <tr>
                    <td><b>Skills :</b>&nbsp;&nbsp;&nbsp;<?php $skills = explode(",", $row['skills']); ?> <?php foreach ($skills as $skill) : ?><span class='tags'><a href="#"><?= $skill; ?></a></span><?php endforeach; ?></td>
                    <td><i class="fas fa-user-graduate"></i>&nbsp;&nbsp;&nbsp;<?= get_education_level($row['education_level']); ?></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><a href="<?= base_url('employer/candidates_shortlisted/' . $row['id']) ?>"><input type="submit" name="search" class="btn btn-primary btn-rounded" value="Shortlist"></a></td>
                    <td><input type="submit" name="search" class="btn btn-primary btn-rounded" value="Download CV"></td>
                  </tr>
                </table>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include(VIEWPATH . 'employer/include/footer.php'); ?>
<script>
		$('.js-example-basic-single').select2();  
</script>