<?php include(VIEWPATH . 'admin/include/header.php'); ?>

<<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Add Job</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="<?= base_url('admin/view_jobs'); ?>">List Job</a></li>
							<li class="breadcrumb-item active"><a>Add Job</a></li>
						</ol>
					</div>
				</div>
			</div><!-- /.container-fluid -->
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="card card-primary">
							<div class="card-header">
								<h3 class="card-title">Add Job</h3>
							</div>
							<!-- /.card-header -->
							<!-- form start -->
							<form action="<?= base_url('admin/post'); ?>" id="post_job" method="post">
								<div class="card-body">
									<div class="form-group">
										<label>Company *</label>
										<select name="employer_id" class="form-control select2bs4" required>
											<option value="">Select Company</option>
											<?php foreach ($companies as $company) : ?>
												<option value="<?= $company['id']; ?>"><?= $company['company_name']; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="form-group">
										<label>Job Title*</label>
										<input type="text" name="job_title" class="form-control" required>
									</div>
									<div class="form-group">
										<label>Job Type*</label>
										<?php
										$types = get_job_type_list();
										$options = array('' => 'Select Job Type') + array_column($types, 'type', 'id');
										echo form_dropdown('job_type', $options, '', 'class="form-control select2bs4" required')
										?>
									</div>
									<div class="form-group">
										<label>Job Category*</label>
										<select class="form-control select2bs4" name="category" required>
											<option value="">Select Category</option>
											<?php foreach ($categories as $category) : ?>
												<option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="form-group">
										<label>Job Indusry*</label>
										<select class="form-control select2bs4" name="industry" required>
											<option value="">Select Indusry</option>
											<?php foreach ($industries as $industry) : ?>
												<option value="<?= $industry['id'] ?>"><?= $industry['name'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="form-group">
										<label>Position Available *</label>
										<select name="total_positions" class="form-control select2bs4" required>
											<?php for ($i = 1; $i < 30; $i++) : ?>
												<option value="<?= $i; ?>"><?= $i; ?></option>
											<?php endfor; ?>
										</select>
									</div>
									<div class="form-group">
										<label>Working Experience *</label>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<?php
													$options = get_experience_list('Minimum');
													echo form_dropdown('min_experience', $options, '', 'class="form-control" required');
													?>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<?php
													$options = get_experience_list('Maximum');
													echo form_dropdown('max_experience', $options, '', 'class="form-control" required');
													?>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label>Salary *</label>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<input type="number" name="min_salary" class="form-control" placeholder="Minimum" required>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<input type="number" name="max_salary" class="form-control" placeholder="Maximum" required>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label>Salary Period *</label>
										<select name="salary_period" class="form-control" required>
											<option value="Hourly">Hourly</option>
											<option value="Weekly">Weekly</option>
											<option value="Monthly">Monthly</option>
										</select>
									</div>
									<div class="form-group">
										<label> Skills*</label>
										<input type="text" name="skills" class="form-control tagin" placeholder="e.g. job title, responsibilites" required>
									</div>
									<div class="form-group">
										<label>Job Description*</label>
										<textarea name="description" class="textarea form-control" id="exampleFormControlTextarea1" rows="5" required></textarea>
									</div>
									<div class="form-group">
										<label>Gender Requirement*</label>
										<select name="gender" class="form-control" required>
											<option value="Male">Male</option>
											<option value="Female">Female</option>
											<option value="No Preference" selected="">No Preference</option>
										</select>
									</div>
									<div class="form-group">
										<label>Employment Type*</label>
										<?php
										$types = get_employment_type_list();
										$options = array('' => 'Select Employement Type') + array_column($types, 'type', 'id');
										echo form_dropdown('employment_type', $options, '', 'class="form-control" required');
										?>
									</div>
									<div class="form-group">
										<label>Education*</label>
										<select class="form-control select2bs4" name="education" required>
											<option value="">Select Education</option>
											<?php foreach ($educations as $row) : ?>
												<option value="<?= $row['id']; ?>"> <?= $row['type']; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="form-group">
										<label>Country *</label>
										<select class="country form-control select2bs4" name="country" required>
											<option>Select Country</option>
											<?php foreach ($countries as $country) : ?>
												<option value="<?= $country['id'] ?>"><?= $country['name'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="form-group">
										<label>State *</label>
										<select class="form-control state select2bs4" name="state" required>
											<option>Select State</option>
										</select>
									</div>
									<div class="form-group">
										<label>City *</label>
										<select class="form-control city select2bs4" name="city" required>
											<option>Select City</option>
										</select>
									</div>
									<div class="form-group">
										<label>Location*</label>
										<input type="text" name="location" class="form-control" placeholder="Type Address" required>
									</div>
								</div>

								<div class="card-footer">
									<button type="submit" name="post_job" class="btn btn-primary">Submit</button>
								</div>
						</div>
						<!-- /.card-body -->
						</form>
					</div>
					<!-- /.card -->
				</div>
			</div>
			<!-- /.row -->
	</div><!-- /.container-fluid -->
	</section>
	<!-- Company section -->

	<!-- /.content -->
	</div>
	<?php include(VIEWPATH . 'admin/include/footer.php'); ?>
	<script type="text/javascript">
	    for (const el of document.querySelectorAll('.tagin')) {
			tagin(el)
		}
		var base_url = '<?= base_url(); ?>';
		var csfr_token_name = '<?= csrf_token() ?>';
		var csfr_token_value = '<?= csrf_hash() ?>';

		//-------------------------------------------------------------------
		// Country State & City Change
		$(document).on('change', '.country', function() {
			var data = {
				country: this.value,
			}
			data[csfr_token_name] = csfr_token_value;

			$.ajax({
				type: "POST",
				url: "<?= base_url('home/get_country_states') ?>",
				data: data,
				dataType: "json",
				success: function(obj) {
					$('.state').html(obj.msg);
				},

			});
		});

		$(document).on('change', '.state', function() {
			var data = {
				state: this.value,
			}
			data[csfr_token_name] = csfr_token_value;
			$.ajax({
				type: "POST",
				url: "<?= base_url('home/get_state_cities') ?>",
				data: data,
				dataType: "json",
				success: function(obj) {
					$('.city').html(obj.msg);
				},
			});

		});
	</script>