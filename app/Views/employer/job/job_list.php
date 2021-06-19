<?php include(VIEWPATH.'employer/include/header.php'); ?>
	
<div class="content-inner">
	<div class="container-fluid">
	    <!-- Begin Page Header-->
	    <div class="row">
	        <div class="page-header">
	            <div class="d-flex align-items-center">
	                <h2 class="page-header-title">Datatables</h2>
	                <div>
	                    <ul class="breadcrumb">
	                        <li class="breadcrumb-item"><a href="db-default.html"><i class="ti ti-home"></i></a></li>
	                        <li class="breadcrumb-item active">Datatables</li>
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
	                    <h4>Sorting</h4>
	                </div>
	                <div class="widget-body">
	                    <div class="table-responsive">
	                        <table id="sorting-table" class="table mb-0">
	                            <thead>
	                                <tr>
	                                    <th>Order ID</th>
	                                    <th>Customer Name</th>
	                                    <th>Country</th>
	                                    <th>Ship Date</th>
	                                    <th><span style="width:100px;">Status</span></th>
	                                    <th>Order Total</th>
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
