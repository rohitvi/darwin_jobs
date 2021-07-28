<?php include(VIEWPATH.'employer/include/header.php'); ?>
<style>
.ck-editor__editable_inline {
    min-height: 200px;
}
.ck.ck-editor__main>.ck-editor__editable:not(.ck-focused){
    border: 1px solid #ff6158;
}
</style>
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
        <input type="hidden" name="employer_id" value="<?= session('employer_id') ?>" required>
	    <input type="hidden" name="company_id" value="<?= session('employer_id') ?>" required>
        <div class="big_form_group">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group ">
                <label>Job Title *</label>
                <input type="text" name="job_title" class="form-control" placeholder="Enter your job title" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>job Type *</label>
                <select name="job_type" class=" form-control js-example-basic-single" required>
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
                <select name="category" class="form-control js-example-basic-single" required>
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
                <select name="industry" class="js-example-basic-single form-control" required>
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
                <select name="total_positions" class="js-example-basic-single form-control" required>
                    <?php for ($i = 1; $i < 30; $i++) : ?>
						<option value="<?= $i; ?>"><?= $i; ?></option>
					<?php endfor; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Working Experience *</label>
                <div class="row">
                    <div class="col-md-6">
                        <select name="min_experience" class="js-example-basic-single form-control" required>
                          <?php
                          foreach(get_experience_list('Minimum') as $key => $value) { ?>
                            <option value="<?= $key ?>"><?= $value ?></option>
                          <?php
                          } ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                    <select name="max_experience" class="js-example-basic-single form-control" required>
                    <?php
                        foreach(get_experience_list('Maximum') as $key => $value) { ?>
                          <option value="<?= $key ?>"><?= $value ?></option>
                    <?php
                    } ?>
                </select>
                    </div>
                </div>
                
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Salary *</label>
                <div class="row">
                    <div class="col-md-6">
                      <input type="text" name="min_salary" class="form-control" placeholder="Minimum Salary" required>
                    </div>
                    <div class="col-md-6">
                      <input type="text" name="max_salary" class="form-control" placeholder="Maximum Salary" required>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Salary Period *</label>
                <select name="salary_period" class="js-example-basic-single form-control" required>
	                <option value="Hourly">Hourly</option>
	                <option value="Weekly">Weekly</option>
	                <option value="Monthly">Monthly</option>
	            </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group ">
                <label>Skills *</label>
                <input type="text" name="skills" class="form-control tagin" placeholder="Skills" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Job Description *</label>
                <textarea name="description" id="description" class="textarea" placeholder="Type your message here ..." required></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Gender Requirement *</label>
                <select name="gender" class="js-example-basic-single form-control" required>
                    <option value="No Prefrence">No Prefrence</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Employment Type *</label>
                <select name="employment_type" class="js-example-basic-single form-control" required>
	                <option value="">Select Employment Type</option>
	                <?php foreach ($employment as $key => $value) : ?>
	                     <option value="<?= $value['id'] ?>"><?= $value['type'] ?></option><?php endforeach; ?>
	            </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Education *</label>
                <select name="education" class="js-example-basic-single form-control" required>
                    <option value="">Select Education Type</option>
                    <?php foreach ($educations as $row) : ?>
						<option value="<?= $row['id']; ?>"> <?= $row['type']; ?></option>
					<?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Country *</label>
                <select name="country" id="country" class="js-example-basic-single form-control" required>
                    <option value="">Select Country</option>
                    <?php foreach ($countries as $row) : ?>
						<option value="<?= $row['id']; ?>"> <?= $row['name']; ?></option>
					<?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>State *</label>
                <select name="state" class="js-example-basic-single form-control" id="state" required>
                    <option value="">Select State</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                  <label>City *</label>
                  <select name="city" class="js-example-basic-single form-control" id="city" required>
                      <option value="">Select City</option>
                  </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group ">
                <label>Location *</label>
                <input type="text" name="location" class="form-control" placeholder="Enter your location" required>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group ">
                <label>Is Featured *</label>
                <select name="is_featured" class="js-example-basic-single form-control" required>
                  <option value="">Select Job Featured</option>
	                <option value="yes">Yes</option>
	                <option value="no">No</option>
                </select>
              </div>
            </div>
          </div>

          </div>
        </div>
        <div class="col-md-12 text-right">
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Post</button>
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
ClassicEditor.create( document.querySelector('#description'))
  .then( editor => {
          // console.log( editor );
  } )
  .catch( error => {
          // console.error( error );
  } );

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

  for (const el of document.querySelectorAll('.tagin')) {
    tagin(el)
  }

  $('.js-example-basic-single').select2();


</script>