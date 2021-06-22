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
	                                    <th>Name</th>
	                                    <th>Industry</th>
	                                    <th>Location</th>
	                                    <th>Email</th>
	                                    <th>Actions</th>
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
