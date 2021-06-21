<?php include(VIEWPATH.'employer/include/header.php'); ?>

<div class="content-inner">
	<div class="container-fluid">
	    <!-- Begin Page Header-->
	    <div class="row">
	        <div class="page-header">
	            <div class="d-flex align-items-center">
	                <h2 class="page-header-title">Edit Job</h2>
	                <div>
	                    <ul class="breadcrumb">
	                        <li class="breadcrumb-item"><a href="<?= base_url('employer') ?>"><i class="ti ti-home"></i></a></li>
	                        <li class="breadcrumb-item active">Edit Job</li>
	                    </ul>
	                </div>
	            </div>
	        </div>
	    </div>
	    <!-- End Page Header -->
	    <div class="row flex-row">
	        <div class="col-xl-12">
	            <!-- Form -->
	            <div class="widget has-shadow">
	                <div class="widget-header bordered no-actions d-flex align-items-center">
	                    <h4>Edit Job Info</h4>
	                </div>
	                <div class="widget-body">
	                    <form action="<?= base_url('employer/updatejob/'.$data[0]['id']); ?>" method="post" class="needs-validation" novalidate>
	                        <input type="hidden" name="employer_id" value="<?= session('employer_id') ?>">
	                        <input type="hidden" name="company_id" value="<?= session('employer_id') ?>">
	                        <div class="form-group row d-flex align-items-center mb-5">
	                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Job Title *</label>
	                            <div class="col-lg-5">
	                                <div class="input-group">
	                                    <input type="text" name="job_title" class="form-control" placeholder="Enter your job title" value="<?= set_value('job_title',$data[0]['title']) ?>" required>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="form-group row d-flex align-items-center mb-5">
	                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Job Type *</label>
	                            <div class="col-lg-5">
	                                <div class="select">
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
	                                    <div class="invalid-feedback">
	                                        Please select an option
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="form-group row d-flex align-items-center mb-5">
	                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Job Category *</label>
	                            <div class="col-lg-5">
	                                <div class="select">
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
	                                    <div class="invalid-feedback">
	                                        Please select an option
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="form-group row d-flex align-items-center mb-5">
	                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Industry *</label>
	                            <div class="col-lg-5">
	                                <div class="select">
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
	                                    <div class="invalid-feedback">
	                                        Please select an option
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Position Avaliable *</label>
                                <div class="col-lg-5">
                                    <div class="select">
                                        <select name="total_positions" class="custom-select form-control" required>
                                            <?php for ($i = 1; $i < 30; $i++) : ?>
                                                <?php if ($data[0]['total_positions'] == $i) : ?>
                                                    <option value="<?= $i; ?>" selected><?= $i; ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $i; ?>"><?= $i; ?></option>
                                            <?php endif;
                                        	endfor; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select an option
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Working Experience *</label>
                                <?php
                                        $exp = explode('-', $data[0]['experience']);
                                        $min = $exp[0];
                                        $max = $exp[1];
                                        ?>
                                <div class="col-lg-5">
                                	<div class="select">
                                        <?php
	                                        $options = get_experience_list('Minimum');
	                                        echo form_dropdown('min_experience', $options, $min, 'class="form-control"');
	                                        ?>
                                    </div>
                                    <div class="select">
                                        <?php
                                            $options = get_experience_list('Maximum');
                                            echo form_dropdown('max_experience', $options, $max, 'class="form-control"');
                                            ?>
                                    </div>
                                </div>
                            </div>
	                        <div class="form-group row d-flex align-items-center mb-5">
	                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Salary *</label>
	                            <div class="col-lg-5">
	                                <input type="number" name="min_salary" class="form-control" placeholder="Minimum Salary" value="<?= set_value('min_salary',$data[0]['min_salary']) ?>" required>
	                                <div class="invalid-feedback">
	                                    Please enter minimum salary
	                                </div>
	                                <input type="number" name="max_salary" class="form-control" placeholder="Maximum Salary" value="<?= set_value('max_salary',$data[0]['max_salary']) ?>" required>
	                                <div class="invalid-feedback">
	                                    Please enter maximum salary
	                                </div>
	                            </div>
	                        </div>
	                        <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Salary Period *</label>
                                <div class="col-lg-5">
                                    <div class="select">
                                        <select name="salary_period" class="custom-select form-control" required>
                                            <option value="Hourly" <?= ($data[0]['salary_period'] == 'Hourly') ? 'selected' : '' ?>>Hourly</option>
                                            <option value="Weekly" <?= ($data[0]['salary_period'] == 'Weekly') ? 'selected' : '' ?>>Weekly</option>
                                            <option value="Monthly" <?= ($data[0]['salary_period'] == 'Monthly') ? 'selected' : '' ?>>Monthly</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select an option
                                        </div>
                                    </div>
                                </div>
                            </div>
	                        <div class="form-group row d-flex align-items-center mb-5">
	                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Skills *</label>
	                            <div class="col-lg-5">
	                                <input type="text" name="skills" class="form-control" value="<?= set_value('skills',$data[0]['skills']); ?>" placeholder="Skills" required>
	                                <div class="invalid-feedback">
	                                    Please enter skills
	                                </div>
	                            </div>
	                        </div>
	                        <div class="form-group row d-flex align-items-center mb-5">
	                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Job Description *</label>
	                            <div class="col-lg-5">
	                                <textarea name="description" class="form-control" placeholder="Type your message here ..." required><?= $data[0]['description']; ?></textarea>
	                                <div class="invalid-feedback">
	                                    Please enter a custom message
	                                </div>
	                            </div>
	                        </div>
	                        <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Gender Requirement *</label>
                                <div class="col-lg-5">
                                    <div class="select">
                                        <select name="gender" class="custom-select form-control" required>
                                            <option value="No Prefrence" <?= ($data[0]['gender'] == 'No Prefrence') ? 'selected' : '' ?>>No Prefrence</option>
                                            <option value="Male" <?= ($data[0]['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                                            <option value="Female" <?= ($data[0]['gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select an option
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
	                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Employment Type *</label>
	                            <div class="col-lg-5">
	                                <div class="select">
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
	                                    <div class="invalid-feedback">
	                                        Please select an option
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="form-group row d-flex align-items-center mb-5">
	                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Education *</label>
	                            <div class="col-lg-5">
	                                <div class="select">
	                                    <select name="education" class="custom-select form-control" required>
	                                        <option value="">Select Education Type</option>
	                                        <?php foreach ($educations as $row) : ?>
	                                        	<?php if ($data[0]['education'] == $row['id']) : ?>						<option value="<?= $row['id']; ?>" selected> <?= $row['type']; ?></option>
	                                        <?php else: ?>
	                                        	<option value="<?= $row['id']; ?>"> <?= $row['type']; ?></option>
											<?php endif;
											endforeach; ?>
	                                    </select>
	                                    <div class="invalid-feedback">
	                                        Please select an option
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="form-group row d-flex align-items-center mb-5">
	                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Country *</label>
	                            <div class="col-lg-5">
	                                <div class="select">
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
	                                    <div class="invalid-feedback">
	                                        Please select an option
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="form-group row d-flex align-items-center mb-5">
	                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">State *</label>
	                            <div class="col-lg-5">
	                                <div class="select">
	                            	<?php
		                                $states = get_country_states($data[0]['country']);
	                                        $options = array('' => 'Select State') + array_column($states, 'name', 'id');
	                                        echo form_dropdown('state', $options, $data[0]['state'], 'class="form-control select2bs4 state" required');
	                                    ?>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="form-group row d-flex align-items-center mb-5">
	                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">City *</label>
	                            <div class="col-lg-5">
	                                <div class="select">
	                                    <?php
	                                        $cities = get_state_cities($data[0]['state']);
	                                        $options = array('' => 'Select City') + array_column($cities, 'name', 'id');
	                                        echo form_dropdown('city', $options, $data[0]['city'], 'class="form-control select2bs4 city" required');
                                        ?>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="form-group row d-flex align-items-center mb-5">
	                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Location *</label>
	                            <div class="col-lg-5">
	                                <div class="input-group">
	                                    <input type="text" name="location" value="<?= set_value('location',$data[0]['location']); ?>" class="form-control" placeholder="Enter your location" required>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="text-right">
	                            <button type="submit" class="btn btn-shadow">Update Job</button>
	                        </div>
	                    </form>
	                </div>
	            </div>
	            <!-- End Form -->
	        </div>
	    </div>
	    <!-- End Row -->
	</div>
	<!-- End Container -->
	
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