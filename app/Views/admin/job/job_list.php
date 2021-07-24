<?php include(VIEWPATH . 'admin/include/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Manage Jobs</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard'); ?>">Dashboard</a></li>
							<li class="breadcrumb-item active"><a>Manage Jobs</a></li>
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
						<div class="card card-primary">
							<div class="card-header">
								<h3 class="card-title">Advance Search</h3>
							</div>
							<!-- /.card-header -->
							<!-- form start -->
							<form role="form" id="job_search">
								<div class="card-body">
									<div class="row">
										<div class="col-md-2">
											<label>Industry:</label>
											<select onchange="job_filter()" name="job_search_industry" class="form-control select2bs4">
												<option value=""> --Select--</option>
												<?php foreach ($industries as $industry) : ?>
													<option value="<?php echo $industry['id']; ?>"> <?php echo $industry['name']; ?> </option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="col-md-2">
											<label>Category:</label>
											<select onchange="job_filter()" name="job_search_category" class="form-control select2bs4">
												<option value=""> --Select--</option>
												<?php foreach ($categories as $category) : ?>
													<option value="<?php echo $category['id']; ?>"> <?php echo $category['name']; ?> </option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="col-md-2">
											<label>Location:</label>
											<select onchange="job_filter()" name="job_search_location" class="form-control select2bs4">
												<option value=""> --Select--</option>
												<?php foreach ($countries as $location) : ?>
													<option value="<?php echo $location['id']; ?>"> <?php echo $location['name']; ?> </option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="col-md-2">
											<label>Date From:</label>
											<input name="job_search_from" type="date" class="form-control form-control-inline input-medium" />
										</div>
										<div class="col-md-2">
											<label>Date To:</label>
											<input name="job_search_to" type="date" class="form-control form-control-inline input-medium" />
										</div>
										<div class="col-md-2 text-right">
											<button type="button" style="margin-top:20px;" onclick="job_filter()" class="btn btn-info">Submit</button>
											<a href="<?= base_url('admin/list_job'); ?>" class="btn btn-danger" style="margin-top:20px;">
												Reset
											</a>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Manage Jobs</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
								<table id="example1" class="table mv_datatable table-bordered table-striped">
									<thead>
										<tr>
											<th> #</th>
											<th>Title</th>
											<th>Applicants</th>
											<th>Industry</th>
											<th>Location</th>
											<th>Date</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th> #</th>
											<th>Title</th>
											<th>Applicants</th>
											<th>Industry</th>
											<th>Location</th>
											<th>Date</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</tfoot>
								</table>
							</div>
							<!-- /.card-body -->
						</div>
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
	<script>
		//---------------------------------------------------
		var table = $('.mv_datatable').DataTable({
			"processing": true,
			"serverSide": true,
			"pageLength": 25,
			"bDestroy": true,
			"ajax": "<?= base_url('admin/datatable_json') ?>",
			"order": [
				[5, 'desc']
			],
			"columnDefs": [{
					"targets": 0,
					"name": "id",
					'searchable': false,
					'orderable': false
				},
				{
					"targets": 1,
					"name": "title",
					'searchable': true,
					'orderable': true,
					'width': '250px'
				},
				{
					"targets": 2,
					"name": "Applicants",
					'searchable': false,
					'orderable': true
				},
				{
					"targets": 3,
					"name": "industry",
					'searchable': true,
					'orderable': true
				},
				{
					"targets": 4,
					"name": "country",
					'searchable': false,
					'orderable': false
				},
				{
					"targets": 5,
					"name": "created_date",
					'searchable': true,
					'orderable': true
				},
				{
					"targets": 6,
					"name": "is_status",
					'searchable': true,
					'orderable': true
				},
				{
					"targets": 7,
					"name": "action",
					'searchable': false,
					'orderable': false,
					'width': '130px'
				}
			]
		});

		//---------------------------------------------------
		function job_filter() {
			$.post('<?= base_url('admin/search') ?>', $('#job_search').serialize(), function() {
				table.ajax.reload(null, false);
			});
		}
		job_filter();
		//----------------------------------------------------------------				
	</script>
	<script>
		$('li#jobs').addClass('active');
	</script>
	</body>

	</html>