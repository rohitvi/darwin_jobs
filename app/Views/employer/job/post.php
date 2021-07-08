<?php include(VIEWPATH.'employer/include/header.php'); ?>
<div class='header_inner '>
  <div class="header_btm">
    <h2>Post Job</h2>
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
        <h5>Post job</h5>
        <a class="btn btn-primary mypbtn" href="<?= base_url('employer/cmp_info_update') ?>">Company profile</a>
      </div>
      <div class="section-divider">
      </div>
      <form action="<?= base_url('employer/post'); ?>" method="post">
        <input type="hidden" name="employer_id" value="<?= session('employer_id') ?>">
	    <input type="hidden" name="company_id" value="<?= session('employer_id') ?>">
        <div class="big_form_group">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group ">
                <label>Job Title *</label>
                <input type="text" name="job_title" class="form-control" placeholder="Enter your job title" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>job Type *</label>
                <select name="job_type" class="custom-select form-control" required>
                    <option value="">Select Job Type</option>
                    <?php
                        foreach($job_type as $key => $value) { ?>
                          <option value="<?= $value['id'] ?>"><?= $value['type'] ?></option>
                    <?php
                    } ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Job Category *</label>
                <select name="category" class="custom-select form-control" required>
                    <option value="">Select Job Category</option>
                    <?php
                        foreach($job_category as $key => $value) { ?>
                          <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                    <?php
                    } ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Industry *</label>
                <select name="industry" class="custom-select form-control" required>
	                <option value="">Select Industry</option>
	                <?php
	                    foreach($industry as $key => $value) { ?>
	                      <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
	                <?php
	                } ?>
	            </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Position Avaliable *</label>
                <select name="total_positions" class="custom-select form-control" required>
                    <?php for ($i = 1; $i < 30; $i++) : ?>
						<option value="<?= $i; ?>"><?= $i; ?></option>
					<?php endfor; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Working Experience *</label>
                <select name="min_experience" class="custom-select form-control" required>
	                <?php
	                    foreach(get_experience_list('Minimum') as $key => $value) { ?>
	                      <option value="<?= $key ?>"><?= $value ?></option>
	                <?php
	                } ?>
	            </select>
	            <select name="max_experience" class="custom-select form-control" required>
                    <?php
                        foreach(get_experience_list('Maximum') as $key => $value) { ?>
                          <option value="<?= $key ?>"><?= $value ?></option>
                    <?php
                    } ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Salary *</label>
                <input type="number" name="min_salary" class="form-control" placeholder="Minimum Salary" required>
                <input type="number" name="max_salary" class="form-control" placeholder="Maximum Salary" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Salary Period *</label>
                <select name="salary_period" class="custom-select form-control" required>
	                <option value="Hourly">Hourly</option>
	                <option value="Weekly">Weekly</option>
	                <option value="Monthly">Monthly</option>
	            </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Skills *</label>
                <input type="text" name="skills" class="form-control" placeholder="Skills" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group ">
                <label>Job Description *</label>
                <textarea name="description" class="form-control" placeholder="Type your message here ..." required></textarea>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group ">
                <label>Gender Requirement *</label>
                <select name="gender" class="custom-select form-control" required>
                    <option value="No Prefrence">No Prefrence</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group ">
                <label>Employment Type *</label>
                <select name="employment_type" class="custom-select form-control" required>
	                <option value="">Select Employment Type</option>
	                <?php foreach ($employment as $key => $value) : ?>
	                     <option value="<?= $value['id'] ?>"><?= $value['type'] ?></option><?php endforeach; ?>
	            </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group ">
                <label>Education *</label>
                <select name="education" class="custom-select form-control" required>
                    <option value="">Select Education Type</option>
                    <?php foreach ($educations as $row) : ?>
						<option value="<?= $row['id']; ?>"> <?= $row['type']; ?></option>
					<?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group ">
                <label>Country *</label>
                <select name="country" id="country" class="custom-select form-control" required>
                    <option value="">Select Country</option>
                    <?php foreach ($countries as $row) : ?>
						<option value="<?= $row['id']; ?>"> <?= $row['name']; ?></option>
					<?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group ">
                <label>State *</label>
                <select name="state" class="custom-select form-control" id="state" required>
                    <option value="">Select State</option>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group ">
                <label>City *</label>
                <select name="city" class="custom-select form-control" id="city" required>
                    <option value="">Select City</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-12">
              <div class="form-group ">
                <label>Location *</label>
                <input type="text" name="location" class="form-control" placeholder="Enter your location" required>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </div>

      </form>
    </div>
  </div>


</div>
</div>
</div>
</div>
</main>
	
<?php include(VIEWPATH.'employer/include/footer.php'); ?>

<script type="text/javascript">
	$(document).ready(function(){
      $('#country').on('change',function(){
        var country_id = this.value;
        $.ajax({
          url: '<?= base_url('employer/getstates'); ?>',
          type: 'POST',
          data: {
            country_id: country_id
          },
          cached: false,
          success: function(result){
            var json = JSON.parse(result);
            var $state = $('#state');
            for (var i = 0; i < json.length; i++) {
              $state.append('<option value=' + json[i].id + '>' + json[i].name + '</option>')
            }
          }
        });
      });
      $('#state').on('change',function(){
        var state_id = this.value;
        $.ajax({
          url: '<?= base_url('employer/getcities'); ?>',
          type: 'POST',
          data: {state_id:state_id},
          cached: false,
          success: function(result){
            var json = JSON.parse(result);
            var $cities = $('#city');
            for (var i = 0; i < json.length; i++) {
              $cities.append('<option value=' + json[i].id + '>' + json[i].name + '</option>');
            }
          }
        });
      });
    });
</script>