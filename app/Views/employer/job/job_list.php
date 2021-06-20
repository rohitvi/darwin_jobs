<?php include(VIEWPATH.'employer/include/header.php'); ?>
	
<div class="content-inner">
	<div class="container-fluid">
	    <!-- Begin Page Header-->
	    <div class="row">
	        <div class="page-header">
	            <div class="d-flex align-items-center">
	                <h2 class="page-header-title">View Job</h2>
	                <div>
	                    <ul class="breadcrumb">
	                        <li class="breadcrumb-item"><a href="<?= base_url('employer') ?>"><i class="ti ti-home"></i></a></li>
	                        <li class="breadcrumb-item active">View Job</li>
	                    </ul>
	                </div>
	            </div>
	        </div>
	    </div>
	    <!-- End Page Header -->
	    <div class="row">
	        <div class="col-xl-12">
	            <!-- Sorting -->
	            <div class="widget has-shadow">
	                <div class="widget-header bordered no-actions d-flex align-items-center">
	                    <h4>View Job List</h4>
	                </div>
	                <div class="widget-body">
	                    <div class="table-responsive">
	                        <table id="sorting-table" class="table mb-0 mv_datatable">
	                            <thead>
	                                <tr>
	                                    <th>#</th>
	                                    <th>Title</th>
	                                    <th>Applicants</th>
	                                    <th>Industry</th>
	                                    <th>Location</th>
	                                    <th>Date</th>
	                                    <th>Status</th>
	                                    <th><span style="width:100px;">Actions</span></th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                            </tbody>
	                        </table>
	                    </div>
	                </div>
	            </div>
	            <!-- End Sorting -->
	        </div>
	    </div>
	    <!-- End Row -->
	</div>
	<!-- End Container -->

<?php include(VIEWPATH.'employer/include/footer.php'); ?>

<script>
	$(document).ready( function () {
    	$('.mv_datatable').DataTable({
			"processing": true,
			"serverSide": true,
			"pageLength": 25,
			"bDestroy": true,
			"ajax": "<?= base_url('employer/datatable_json') ?>",
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
	});
</script>