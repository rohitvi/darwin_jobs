<?php include(VIEWPATH.'employer/include/header.php'); ?>

<div class='header_inner '>
  <div class="header_btm">
    <h2>Edit Job</h2>
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
        <h5>Update My Profile</h5>
        <a class="btn btn-primary mypbtn" href="<?= base_url('employer/cmp_info_update') ?>">Company profile</a>
      </div>
      <div class="section-divider">
      </div>
      <form action="<?= base_url('employer/updatejob/'.$data[0]['id']); ?>" method="post">
        <input type="hidden" name="_method" value="PUT" />
      	<input type="hidden" name="employer_id" value="<?= session('employer_id') ?>">
	    <input type="hidden" name="company_id" value="<?= session('employer_id') ?>">
        <div class="big_form_group">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group ">
                <label>Job Title *</label>
                <input type="text" name="job_title" class="form-control" placeholder="Enter your job title" value="<?= set_value('job_title',$data[0]['title']) ?>" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Job Type *</label>
               	<select name="job_type" class="custom-select form-control" required>
                    <option>Select Job Type</option>
                    	<?php foreach ($job_type as $value) : 
                    		if ($data[0]['job_type'] == $value['id']) : ?>
                        		<option value="<?= $value['id']; ?>" selected> <?= $value['type']; ?> </option>
                        	<?php else : ?>
                            	<option value="<?= $value['id']; ?>"> <?= $value['type']; ?> </option>
                    		<?php endif;
                    	endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Job Category *</label>
                <select name="category" class="custom-select form-control" required>
                    <option value="">Select Job Category</option>
                    	<?php foreach ($job_category as $category) : ?>
                        	<?php if ($data[0]['category'] == $category['id']) : ?>
                        		<option value="<?= $category['id']; ?>" selected> <?= $category['name']; ?> </option>
                        	<?php else : ?>
                            	<option value="<?= $category['id']; ?>"> <?= $category['name']; ?> </option>
                    		<?php endif;
                    	endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Industry *</label>
                <select name="industry" class="custom-select form-control" required>
                    <option value="">Select Industry</option>
                    <?php foreach ($industry as $value) : ?>
                        	<?php if ($data[0]['industry'] == $value['id']) : ?>
                        		<option value="<?= $value['id']; ?>" selected> <?= $value['name']; ?> </option>
                        	<?php else : ?>
                            	<option value="<?= $value['id']; ?>"> <?= $value['name']; ?> </option>
                    		<?php endif;
                    	endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Position Avaliable *</label>
                <select name="total_positions" class="custom-select form-control" required>
                    <?php for ($i = 1; $i < 30; $i++) : ?>
                        <?php if ($data[0]['total_positions'] == $i) : ?>
                            <option value="<?= $i; ?>" selected><?= $i; ?></option>
                        <?php else : ?>
                            <option value="<?= $i; ?>"><?= $i; ?></option>
                    <?php endif;
                	endfor; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Experience *</label>
                <?php
	                $exp = explode('-', $data[0]['experience']);
	                $min = $exp[0];
	                $max = $exp[1];
	            ?>
	            <?php
	                $options = get_experience_list('Minimum');
	                echo form_dropdown('min_experience', $options, $min, 'class="form-control"');
	            ?>
	            <?php
                    $options = get_experience_list('Maximum');
                    echo form_dropdown('max_experience', $options, $max, 'class="form-control"');
                ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Salary *</label>
                <input type="number" name="min_salary" class="form-control" placeholder="Minimum Salary" value="<?= set_value('min_salary',$data[0]['min_salary']) ?>" >
                <input type="number" name="max_salary" class="form-control" placeholder="Maximum Salary" value="<?= set_value('max_salary',$data[0]['max_salary']) ?>" >
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Salary Period *</label>
                <select name="salary_period" class="custom-select form-control" required>
                    <option value="Hourly" <?= ($data[0]['salary_period'] == 'Hourly') ? 'selected' : '' ?>>Hourly</option>
                    <option value="Weekly" <?= ($data[0]['salary_period'] == 'Weekly') ? 'selected' : '' ?>>Weekly</option>
                    <option value="Monthly" <?= ($data[0]['salary_period'] == 'Monthly') ? 'selected' : '' ?>>Monthly</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Skill *</label>
                <input type="text" name="skills" class="form-control" value="<?= set_value('skills',$data[0]['skills']); ?>" placeholder="Skills" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Job Description *</label>
                <input name="description" class="form-control" placeholder="Type your message here ..." value="<?= $data[0]['description']; ?>" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Gender Prefrence *</label>
                <select name="gender" class="custom-select form-control" required>
                    <option value="No Prefrence" <?= ($data[0]['gender'] == 'No Prefrence') ? 'selected' : '' ?>>No Prefrence</option>
                    <option value="Male" <?= ($data[0]['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= ($data[0]['gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Employment Type *</label>
                <select name="employment_type" class="custom-select form-control" required>
	                <option value="">Select Employment Type</option>
	                <?php foreach ($employment as $key => $value) : ?>
	                	<?php if ($data[0]['employment_type'] == $value['id']) : ?>
	                     <option value="<?= $value['id'] ?>" selected><?= $value['type'] ?></option>
	                 <?php else :?>
	                 	<option value="<?= $value['id'] ?>"><?= $value['type'] ?></option>
	                 <?php endif;
	             endforeach; ?>
	            </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Education Type *</label>
                <select name="education" class="custom-select form-control" required>
                    <option value="">Select Education Type</option>
                    <?php foreach ($educations as $row) : ?>
                    	<?php if ($data[0]['education'] == $row['id']) : ?>						<option value="<?= $row['id']; ?>" selected> <?= $row['type']; ?></option>
                    <?php else: ?>
                    	<option value="<?= $row['id']; ?>"> <?= $row['type']; ?></option>
					<?php endif;
					endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Country *</label>
                <select name="country" id="country" class="custom-select form-control" required>
                    <option value="">Select Country</option>
                    <?php foreach ($countries as $row) : 
                    	if ($data[0]['country'] == $row['id']) : ?>
						<option value="<?= $row['id']; ?>" selected> <?= $row['name']; ?></option>
					<?php else : ?>
						<option value="<?= $row['id']; ?>"> <?= $row['name']; ?></option>
					<?php endif;
				endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>State *</label>
                <?php
                    $states = get_country_states($data[0]['country']);
                        $options = array('' => 'Select State') + array_column($states, 'name', 'id');
                        echo form_dropdown('state', $options, $data[0]['state'], 'class="form-control select2bs4 state" required');
                    ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>City *</label>
                <?php
                    $cities = get_state_cities($data[0]['state']);
                    $options = array('' => 'Select City') + array_column($cities, 'name', 'id');
                    echo form_dropdown('city', $options, $data[0]['city'], 'class="form-control select2bs4 city" required');
                ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Location *</label>
                <input type="text" name="location" value="<?= set_value('location',$data[0]['location']); ?>" class="form-control" placeholder="Enter your location" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Is Featured *</label>
                <select name="is_featured" class="custom-select form-control">
                  <option value="">Select Job Featured</option>
	                <option value="yes" <?= ($data[0]['is_featured'] == 'yes') ? 'selected' : '' ?>>Yes</option>
	                <option value="no" <?= ($data[0]['is_featured'] == 'no') ? 'selected' : '' ?>>No</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Status *</label>
                <select name="is_status" class="custom-select form-control">
                  <option value="">Select Job Status</option>
	                <option value="active" <?= ($data[0]['is_status'] == 'active') ? 'selected' : '' ?>>Active</option>
	                <option value="inactive" <?= ($data[0]['is_status'] == 'inactive') ? 'selected' : '' ?>>InActive</option>
	                <option value="pending" <?= ($data[0]['is_status'] == 'pending') ? 'selected' : '' ?>>Pending</option>
	                <option value="blocked" <?= ($data[0]['is_status'] == 'blocked') ? 'selected' : '' ?>>Blocked</option>
                </select>
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
	var csfr_token_name = '<?= csrf_token() ?>';
    var csfr_token_value = '<?= csrf_hash() ?>';
	$(document).ready(function(){
      $('#country').on('change',function(){
        var data = {country: this.value,}
        data[csfr_token_name] = csfr_token_value;
        $.ajax({
          url: '<?= base_url('home/get_country_states'); ?>',
          type: 'POST',
          data: data,
          dataType: 'json',
          cached: false,
          success: function(obj){
            $('.state').html(obj.msg);
          }
        });
      });
      $('.state').on('change',function(){
        var data = {state: this.value,}
        data[csfr_token_name] = csfr_token_value;
        $.ajax({
          url: '<?= base_url('home/get_state_cities'); ?>',
          type: 'POST',
          data: data,
          dataType: 'json',
          cached: false,
          success: function(obj){
            $('.city').html(obj.msg);
          }
        });
      });
    });
</script>