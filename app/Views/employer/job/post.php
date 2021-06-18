<?php include(VIEWPATH.'employer/include/header.php'); ?>

<div class="content-inner">
	<div class="container-fluid">
	    <!-- Begin Page Header-->
	    <div class="row">
	        <div class="page-header">
	            <div class="d-flex align-items-center">
	                <h2 class="page-header-title">Add Job</h2>
	                <div>
	                    <ul class="breadcrumb">
	                        <li class="breadcrumb-item"><a href="<?= base_url('employer') ?>"><i class="ti ti-home"></i></a></li>
	                        <li class="breadcrumb-item active">Add Job</li>
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
	                    <h4>Job Info</h4>
	                </div>
	                <div class="widget-body">
	                    <form action="<?= base_url('employer/postjob'); ?>" method="post" class="needs-validation" novalidate>
	                        <input type="hidden" name="employer_id" value="<?= session('employer_id') ?>">
	                        <input type="hidden" name="company_id" value="<?= session('employer_id') ?>">
	                        <div class="form-group row d-flex align-items-center mb-5">
	                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Job Title *</label>
	                            <div class="col-lg-5">
	                                <div class="input-group">
	                                    <input type="text" name="job_title" class="form-control" placeholder="Enter your job title" required>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="form-group row d-flex align-items-center mb-5">
	                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Job Type *</label>
	                            <div class="col-lg-5">
	                                <div class="select">
	                                    <select name="job_type" class="custom-select form-control" required>
	                                        <option value="">Select Job Type</option>
	                                        <?php
						                        foreach($job_type as $key => $value) { ?>
						                          <option value="<?= $value['id'] ?>"><?= $value['type'] ?></option>
						                    <?php
						                    } ?>
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
	                                        <?php
						                        foreach($job_category as $key => $value) { ?>
						                          <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
						                    <?php
						                    } ?>
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
	                                        <?php
						                        foreach($industry as $key => $value) { ?>
						                          <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
						                    <?php
						                    } ?>
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
												<option value="<?= $i; ?>"><?= $i; ?></option>
											<?php endfor; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select an option
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Working Experience *</label>
                                <div class="col-lg-5">
                                	<div class="select">
                                        <select name="min_experience" class="custom-select form-control" required>
                                            <?php
						                        foreach(get_experience_list('Minimum') as $key => $value) { ?>
						                          <option value="<?= $key ?>"><?= $value ?></option>
						                    <?php
						                    } ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select an option
                                        </div>
                                    </div>
                                    <div class="select">
                                        <select name="max_experience" class="custom-select form-control" required>
                                            <?php
						                        foreach(get_experience_list('Maximum') as $key => $value) { ?>
						                          <option value="<?= $key ?>"><?= $value ?></option>
						                    <?php
						                    } ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select an option
                                        </div>
                                    </div>
                                </div>
                            </div>
	                        <div class="form-group row d-flex align-items-center mb-5">
	                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Salary *</label>
	                            <div class="col-lg-5">
	                                <input type="number" name="min_salary" class="form-control" placeholder="Minimum Salary" required>
	                                <div class="invalid-feedback">
	                                    Please enter minimum salary
	                                </div>
	                                <input type="number" name="max_salary" class="form-control" placeholder="Maximum Salary" required>
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
                                            <option value="Hourly">Hourly</option>
                                            <option value="Weekly">Weekly</option>
                                            <option value="Monthly">Monthly</option>
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
	                                <input type="text" name="skills" class="form-control" placeholder="Skills" required>
	                                <div class="invalid-feedback">
	                                    Please enter skills
	                                </div>
	                            </div>
	                        </div>
	                        <div class="form-group row d-flex align-items-center mb-5">
	                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Job Description *</label>
	                            <div class="col-lg-5">
	                                <textarea name="description" class="form-control" placeholder="Type your message here ..." required></textarea>
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
                                            <option value="No Prefrence">No Prefrence</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
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
						                         <option value="<?= $value['id'] ?>"><?= $value['type'] ?></option><?php endforeach; ?>
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
												<option value="<?= $row['id']; ?>"> <?= $row['type']; ?></option>
											<?php endforeach; ?>
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
	                                        <?php foreach ($countries as $row) : ?>
												<option value="<?= $row['id']; ?>"> <?= $row['name']; ?></option>
											<?php endforeach; ?>
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
	                                    <select name="state" class="custom-select form-control" id="state" required>
	                                        <option value="">Select State</option>
	                                    </select>
	                                    <div class="invalid-feedback">
	                                        Please select an option
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="form-group row d-flex align-items-center mb-5">
	                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">City *</label>
	                            <div class="col-lg-5">
	                                <div class="select">
	                                    <select name="city" class="custom-select form-control" id="city" required>
	                                        <option value="">Select City</option>
	                                    </select>
	                                    <div class="invalid-feedback">
	                                        Please select an option
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="form-group row d-flex align-items-center mb-5">
	                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Location *</label>
	                            <div class="col-lg-5">
	                                <div class="input-group">
	                                    <input type="text" name="location" class="form-control" placeholder="Enter your location" required>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="text-right">
	                            <button type="submit" class="btn btn-shadow">Add Job</button>
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